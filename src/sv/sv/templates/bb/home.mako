<%inherit file="base.mako"/>
##<%namespace name="player" file="../players/wimpy.mako"/>
##<%namespace name="player" file="../players/scm.mako"/>
##<%namespace name="player" file="../players/jplayer.mako"/>
##<%namespace name="player" file="../players/audiojs.mako"/>
<%namespace name="player" file="../players/sm2.mako"/>

<%block name="head">
    ${parent.head()}
    ${player.head()}
</%block>

<%block name="body_start">${player.body_start()}</%block>
<%block name="body_end">${player.body_end()}</%block>

          % for b in bhajans:
            <div class="blog-post">
              <h2 class="blog-post-title">${b.title}</h2>
              <p class="blog-post-meta"><a href="#">Аккорды</a></p>
              <p>${b.text.replace('\n', '<br>') if b.text else '' | n}</p>
              % for r in b.records:
                <button type="button" class="btn btn-default"
                        data-url="${request.route_url('download', blob_key=r.audio_key)}"
                        data-title="${r.artist} - ${b.title}"
                        data-type="${r.audio.content_type}">
                  <span class="glyphicon glyphicon-play" aria-hidden="true"></span> ${r.artist}
                </button>
              % endfor
            </div>
          % endfor
