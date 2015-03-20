<%inherit file="base.mako"/>

<%block name="head">
    ${parent.head()}
    <style>
        .wplayer {
            width: 100%;
        }
    </style>
</%block>

<%block name="body_end">
    <script src="${request.static_path('sv:static/wimpy/wimpy.js')}"></script>
    <script>
        $(document).ready(function() {
            var wplayer = new wimpyPlayer({
                target: "wplayer",
                media: "none",
                skin: "${request.static_path('sv:static/wimpy/wimpy.skins/001.tsv')}",
                responsive : 1
            });

            $('div.blog-post button').on('click', function () {
                var url = $(this).data('url');
                var title = $(this).data('title');
                wplayer.play({file: url, title: title, kind: "mp3"});
            });
        });
    </script>
</%block>

          % for b in bhajans:
            <div class="blog-post">
              <h2 class="blog-post-title">${b.title}</h2>
              <p class="blog-post-meta"><a href="#">Аккорды</a></p>
              <p>${b.text.replace('\n', '<br>') if b.text else '' | n}</p>
              % for r in b.records:
                <button type="button" class="btn btn-default"
                        data-url="${request.route_url('download', blob_key=r.audio_key)}"
                        data-title="${r.artist} - ${b.title}">
                  <span class="glyphicon glyphicon-play" aria-hidden="true"></span> ${r.artist}
                </button>
              % endfor
            </div>
          % endfor

