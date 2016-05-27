<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Backend</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link rel="icon" href="<?php echo SITE_DIR; ?>images/main/favicon.gif" type="image/x-icon">
    <link href="<?php echo SITE_DIR; ?>css/libs/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo SITE_DIR; ?>fonts/awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo SITE_DIR; ?>css/libs/jquery-ui.min.css" type="text/css" rel="stylesheet" />
    <link href="<?php echo SITE_DIR; ?>css/libs/select2.min.css" type="text/css" rel="stylesheet" />
<!--    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css">-->
    <link href="<?php echo SITE_DIR; ?>js/libs/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo SITE_DIR; ?>js/libs/uniform/css/uniform.default.css" rel="stylesheet" type="text/css">
    <link href="<?php echo SITE_DIR; ?>js/libs/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css">
    <link href="<?php echo SITE_DIR; ?>js/libs/morris/morris.css" rel="stylesheet" type="text/css">
    <link href="<?php echo SITE_DIR; ?>css/backend/theme/plugins.css" rel="stylesheet" type="text/css">
    <link href="<?php echo SITE_DIR; ?>css/backend/theme/components.css" id="style_components" rel="stylesheet" type="text/css">
    <link href="<?php echo SITE_DIR; ?>css/backend/theme/layout.css" rel="stylesheet" type="text/css">
    <link href="<?php echo SITE_DIR; ?>js/libs/fancybox/source/jquery.fancybox.css" rel="stylesheet" type="text/css">
    <link href="<?php echo SITE_DIR; ?>js/libs/icheck/skins/minimal/minimal.css" rel="stylesheet" type="text/css">
    <link href="<?php echo SITE_DIR; ?>css/backend/theme/custom.css" rel="stylesheet" type="text/css">

    <?php if ($styles): ?>
        <?php foreach ($styles as $style): ?>
            <link href="<?php echo SITE_DIR; ?>css/<?php echo $style; ?>.css" type="text/css" rel="stylesheet" />
        <?php endforeach; ?>
    <?php endif; ?>

    <script src="<?php echo SITE_DIR; ?>js/libs/jquery.min.js" type="text/javascript"></script>
    <script src="<?php echo SITE_DIR; ?>js/backend/theme/metronic.js" type="text/javascript"></script>
    <script src="<?php echo SITE_DIR; ?>js/backend/theme/layout.js" type="text/javascript"></script>
    <script src="<?php echo SITE_DIR; ?>js/libs/jquery-ui.min.js" type="text/javascript"></script>
    <script src="<?php echo SITE_DIR; ?>js/libs/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo SITE_DIR; ?>js/libs/fancybox/source/jquery.fancybox.js" type="text/javascript"></script>
    <script src="<?php echo SITE_DIR; ?>js/libs/select2.min.js"></script>
    <script src="<?php echo SITE_DIR; ?>js/libs/notifier.js" type="text/javascript"></script>
    <script src="<?php echo SITE_DIR; ?>js/libs/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="<?php echo SITE_DIR; ?>js/backend/theme/app.js" type="text/javascript"></script>
    <script src="<?php echo SITE_DIR; ?>js/libs/icheck/icheck.min.js" type="text/javascript"></script>
    <script src="<?php echo SITE_DIR; ?>js/common/common.js" type="text/javascript"></script>
    <script src="<?php echo SITE_DIR; ?>js/backend/script.js" type="text/javascript"></script>
    <?php if ($scripts): ?>
        <?php foreach ($scripts as $script): ?>
            <script src="<?php echo SITE_DIR; ?>js/<?php echo $script; ?>.js" type="text/javascript"></script>
        <?php endforeach; ?>
    <?php endif; ?>
</head>








