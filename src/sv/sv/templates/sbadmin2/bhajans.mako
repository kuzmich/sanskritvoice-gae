<%inherit file="sv:templates/sbadmin2/base.mako"/>

<%block name="page_header">Баджаны</%block>

##<%block name="body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Название</th>
                                </tr>
                            </thead>
                            <tbody>
                              % for b in bhajans:
                                <tr>
                                  <td><a href="${request.route_path('admin.edit_bhajan', bid=b.key.id())}">${b.title}</a></td>
                                </tr>
                              % endfor
                            </tbody>
                        </table>

                        <nav class="text-center">
                        ##{{ pagination.links|safe }}
                        </nav>
                        <a class="btn btn-primary" href="${request.route_path('admin.add_bhajan')}" role="button">Добавить новую</a>
##</%block>

