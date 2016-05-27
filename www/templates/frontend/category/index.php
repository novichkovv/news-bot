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
           <a href="<?php echo SITE_DIR; ?>category/search/?q=<?php echo $key; ?>">
               <div class="col-md-4 col-sm-6">
                   <div class="category">
                       <img src="<?php echo SITE_DIR; ?>images/topics/<?php echo $key; ?>.jpeg" alt="<?php echo $item['title']; ?>">
                       <div class="title" style="background-color: <?php echo $item['bg']; ?>; color: <?php echo $item['color']; ?>">
                           <?php echo $item['title']; ?>
                       </div>
                   </div>
               </div>
           </a>
       <?php endforeach; ?>
    </div>
</div>