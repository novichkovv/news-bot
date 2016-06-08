<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title><?php echo $meta['title']; ?></title>
    <meta name="description" content="<?php echo $meta['description']; ?>" />
    <meta name="keywords" content="<?php echo $meta['keywords']; ?>" />
    <meta name="author" content="<?php echo $meta['author']; ?>" />
    <link rel="shortcut icon" href="favicon.ico">
    <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700,400italic,700italic|PT+Serif:400,700,400italic,700italic" rel="stylesheet" type="text/css">
<!--    <link rel="stylesheet" type="text/css" href="--><?php //echo SITE_DIR; ?><!--css/libs/bootstrap.min.css" />-->
    <link rel="stylesheet" type="text/css" href="<?php echo SITE_DIR; ?>css/libs/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo SITE_DIR; ?>css/libs/responsive.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo SITE_DIR; ?>css/libs/swiper.min.css" />
    <?php foreach($styles as $style): ?>
        <link rel="stylesheet" type="text/css" href="<?php echo $style; ?>" />
    <?php endforeach; ?>
    <link rel="stylesheet" type="text/css" href="<?php echo SITE_DIR; ?>css/frontend/style.css" />
    <!--[if IE]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script type="text/javascript" src="<?php echo SITE_DIR; ?>js/libs/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo SITE_DIR; ?>js/libs/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo SITE_DIR; ?>js/libs/swiper/swiper.min.js"></script>
    <script type="text/javascript" src="<?php echo SITE_DIR; ?>js/common/common.js"></script>
</head>

<body>
