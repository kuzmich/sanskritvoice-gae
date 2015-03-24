from pyramid.config import Configurator


def admin_urls(config):
    config.add_route('admin.index', '/')
    config.add_route('admin.bhajans', '/bhajans')
    config.add_route('admin.edit_bhajan', '/bhajans/{bid}')
    config.add_route('admin.add_bhajan', '/add_bhajan')

    config.add_route('admin.records', '/records')
    config.add_route('admin.add_record', '/add_record')
    config.add_route('admin.edit_record', '/records/{rid}')

def main(global_config, **settings):
    """ This function returns a Pyramid WSGI application.
    """
    config = Configurator(settings=settings)

    #config.include('pyramid_chameleon')
    #config.add_mako_renderer('.html')

    config.add_static_view('static', 'static', cache_max_age=3600)
    config.add_static_view('static2', 'deform:static')

    config.add_route('home', '/')
    config.add_route('download', '/d/{blob_key}.mp3')

    config.include(admin_urls, route_prefix='/dj')

    config.scan()

    return config.make_wsgi_app()
