# -*- coding: utf-8 -*-
import logging

import colander
from colander import null
import deform
from deform.widget import filedict
from google.appengine.ext import blobstore

from . import models as m
from .const import CATEGORIES
from .gae import BlobStore


logger = logging.getLogger(__name__) 


def bhajan_ch():
    for b in m.Bhajan.query():
        yield b.key.id(), b.title

class Choices(object):
    """Fabric class for choice list
    
        Takes generator function and returns
        new generator object on every __iter__ call
    """
    def __init__(self, gen):
        self.gen = gen

    def __iter__(self):
        return self.gen()

class GaeUploadTempStore(object):
    def __init__(self):
        self.bs = BlobStore()

    def __getitem__(self, name):
        blob_info = self.bs[name]
        return self._to_dict(blob_info)

    def __setitem__(self, name, value):
        pass

    def __delitem__(self, name):
        try:
            del self.bs[name]
        except KeyError:
            pass

    def __contains__(self, name):
        return name in self.bs

    def _to_dict(self, blob_info):
        return dict(size=blob_info.size,
                    mimetype=blob_info.content_type,
                    filename=blob_info.filename,
                    fp=None,
                    preview_url=None,
                    uid=str(blob_info.key()))

    def get(self, name, default=None):
        try:
            return self[name]
        except KeyError:
            return default

    def preview_url(self, name):
        return None

class GaeFileUploadWidget(deform.widget.FileUploadWidget):
    def deserialize(self, field, pstruct):
        logger.debug('widget:deserialize, %s, %s', field, pstruct)

        if pstruct is null:
            return null

        upload = pstruct.get('upload')
        uid = pstruct.get('uid')

        if hasattr(upload, 'file'):
            # the upload control had a file selected
            blob_info = blobstore.parse_blob_info(upload)
            data = filedict(self.tmpstore._to_dict(blob_info))

            if uid:
                # previous file exists
                del self.tmpstore[uid]
        else:
            # the upload control had no file selected
            if not uid:
                # no previous file exists
                return null
            else:
                # a previous file should exist
                data = self.tmpstore.get(uid)
                # but if it doesn't, don't blow up
                if data is None:
                    return null

        return data

    def serialize(self, field, cstruct, **kw):
        logger.debug('widget: serialize, %s, %s, %s', field, cstruct, kw)
        return super(GaeFileUploadWidget, self).serialize(field, cstruct, **kw)


class Bhajan(colander.MappingSchema):
    title = colander.SchemaNode(colander.String(),
                                validator=colander.Length(3, 150),
                                title=u'Название')
    category = colander.SchemaNode(colander.String(),
                                   validator=colander.OneOf([x[0] for x in CATEGORIES]),
                                   missing=u'',
                                   widget=deform.widget.SelectWidget(values=CATEGORIES),
                                   title=u'Категория')
    text = colander.SchemaNode(colander.String(),
                               validator=colander.Length(10),
                               widget=deform.widget.TextAreaWidget(rows=7),
                               title=u'Текст')
    accords = colander.SchemaNode(colander.String(),
                                  validator=colander.Length(10),
                                  widget=deform.widget.TextAreaWidget(rows=7),
                                  title=u'Аккорды')

class Record(colander.MappingSchema):
    bhajan = colander.SchemaNode(colander.String(),
                                 widget=deform.widget.SelectWidget(values=Choices(bhajan_ch)),
                                 title=u'Баджана')
    artist = colander.SchemaNode(colander.String(),
                                 validator=colander.Length(1, 100),
                                 title=u'Исполнитель')
    audio = colander.SchemaNode(deform.FileData(),
                                widget=GaeFileUploadWidget(GaeUploadTempStore()),
                                title=u'Аудио файл')
