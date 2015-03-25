# -*- coding: utf-8 -*-
import logging

import deform
from google.appengine.ext import blobstore, ndb

from pyramid.httpexceptions import HTTPFound, HTTPNotFound
from pyramid.response import Response
from pyramid.view import view_config

from . import models as m
from . import forms as f
from .const import CATEGORIES


logger = logging.getLogger(__name__) 


def normalize_id(int_or_str_id):
    if int_or_str_id.isdigit():
        return int(int_or_str_id)
    else:
        return int_or_str_id
nid = normalize_id


@view_config(route_name='admin.index', renderer='templates/sbadmin2/bhajans.mako')
@view_config(route_name='admin.bhajans', renderer='templates/sbadmin2/bhajans.mako')
def bhajans(request):
    bhajans = m.Bhajan.query().fetch()
    return {'bhajans': bhajans}

@view_config(route_name='admin.add_bhajan', renderer='templates/sbadmin2/add_bhajan.mako')
def add_bhajan(request):
    form = deform.Form(f.Bhajan(), buttons=(u'добавить',))

    if request.method == 'POST':
        try:
            data = form.validate(request.POST.items())
        except deform.ValidationFailure as e:
            return dict(form=e.render())

        bhajan = m.Bhajan(**data)
        bhajan.put()

        return HTTPFound(request.route_path('admin.bhajans'))

    return dict(form=form.render())

@view_config(route_name='admin.edit_bhajan', renderer='templates/sbadmin2/edit_bhajan.mako')
def edit_bhajan(request):
    bid = nid(request.matchdict['bid'])

    bhajan = m.Bhajan.get_by_id(bid)
    form = deform.Form(f.Bhajan(), buttons=(u'сохранить',))

    if request.method == 'POST':
        try:
            data = form.validate(request.POST.items())
        except deform.ValidationFailure as e:
            return dict(bhajan=bhajan, form=e.render())

        bhajan.populate(**data)
        bhajan.put()

        return HTTPFound(request.route_path('admin.bhajans'))

    return dict(bhajan=bhajan, form=form.render(bhajan.to_dict()))


@view_config(route_name='admin.records', renderer='templates/sbadmin2/records.mako')
def records(request):
    records = m.Record.query().fetch()
    return dict(records=records)

@view_config(route_name='admin.add_record', renderer='templates/sbadmin2/add_record.mako')
def add_record(request):
    form = deform.Form(
        f.Record(),
        action=blobstore.create_upload_url(request.route_path('admin.add_record')),
        buttons=(u'добавить',)
    )

    if request.method == 'POST':
        post_data = request.POST.items()
        logger.debug('post_data: %s', post_data)

        keys = ['_charset_', '__formid__', 'artist', 'bhajan', '__start__', 'upload', 'uid', '__end__']
        post_data = [(k, request.POST[k]) for k in keys if k in request.POST]
        logger.debug('post_data: %s', post_data)

        try:
            data = form.validate(post_data)
            logger.debug('data: %s', data)
        except deform.ValidationFailure as e:
            return dict(form=e.render())

        record = m.Record(bhajan_key=ndb.Key(m.Bhajan, nid(data['bhajan'])),
                          artist=data['artist'],
                          audio_key=blobstore.BlobKey(data['audio']['uid']))
        record.put()

        return HTTPFound(request.route_path('admin.records'))

    return dict(form=form.render())

@view_config(route_name='admin.edit_record', renderer='templates/sbadmin2/edit_record.mako')
def edit_record(request):
    rid = nid(request.matchdict['rid'])

    record = m.Record.get_by_id(rid)
    bid = record.bhajan_key.id()

    form = deform.Form(
        f.Record(),
        action=blobstore.create_upload_url(request.route_path('admin.edit_record', rid=rid)),
        buttons=(u'сохранить',)
    )
    gae_store = f.GaeUploadTempStore()

    if request.method == 'POST':
        post_data = request.POST.items()
        logger.debug('post_data: %s', post_data)

        keys = ['_charset_', '__formid__', 'artist', 'bhajan', '__start__', 'upload', 'uid', '__end__']
        post_data = [(k, request.POST[k]) for k in keys if k in request.POST]
        logger.debug('post_data: %s', post_data)

        try:
            data = form.validate(post_data)
        except deform.ValidationFailure as e:
            return dict(record=record, form=e.render())

        record.populate(artist=data['artist'],
                        audio_key=blobstore.BlobKey(data['audio']['uid']),
                        bhajan_key=ndb.Key(m.Bhajan, nid(data['bhajan'])))
        record.put()

        return HTTPFound(request.route_path('admin.records'))

    return dict(record=record, form=form.render(dict(artist=record.artist,
                                                     audio=gae_store[record.audio_key],
                                                     bhajan=bid)))


@view_config(route_name='home', renderer='templates/bb/home.mako')
def home(request):
    bhajans = m.Bhajan.query().order(m.Bhajan.title).fetch()
    return dict(bhajans=bhajans,
                categories=CATEGORIES[1:])

@view_config(route_name='category', renderer='templates/bb/categories.mako')
def category(request):
    category = request.matchdict['category']
    if category not in [c[0] for c in CATEGORIES[1:]]:
        return HTTPNotFound()

    bhajans = m.Bhajan.query(m.Bhajan.category == category).fetch()
    return dict(bhajans=bhajans,
                categories=CATEGORIES[1:])

@view_config(route_name='bhajan', renderer='templates/bb/bhajan.mako')
def bhajan(request):
    bid = nid(request.matchdict['bid'])
    bhajan = m.Bhajan.get_by_id(bid)
    if not bhajan:
        return HTTPNotFound()

    return dict(bhajan=bhajan,
                categories=CATEGORIES[1:])

@view_config(route_name='download')
def download(request):
    r = Response(content_type='')
    r.headers[blobstore.BLOB_KEY_HEADER] = str(request.matchdict['blob_key'])
    r.headers['Accept-Ranges'] = 'bytes'
    return r
