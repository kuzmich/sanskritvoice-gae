<%block name="head">
    <style>
        .audiojs {
            width: 100%;
        }
    </style>
## TODO http://stackoverflow.com/questions/15522578/3-divs-middle-div-take-up-remaining-width
</%block>

<%block name="body_start">
    <audio></audio>
</%block>

<%block name="body_end">
    <script src="${request.static_path('sv:static/audiojs/audio.min.js')}"></script>
    <script>
        var player;
        audiojs.events.ready(function() {
            var as = audiojs.createAll();
            player = as[0];
        });

        $(document).ready(function() {
            $('button').on('click', function () {
                var url = $(this).data('url');
                var title = $(this).data('title');
                player.load(url);
                player.play()
            });
        })
    </script>
</%block>

