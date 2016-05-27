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
</article>
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