<%block name="head">
    <link rel="stylesheet" href="${request.static_path('sv:static/sm2/bar-ui/css/bar-ui.css')}">
</%block>

<%block name="body_start">
<div class="sm2-bar-ui compact full-width">

 <div class="bd sm2-main-controls">
  <div class="sm2-inline-texture"></div>
  <div class="sm2-inline-gradient"></div>

  <div class="sm2-inline-element sm2-button-element">
   <div class="sm2-button-bd">
    <a href="#play" class="sm2-inline-button play-pause">Play / pause</a>
   </div>
  </div>

  <div class="sm2-inline-element sm2-inline-status">

   <div class="sm2-playlist">
    <div class="sm2-playlist-target">
     <!-- playlist <ul> + <li> markup will be injected here -->
     <!-- if you want default / non-JS content, you can put that here. -->
     <noscript><p>JavaScript is required.</p></noscript>
    </div>
   </div>

   <div class="sm2-progress">
    <div class="sm2-row">
    <div class="sm2-inline-time">0:00</div>
     <div class="sm2-progress-bd">
      <div class="sm2-progress-track">
       <div class="sm2-progress-bar"></div>
       <div class="sm2-progress-ball"><div class="icon-overlay"></div></div>
      </div>
     </div>
     <div class="sm2-inline-duration">0:00</div>
    </div>
   </div>

  </div>

  <div class="sm2-inline-element sm2-button-element sm2-volume">
   <div class="sm2-button-bd">
    <span class="sm2-inline-button sm2-volume-control volume-shade"></span>
    <a href="#volume" class="sm2-inline-button sm2-volume-control">volume</a>
   </div>
  </div>
 </div>

 <div class="bd sm2-playlist-drawer sm2-element">

  <div class="sm2-inline-texture">
   <div class="sm2-box-shadow"></div>
  </div>

  <!-- playlist content is mirrored here -->
  <div class="sm2-playlist-wrapper">
    <ul class="sm2-playlist-bd">
      <li><a></a></li>
    </ul>
  </div>

 </div>

</div>
</%block>


<%block name="body_end">
    <script src="${request.static_path('sv:static/sm2/script/soundmanager2.js')}"></script>
    <script src="${request.static_path('sv:static/sm2/bar-ui/script/bar-ui.js')}"></script>
    <script>
        $(document).ready(function() {
            $('button').on('click', function () {
                var url = $(this).data('url');
                var title = $(this).data('title');
                var link = $('ul.sm2-playlist-bd a').first();
                link.attr('href', url);
                link.text(title);
                link[0].click();
            });

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
  <%doc>
    <script>
        soundManager.setup({
            url: '${request.static_path("sv:static/sm2/swf/")}'
            // use soundmanager2-nodebug-jsmin.js, or disable debug mode (enabled by default) after development/testing
            // debugMode: false,
        });
    </script>
  </%doc>
</%block>

