<%block name="head">
    <link rel="stylesheet" href="${request.static_path('sv:static/sm2/page-player/css/page-player.css')}">
    <style>
      ul.playlist li {
        font-size: 100%;
      }
      ul.playlist li .timing {
        font-size: 60%;
        height: auto;
      }
      ul.playlist li .controls .statusbar {
        height: 0.7em;
      }
    </style>
</%block>

<%block name="body_start">
    <div id="sm2-container">
      <!-- SM2 flash movie goes here -->
    </div>
</%block>

<%block name="body_end">
    <script src="${request.static_path('sv:static/sm2/script/soundmanager2.js')}"></script>
    <script>
        soundManager.setup({
            url: '${request.static_path("sv:static/sm2/swf/")}',
            html5PollingInterval: 50
            // use soundmanager2-nodebug-jsmin.js, or disable debug mode (enabled by default) after development/testing
            // debugMode: false,
        });
        var PP_CONFIG = {
            playNext: false
        }
        $(document).ready(function() {
            $('p.blog-post-meta a:nth-child(1)').on('click', function(e) {
                var link = $(this);
                var title = link.data('alttext');
                link.data('alttext', link.text());
                link.text(title);

                var p = $(this).parent('p');
                p.nextAll('p.b-text').toggle();
                p.nextAll('p.b-accords').toggle();
                e.preventDefault();
            });
        })
    </script>
    <script src="${request.static_path('sv:static/sm2/page-player/script/page-player.js')}"></script>
</%block>

