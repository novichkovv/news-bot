<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v2.6&appId=788945274461581";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div id="articles">
                <div class="article">
                    <h1><?php echo $first_article['title']; ?></h1>
                    <div class="article-content">
                        <?php echo $first_article['content']; ?>
                    </div>
                    <div class="fb-like" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button" data-action="like" data-show-faces="true" data-share="false"></div>
                </div>
            </div>
            <input type="hidden" id="next_id" value="<?php echo $next; ?>">
            <div id="marker" class="text-center">
                <img src="<?php echo SITE_DIR; ?>images/preloader.GIF">
            </div>
        </div>
        <div class="col-md-4 hidden-xs">
            <div id="side_articles">
                <?php foreach ($articles as $article): ?>
                    <div class="side_article">
                        <a href="?article=<?php echo $article['entry_id']; ?>">
                            <h3><?php echo $article['title']; ?></h3>
                            <?php if ($article['thumbnail']): ?>
                                <div class="side_thumb">
                                    <img style="max-width: 100%;" src="<?php echo $article['thumbnail']; ?>">
                                </div>
                            <?php endif; ?>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

    $ = jQuery.noConflict();
    $(document).ready(function () {
        $('img').removeAttr('height');
        $('img').removeAttr('width');
        scroll();
    });

    function scroll() {
        $(window).scroll(function() {
            var height = $("#marker").offset().top;
            if($(window).scrollTop() >= height - $(window).height()) {
                $(window).unbind('scroll');
                var params = {
                    'action': 'get_article',
                    'values': {id: $("#next_id").val()},
                    'callback': function (msg) {
                        ajax_respond(msg,
                            function (respond) { //success
                                setTimeout(function() {
                                    $("#articles").append(respond.template);
                                    $("#next_id").val(respond.next);
                                    scroll();
                                }, 3000);
                            },
                            function (respond) { //fail
                            }
                        );
                    }
                };
                ajax(params);
            }
        })
    }
</script>