
<div id="fb-root"></div>
<?php if ($articles): ?>
    <?php foreach ($articles as $article): ?>
        <article class="page current">
            <?php if ($article['thumbnail']): ?>
                <div class="big-image" style="background-image: url(<?php echo $article['thumbnail']; ?>);"></div>
            <?php else: ?>
                <div style="width: 100%; height: 20px; background-color: #3e94c3;"></div>
            <?php endif; ?>
            <div class="feed-info">
                <hr>
                <div class="pull-left">
                    <?php if ($article['icon_url']): ?>
                        <img class="feed_icon" alt="<?php echo $article['feed_title']; ?>" title="<?php echo $article['feed_title']; ?>" src="<?php echo $article['icon_url']; ?>">
                    <?php endif; ?>
                    <span class="feed_title">
                    <?php echo $article['feed_title']; ?>
                    </span>
                    <div class="likes">
                        <button type="button" class="like_btn" style="border: none; background: none; padding: 0"><img src="<?php echo SITE_DIR; ?>images/like.png"></button>
                        <button type="button" class="dislike_btn" style="border: none; background: none; padding: 0"><img src="<?php echo SITE_DIR; ?>images/dislike.png"></button>
                    </div>
                </div>
                <div style="clear: both;"></div>
                <hr>
            </div>
            <div class="content">
                <h3 class="byline">
                    Published <time><?php echo date('F d, Y', strtotime($article['publish_date'])); ?></time> by <span class="author"><?php echo $article['author']; ?></span>
                </h3>
                <h1 class="title"><?php echo $article['title']; ?></h1>
                <h2 class="description"><?php echo $article['summary']; ?></h2>
                <div class="text">
                    <?php if (strlen($article['content']) > 200): ?>
                        <div class="short-text">
                            <?php echo tools_class::cropContent($article['content'], 200); ?>
                        </div>
                        <div class="full-text">
                            <?php echo $article['content']; ?>
                        </div>
                    <?php else: ?>
                        <?php echo $article['content']; ?>
                    <?php endif; ?>
                </div>
            </div>
            <br>
            <div style="text-align: center; margin-top: -20px; margin-bottom: 30px;">
                <button class="btn btn-default" style="width: 80%; padding: 8px; background-color: #fff;"><i class="fa fa-share"></i> Share </button>
                <hr>
            </div>
        </article>
    <?php endforeach; ?>
<?php endif; ?>
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
<div style="height: 100px;"></div>
