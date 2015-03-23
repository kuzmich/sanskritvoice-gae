<%block name="head"/>
<%block name="body_start"/>

<%block name="body_end">
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

