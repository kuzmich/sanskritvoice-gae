<%inherit file="base.mako"/>
<%namespace name="blocks" file="blocks.mako"/>

          % for b in bhajans:
            ${blocks.bhajan(b)}
          % endfor

          <nav>
            <ul class="pager">
              <li><a href="#">Назад</a></li>
              <li><a href="#">Еще</a></li>
            </ul>
          </nav>
