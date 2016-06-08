<div id="fb-root"></div>
<!--<script>(function(d, s, id) {-->
<!--        var js, fjs = d.getElementsByTagName(s)[0];-->
<!--        if (d.getElementById(id)) return;-->
<!--        js = d.createElement(s); js.id = id;-->
<!--        js.src = "//connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v2.6&appId=788945274461581";-->
<!--        fjs.parentNode.insertBefore(js, fjs);-->
<!--    }(document, 'script', 'facebook-jssdk'));</script>-->
<article class="page current">
    <div class="big-image" style="background-image: url(<?php echo $first_article['thumbnail']; ?>);">
        <div class="inner">
            <div class="fader">
                <div class="text">
                    <a class="goto-next">Read Next</a>
                    <h1 class="title">Staying Organized</h1>
                    <h2 class="description">10 ways to keep your life &amp; workspace clutter-free</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <h3 class="byline">
            Published <time><?php echo date('F d, Y', strtotime($first_article['publish_date'])); ?></time> by <span class="author"><?php echo $first_article['author']; ?></span>
        </h3>
        <h1 class="title"><?php echo $first_article['title']; ?></h1>
        <h2 class="description"><?php echo $first_article['summary']; ?></h2>
        <div class="text">
            <?php echo $first_article['content']; ?>
        </div>
        <?php /*
        <div class="ads">
            <script>
                window.fbAsyncInit = function() {
                    FB.Event.subscribe(
                        'ad.loaded',
                        function(placementId) {
                            console.log('Audience Network ad loaded');
                        }
                    );
                    FB.Event.subscribe(
                        'ad.error',
                        function(errorCode, errorMessage, placementId) {
                            console.log('Audience Network error (' + errorCode + ') ' + errorMessage);
                        }
                    );
                };
                (function(d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0];
                    if (d.getElementById(id)) return;
                    js = d.createElement(s); js.id = id;
                    js.src = "//connect.facebook.net/en_US/sdk/xfbml.ad.js#xfbml=1&version=v2.5&appId=235505446824664";
                    fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));
            </script>
            <div class=" fb_iframe_widget fb_iframe_widget_fluid" data-placementid="235505446824664_236165360092006" data-format="300x250" data-testmode="false" fb-xfbml-state="rendered" fb-iframe-plugin-query="app_id=235505446824664&amp;container_width=0&amp;features=%7B%22ua%22%3A%22Mozilla%2F5.0%20(iPhone%3B%20CPU%20iPhone%20OS%209_1%20like%20Mac%20OS%20X)%20AppleWebKit%2F601.1.46%20(KHTML%2C%20like%20Gecko)%20Version%2F9.0%20Mobile%2F13B143%20Safari%2F601.1%22%2C%22css_all%22%3Atrue%2C%22cfq%22%3Atrue%2C%22cssvar%22%3Atrue%2C%22scope%22%3Afalse%2C%22sticky%22%3Afalse%2C%22scroll%22%3Afalse%2C%22plugins%22%3A0%2C%22pmode%22%3Afalse%2C%22colorDepth%22%3A24%2C%22websql%22%3Atrue%2C%22dnd%22%3Atrue%2C%22ce%22%3Atrue%2C%22imp%22%3Atrue%2C%22tz%22%3A-180%2C%22ogg%22%3Atrue%2C%22dialog%22%3Atrue%2C%22video%22%3Atrue%2C%22audio%22%3Atrue%2C%22chrome%22%3Atrue%2C%22chromewebstore%22%3Atrue%2C%22random%22%3Atrue%2C%22ie%22%3Atrue%2C%22userdata%22%3Atrue%2C%22srcset%22%3Atrue%2C%22canvas%22%3Atrue%2C%22pic%22%3Atrue%2C%22wc%22%3Atrue%2C%22ext%22%3Afalse%2C%22devorient%22%3Atrue%2C%22devmotion%22%3Atrue%2C%22time%22%3A26.115000000000236%7D&amp;format=300x250&amp;iframe=NO_IFRAME&amp;iframeurls=%5B%5D&amp;locale=en_US&amp;mediation=NONE&amp;pixelratio=2&amp;placementid=235505446824664_236165360092006&amp;screenheight=568&amp;screenwidth=320&amp;sdk=joey&amp;tagname=DIV&amp;testmode=false&amp;topdomain=facebookmobile.azurewebsites.net&amp;topurl=http%3A%2F%2Ffacebookmobile.azurewebsites.net%2Fnews%2F%234"><span style="vertical-align: bottom; width: 300px; height: 250px;"><iframe name="f38ce126ada3838" width="1000px" height="1000px" frameborder="0" allowtransparency="true" allowfullscreen="true" scrolling="no" title="fb:ad Facebook Social Plugin" src="https://www.facebook.com/v2.5/plugins/ad.php?app_id=235505446824664&amp;channel=http%3A%2F%2Fstaticxx.facebook.com%2Fconnect%2Fxd_arbiter.php%3Fversion%3D42%23cb%3Df3eff70d3a058f%26domain%3Dfacebookmobile.azurewebsites.net%26origin%3Dhttp%253A%252F%252Ffacebookmobile.azurewebsites.net%252Ff32e2143607f068%26relation%3Dparent.parent&amp;container_width=0&amp;features=%7B%22ua%22%3A%22Mozilla%2F5.0%20(iPhone%3B%20CPU%20iPhone%20OS%209_1%20like%20Mac%20OS%20X)%20AppleWebKit%2F601.1.46%20(KHTML%2C%20like%20Gecko)%20Version%2F9.0%20Mobile%2F13B143%20Safari%2F601.1%22%2C%22css_all%22%3Atrue%2C%22cfq%22%3Atrue%2C%22cssvar%22%3Atrue%2C%22scope%22%3Afalse%2C%22sticky%22%3Afalse%2C%22scroll%22%3Afalse%2C%22plugins%22%3A0%2C%22pmode%22%3Afalse%2C%22colorDepth%22%3A24%2C%22websql%22%3Atrue%2C%22dnd%22%3Atrue%2C%22ce%22%3Atrue%2C%22imp%22%3Atrue%2C%22tz%22%3A-180%2C%22ogg%22%3Atrue%2C%22dialog%22%3Atrue%2C%22video%22%3Atrue%2C%22audio%22%3Atrue%2C%22chrome%22%3Atrue%2C%22chromewebstore%22%3Atrue%2C%22random%22%3Atrue%2C%22ie%22%3Atrue%2C%22userdata%22%3Atrue%2C%22srcset%22%3Atrue%2C%22canvas%22%3Atrue%2C%22pic%22%3Atrue%2C%22wc%22%3Atrue%2C%22ext%22%3Afalse%2C%22devorient%22%3Atrue%2C%22devmotion%22%3Atrue%2C%22time%22%3A26.115000000000236%7D&amp;format=300x250&amp;iframe=NO_IFRAME&amp;iframeurls=%5B%5D&amp;locale=en_US&amp;mediation=NONE&amp;pixelratio=2&amp;placementid=235505446824664_236165360092006&amp;screenheight=568&amp;screenwidth=320&amp;sdk=joey&amp;tagname=DIV&amp;testmode=false&amp;topdomain=facebookmobile.azurewebsites.net&amp;topurl=http%3A%2F%2Ffacebookmobile.azurewebsites.net%2Fnews%2F%234" style="border: none; visibility: visible; width: 300px; height: 250px;" class=""></iframe></span></div>
        </div>

        <div class="fb-messengermessageus fb_iframe_widget fb_iframe_widget_fluid" messenger_app_id="235505446824664" page_id="515535461968215" color="white" size="xlarge" fb-xfbml-state="rendered" fb-iframe-plugin-query="app_id=235505446824664&amp;color=white&amp;container_width=262&amp;locale=en_US&amp;messenger_app_id=235505446824664&amp;page_id=515535461968215&amp;sdk=joey&amp;size=xlarge" style="display: block; width: 100%; height: auto;"><span style="vertical-align: bottom; width: 130px; height: 38px;"><iframe name="f2cc0d07c7613bc" height="1000px" frameborder="0" allowtransparency="true" allowfullscreen="true" scrolling="no" title="fb:messengermessageus Facebook Social Plugin" src="https://www.facebook.com/v2.5/plugins/messengermessageus.php?app_id=235505446824664&amp;channel=http%3A%2F%2Fstaticxx.facebook.com%2Fconnect%2Fxd_arbiter.php%3Fversion%3D42%23cb%3Df13386405c5bd64%26domain%3Dfacebookmobile.azurewebsites.net%26origin%3Dhttp%253A%252F%252Ffacebookmobile.azurewebsites.net%252Ff32e2143607f068%26relation%3Dparent.parent&amp;color=white&amp;container_width=262&amp;locale=en_US&amp;messenger_app_id=235505446824664&amp;page_id=515535461968215&amp;sdk=joey&amp;size=xlarge" style="border: none; visibility: visible; height: 38px; position: static; width: 130px; min-width: 100%;" class=""></iframe></span></div>
        <div class="fb-send-to-messenger fb_iframe_widget fb_iframe_widget_fluid" messenger_app_id="235505446824664" page_id="515535461968215" data-ref="hi" color="white" size="xlarge" fb-xfbml-state="rendered" fb-iframe-plugin-query="app_id=235505446824664&amp;color=white&amp;container_width=262&amp;locale=en_US&amp;messenger_app_id=235505446824664&amp;page_id=515535461968215&amp;ref=hi&amp;sdk=joey&amp;size=xlarge" style="display: block; width: 100%; height: auto;"><span style="vertical-align: bottom; width: 0px; height: 0px;"><iframe name="f2083aeeb827ccc" height="1000px" frameborder="0" allowtransparency="true" allowfullscreen="true" scrolling="no" title="fb:send_to_messenger Facebook Social Plugin" src="https://www.facebook.com/v2.5/plugins/send_to_messenger.php?app_id=235505446824664&amp;channel=http%3A%2F%2Fstaticxx.facebook.com%2Fconnect%2Fxd_arbiter.php%3Fversion%3D42%23cb%3Dfd2229c334d9e4%26domain%3Dfacebookmobile.azurewebsites.net%26origin%3Dhttp%253A%252F%252Ffacebookmobile.azurewebsites.net%252Ff32e2143607f068%26relation%3Dparent.parent&amp;color=white&amp;container_width=262&amp;locale=en_US&amp;messenger_app_id=235505446824664&amp;page_id=515535461968215&amp;ref=hi&amp;sdk=joey&amp;size=xlarge" style="border: none; visibility: visible; height: 0px; position: static; width: 0px; min-width: 100%;" class=""></iframe></span></div>
  */ ?>
 </div>
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <?php foreach ($articles as $article): ?>
                <div class="swiper-slide">
                    <a href="<?php echo SITE_DIR; ?>?article=<?php echo $article['entry_id']; ?>">
                        <div class="img_wrap">
                            <img src="<?php echo $article['thumbnail']; ?>" alt="<?php echo $article['title']; ?>" />
                        </div>
                        <div class="slider-title">
                            <?php echo $article['title']; ?>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div style="height: 100px"></div>
</article>
<script type="text/javascript">

    $ = jQuery.noConflict();
    $(document).ready(function () {
        $('img').removeAttr('height');
        $('img').removeAttr('width');
        scroll();
        var swiper = new Swiper('.swiper-container', {
            slidesPerView: 'auto',
            centeredSlides: true,
            spaceBetween: 10
        });
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
<style>
/* line 2, ../scss/_extensions.scss */
.container, body article.page .content {
    max-width: 600px;
    margin: 0 auto;
}

/* line 7, ../scss/_extensions.scss */
.stretchy-bg, body article.page .big-image {
    background-position: center center;
    background-repeat: none;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
}

/* line 13, ../scss/_extensions.scss */
.big-image, body article.page .big-image {
    height: 300px;
}
@media only screen and (min-width: 500px) {
    /* line 13, ../scss/_extensions.scss */
    .big-image, body article.page .big-image {
        height: 420px;
    }
}



.ads {
    margin: auto;
    z-index: 1;
    margin-bottom: 2em;
}



/* line 61, ../../../../../../../../../Applications/LiveReload.app/Contents/Resources/SASS.lrplugin/lib/compass/frameworks/compass/stylesheets/compass/typography/_vertical_rhythm.scss */
* html {
    font-size: 125%;
}

/* line 64, ../../../../../../../../../Applications/LiveReload.app/Contents/Resources/SASS.lrplugin/lib/compass/frameworks/compass/stylesheets/compass/typography/_vertical_rhythm.scss */
html {
    font-size: 20px;
    line-height: 0.3em;
}

/* line 4, ../scss/_mixins.scss */
::-webkit-scrollbar {
    width: 3px;
    height: 3px;
}

/* line 9, ../scss/_mixins.scss */
::-webkit-scrollbar-thumb {
    background: #666666;
}

/* line 13, ../scss/_mixins.scss */
::-webkit-scrollbar-track {
    background: rgba(255, 255, 255, 0.1);
}

/* line 18, ../scss/_mixins.scss */
body {
    scrollbar-face-color: #666666;
    scrollbar-track-color: rgba(255, 255, 255, 0.1);
}

/* line 11, ../scss/styles.scss */
body {
    font-family: 'PT Serif', serif;
    color: #555;
    padding: 20px;
    padding: 0;
    margin: 0;
    -webkit-backface-visibility: hidden;
    -webkit-font-smoothing: antialiased;
    text-rendering: optimizeLegibility;
    line-height: 1.8em;
    /* Responsive typography, yay! */
    font-size: 80%;
    /* Page-wrap styles.  */
}
@media only screen and (min-width: 500px) {
    /* line 11, ../scss/styles.scss */
    body {
        font-size: 100%;
    }
}
/* line 27, ../scss/styles.scss */
body h1 {
    font-family: 'Source Sans Pro', serif;
}
/* line 31, ../scss/styles.scss */
body h1, body h2, body h3, body h4, body h5, body h6 {
    color: #333;
}
/* line 36, ../scss/styles.scss */
body article.page {
    -webkit-transform-origin: bottom center;
    /* Class applied when when page fades away. */
    /* The large image that accompanies every post. */
    /* The content. */
}
/* line 39, ../scss/styles.scss */
body article.page.hidden {
    display: none;
}
/* line 42, ../scss/styles.scss */
body article.page.next .big-image, body article.page.next .big-image {
    cursor: pointer;
}
/* line 43, ../scss/styles.scss */
body article.page.next .big-image .inner, body article.page.next .big-image .inner {
    opacity: 1;
}
/* line 47, ../scss/styles.scss */
body article.page.content-hidden .content {
    display: none;
}
/* line 51, ../scss/styles.scss */
body article.page.fade-up-out {
    opacity: 0;
    -webkit-transform: scale(0.8) translate3d(0, -10%, 0);
    -moz-transform: scale(0.8) translate3d(0, -10%, 0);
    -ms-transform: scale(0.8) translate3d(0, -10%, 0);
    -o-transform: scale(0.8) translate3d(0, -10%, 0);
    transform: scale(0.8) translate3d(0, -10%, 0);
    -webkit-transition: all 450ms cubic-bezier(0.165, 0.84, 0.44, 1);
    -moz-transition: all 450ms cubic-bezier(0.165, 0.84, 0.44, 1);
    -o-transition: all 450ms cubic-bezier(0.165, 0.84, 0.44, 1);
    transition: all 450ms cubic-bezier(0.165, 0.84, 0.44, 1);
}
/* line 57, ../scss/styles.scss */
body article.page.easing-upward {
    -webkit-transition: all 450ms cubic-bezier(0.165, 0.84, 0.44, 1);
    -moz-transition: all 450ms cubic-bezier(0.165, 0.84, 0.44, 1);
    -o-transition: all 450ms cubic-bezier(0.165, 0.84, 0.44, 1);
    transition: all 450ms cubic-bezier(0.165, 0.84, 0.44, 1);
}
/* line 62, ../scss/styles.scss */
body article.page .big-image, body article.page .big-image {
    font-size: 80%;
}
@media only screen and (min-width: 500px) {
    /* line 62, ../scss/styles.scss */
    body article.page .big-image, body article.page .big-image {
        font-size: 100%;
    }
}
/* line 69, ../scss/styles.scss */
body article.page .big-image .inner, body article.page .big-image .inner {
    position: relative;
    width: 100%;
    height: 100%;
    text-align: center;
    opacity: 0;
    text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.2);
    -webkit-transition: all 0.1s ease;
    -moz-transition: all 0.1s ease;
    -o-transition: all 0.1s ease;
    transition: all 0.1s ease;
}
/* line 78, ../scss/styles.scss */
body article.page .big-image .inner .fader, body article.page .big-image .inner .fader {
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.3);
}
/* line 83, ../scss/styles.scss */

img {
    max-width: 100%; //С€РёСЂРёРЅР°
max-height: 100%; //РІС‹СЃРѕС‚Р°
}


body article.page .big-image .inner .fader .text {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 80%;
    -webkit-transform: translateX(-50%) translateY(-50%);
    -moz-transform: translateX(-50%) translateY(-50%);
    -ms-transform: translateX(-50%) translateY(-50%);
    -o-transform: translateX(-50%) translateY(-50%);
    transform: translateX(-50%) translateY(-50%);
}
/* line 89, ../scss/styles.scss */
body article.page .big-image .inner .fader .text a, body article.page .big-image .inner .fader .text h1, body article.page .big-image .inner .fader .text h2 {
    color: white;
}
/* line 91, ../scss/styles.scss */
body article.page .big-image .inner .fader .text a {
    color: white;
    border-bottom: 1px solid white;
    text-decoration: none;
    font-style: italic;
    font-size: 0.8em;
    line-height: 1.5em;
}
/* line 99, ../scss/styles.scss */
body article.page .big-image .inner .fader .text h1 {
    margin: 0;
    margin-top: 0.1em;
    padding-top: 0em;
    padding-bottom: 0em;
    margin-bottom: 0em;
    font-size: 3em;
    line-height: 1.1em;
}
/* line 105, ../scss/styles.scss */
body article.page .big-image .inner .fader .text h2 {
    margin: 0;
    font-style: italic;
    font-weight: normal;
    margin-top: 0.2em;
    padding-top: 0em;
    padding-bottom: 0em;
    margin-bottom: 0em;
    font-size: 1.5em;
    line-height: 1.2em;
}
/* line 119, ../scss/styles.scss */
body article.page .content {
    padding: 0 1.8em;
}
/* line 123, ../scss/styles.scss */
body article.page .content h3 {
    color: #999;
    font-family: 'Source Sans Pro', serif;
    font-weight: 400;
    margin-top: 3em;
    padding-top: 0em;
    padding-bottom: 0em;
    margin-bottom: 0.375em;
    font-size: 0.8em;
    line-height: 1.5em;
}
/* line 131, ../scss/styles.scss */
body article.page .content h1 {
    margin-top: 0em;
    padding-top: 0em;
    padding-bottom: 0em;
    margin-bottom: 0.24em;
    font-size: 2.5em;
    line-height: 1.08em;
}
/* line 136, ../scss/styles.scss */
body article.page .content h2.description {
    font-weight: normal;
    font-style: italic;
}
/* line 140, ../scss/styles.scss */
body article.page .content p:last-child {
    margin-bottom: 3em;
}
.swiper-container {
    width: 100%;
    height: 300px;
    overflow: hidden;
    margin: 20px auto;
}
.swiper-slide {
    text-align: center;
    font-size: 18px;
    background: #fff;
    width: 80%;
    border: 1px solid #ccc;
    /* Center slide text vertically */
    /*display: -webkit-box;*/
    /*display: -ms-flexbox;*/
    /*display: -webkit-flex;*/
    /*display: flex;*/
    /*-webkit-box-pack: center;*/
    /*-ms-flex-pack: center;*/
    /*-webkit-justify-content: center;*/
    /*justify-content: center;*/
    /*-webkit-box-align: center;*/
    /*-ms-flex-align: center;*/
    /*-webkit-align-items: center;*/
    align-items: center;
}
/*.swiper-slide:nth-child(2n) {*/
/*width: 60%;*/
/*}*/
/*.swiper-slide:nth-child(3n) {*/
/*width: 40%;*/
/*}*/
.img_wrap {
    width: 100%;
    height: 200px;
    overflow: hidden;
    line-height: 185px;
    text-align: center;
}
.img_wrap img {
    max-height: 200px;
    /*max-width: 100%;*/
    height: 100%;

    /*max-height: 200%;*/
    /*max-width: 200%;*/
    vertical-align: middle;
}
.slider-title {
    text-align: left;
}
</style>