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
              % for r in b.records:
                <button type="button" class="btn btn-default"
                        data-url="${request.route_url('download', blob_key=r.audio_key)}"
                        data-title="${r.artist} - ${b.title}"
                        data-type="${r.audio.content_type}">
                  <span class="glyphicon glyphicon-play" aria-hidden="true"></span> ${r.artist}
                </button>
              % endfor
            </div>
</%def>
