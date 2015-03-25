<%def name="bhajan(b)">
  <% has_accords = bool(b.accords) %>
            <div class="blog-post">
              <h2 class="blog-post-title">${b.title}</h2>
              <p class="blog-post-meta">
                % if has_accords:
                  <a href="#" data-alttext="Только текст">Аккорды</a>
                % endif
              </p>
              <p class="b-text">${b.text.replace('\n', '<br>') if b.text else '' | n}</p>
              <p class="b-accords" style="display: none">${b.accords.replace('\n', '<br>') if b.accords else '' | n}</p>
              % if b.records:
                <h3>Послушать в исполнении:</h3>
                <ul class="playlist">
                % for r in b.records:
                  <li><a href="${request.route_url('download', blob_key=r.audio_key)}"
                         class="playable"
                         data-title="${r.artist} - ${b.title}">${r.artist}</a></li>
                % endfor
                </ul>
              % endif
            </div>
</%def>
