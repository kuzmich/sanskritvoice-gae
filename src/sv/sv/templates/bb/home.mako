<%inherit file="base.mako"/>

        % for b in bhajans:
          <a href="${request.route_path('bhajan', bid=b.id)}">${b.title}</a><br>
        % endfor

