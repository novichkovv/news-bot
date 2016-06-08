<div class="container">
    <div class="row">
        <div class="col-md-offset-2 col-md-8">
            <label>Discover and add content to your feed</label>
            <input type="text" class="form-control" placeholder="Search by title, Url or #topic">
        </div>
    </div>
    <br>
    <br>
    <br>
    <h3>THE BEST OF THE WEB</h3>
    <div class="row">
        <?php foreach ($list as $key => $item): ?>
            <!--           <a href="--><?php //echo SITE_DIR; ?><!--category/search/?q=--><?php //echo $key; ?><!--">-->
            <a href="#modal" data-key="<?php echo $key; ?>" data-toggle="modal" class="modal-btn">
                <div class="col-md-4 col-sm-6">
                    <div class="category">
                        <img src="<?php echo SITE_DIR; ?>images/topics/<?php echo $key; ?>.jpeg" alt="<?php echo $item['title']; ?>">
                        <div class="title" style="background-color: <?php echo $item['bg']; ?>; color: <?php echo $item['color']; ?>">
                            <?php echo $item[$locale]; ?>
                        </div>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</div>
<div class="modal fade" id="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <div class="cat-container">

                </div>
                <h2 style="color: #ccc;" class="text-center">SUBSCRIBED!</h2>
                <div class="text-center">
                    <a href="<?php echo SITE_DIR; ?>" type="button" class="button">READ MY FEED</a><br><br>
                    <button type="button" class="button" data-dismiss="modal">SUBSCRIBE MORE</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $ = jQuery.noConflict();
    $(document).ready(function () {
        $(".modal-btn").click(function() {
            var category = $(this).find('.category').clone();
            var key = $(this).attr('data-key');
            var params = {
                'action': 'subscribe',
                'values': {'category': key},
                'callback': function (msg) {

                }
            };
            ajax(params);
            $(".cat-container").html(category);
        });
    });
</script>
<style>
    .button {
        width: 90%;
        padding: 10px;
        border: none;
        background: rgba(255,255,255,0.7);
        display: block;
        text-decoration: none;
        color: #666;
        font-weight: bold;
        margin: 0 auto;
    }
    .modal-content {
        position: relative;
        background-color: rgba(0,0,0,0.3);
        border: 1px solid #999;
        border: 1px solid rgba(0,0,0,0.2);
        border-radius: 0;
        outline: 0;
        -webkit-box-shadow: 0 3px 9px rgba(0,0,0,0.5);
        box-shadow: 0 3px 9px rgba(0,0,0,0.5);
        background-clip: padding-box;
    }
    .modal-header {
        border-bottom: none;
    }
</style>