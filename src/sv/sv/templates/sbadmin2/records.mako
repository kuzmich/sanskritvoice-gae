<%inherit file="sv:templates/sbadmin2/base.mako"/>

<%block name="page_header">Записи</%block>

##<%block name="body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Баджана</th>
                                    <th>Исполнитель</th>
                                </tr>
                            </thead>
                            <tbody>
                              % for r in records:
                                <tr>
                                  <td><a href="${request.route_path('admin.edit_record', rid=r.id)}">${r.bhajan.title if r.bhajan else ''}</a></td>
                                  <td>${r.artist}</dt>
                                </tr>
                              % endfor
                            </tbody>
                        </table>

                        <nav class="text-center">
                        ##{{ pagination.links|safe }}
                        </nav>
                        <a class="btn btn-primary" href="${request.route_path('admin.add_record')}" role="button">Добавить новую</a>
##</%block>


