<%block name="head">
    <style>
        .wplayer {
            width: 100%;
        }
    </style>
</%block>

<%block name="body_start">
    <div id="wplayer" class="wplayer"></div>
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
