<div id="fixed_head">
    <a id="cat_link" href="<?php echo SITE_DIR; ?>category/" class="btn btn-icon btn-default pull-right"><i class="fa fa-bars"></i> </a>
</div>
<div id="back" style="display: none">
    <div id="back_button">
        Back to feed
    </div>
    <iframe id="i_frame" frameborder="0"></iframe>
</div>
<div id="main" style="display: none;">

</div>
<div id="preloader" style="text-align: center; padding-top: 70px;">
    Please wait while we are preparing your feed..<br>
    <img src="<?php echo SITE_DIR; ?>images/89.gif">
</div>

<script type="text/javascript">

    $ = jQuery.noConflict();
    $(document).ready(function () {

        $("body").on("click", ".like_btn", function () {
            var $button = $(this);
            var feed_id = $button.attr('data-id');
            var params = {
                'action': 'like_feed',
                'values': {feed_id: feed_id},
                'callback': function (msg) {
                    ajax_respond(msg,
                        function (respond) { //success
                            $button.closest('.likes').find('.dislike_btn').remove();
                            $button.remove();

                        },
                        function (respond) { //fail
                        }
                    );
                }
            };
            ajax(params);
        });

        $("body").on("click", ".dislike_btn", function () {
            var $button = $(this);
            var feed_id = $button.attr('data-id');
            var params = {
                'action': 'dislike_feed',
                'values': {feed_id: feed_id},
                'callback': function (msg) {
                    ajax_respond(msg,
                        function (respond) { //success
                            $button.closest('.likes').find('.like_btn').remove();
                            $button.remove();

                        },
                        function (respond) { //fail
                        }
                    );
                }
            };
            ajax(params);
        });

        var params = {
            'action': 'get_feed',
            'values': {page: 0},
            'callback': function (msg) {
                $("#main").append(msg);
                var $img = $("img");
                $img.error(function(){
                    $(this).hide();
                });
                $img.removeAttr('height');
                $img.removeAttr('width');
                $("iframe").removeAttr('height');
                $("iframe").removeAttr('width');
                $(".read_all").click(function() {
                    var $text = $(this).closest('.text');
                    $text.find('.short-text').remove();
                    $text.find('.full-text').slideDown();
                });
//        scroll();
                var swiper = new Swiper('.swiper-container', {
                    slidesPerView: 'auto',
                    centeredSlides: true,
                    spaceBetween: 10
                });
                $("#main").on("click", "a:not(#cat_link)", function (e) {
                    e.preventDefault();
                    $('#back').show();
                    $('#main').hide();
                    var link = $(this).attr('href');
                    $('#i_frame').attr('src', link);
                });
                setTimeout(function() {
                    $("#main").fadeIn();
                }, 1000);
                $(".big-image img").each(function() {
                    var $img = $(this);
                    var size = getImgSize($img.attr('src'));
                    if(size[0] < 100 || size[1] < 100) {
                        $(this).remove();
                    }
                });
//                $(document).ready(function() {
//
//                })
            }
        };
        ajax(params);

        $("#back_button").click(function() {
            $('#back').hide();
            $('#main').show();
        })
    });
    function getImgSize(imgSrc) {
        var newImg = new Image();
        var size = [];
        newImg.onload = function() {
            size[0] = newImg.width;
            size[1] = newImg.height;
        };
        newImg.src = imgSrc; // this must be done AFTER setting onload
        return size;
    }

//    function scroll() {
//        $(window).scroll(function() {
//            var height = $("#marker").offset().top;
//            if($(window).scrollTop() >= height - $(window).height()) {
//                $(window).unbind('scroll');
//                var params = {
//                    'action': 'get_article',
//                    'values': {id: $("#next_id").val()},
//                    'callback': function (msg) {
//                        ajax_respond(msg,
//                            function (respond) { //success
//                                setTimeout(function() {
//                                    $("#articles").append(respond.template);
//                                    $("#next_id").val(respond.next);
//                                    scroll();
//                                }, 3000);
//                            },
//                            function (respond) { //fail
//                            }
//                        );
//                    }
//                };
//                ajax(params);
//            }
//        })
//    }
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
    /*height: 300px;*/
}
@media only screen and (min-width: 500px) {
    /* line 13, ../scss/_extensions.scss */
    .big-image, body article.page .big-image {
        /*height: 420px;*/
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
    padding: 0 8px;
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
    /*margin-bottom: 3em;*/
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