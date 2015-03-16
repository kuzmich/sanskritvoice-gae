<%inherit file="base.mako"/>

<%block name="body_end">
    ##${parent.head()}
    <script type="text/javascript" src="http://scmplayer.net/script.js" data-config="{'skin':'skins/aquaBlue/skin.css','volume':50,'autoplay':false,'shuffle':false,'repeat':1,'placement':'top','showplaylist':false,}"></script>

    <script>
        $(document).ready(function() {
            $('button').on('click', function () {
                var url = $(this).data('url');
                var title = $(this).data('title');
                SCM.play({title: title, url: url});
            });
        })
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

