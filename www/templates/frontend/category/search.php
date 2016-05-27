<div class="container">
    <div class="row">
        <?php foreach ($feeds as $feed): ?>
            <div class="col-md-4 col-sm-6">
                <div class="feed">
                    <?php if ($feed['visual_url']): ?>
                        <img src="<?php echo $feed['icon_url']; ?>" alt="<?php echo $feed['title']; ?>">
                    <?php endif; ?>
                    <span class="feed-title">
                        <?php echo $feed['title']; ?>
                    </span>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>