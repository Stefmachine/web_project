<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
<head>
    <title><?= $_data["pageConfigs"]["title"]; ?></title>
    <link href="<?= resource("/vendor/bootstrap/css/bootstrap.min.css");?>" rel="stylesheet" type="text/css" media="all" />
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?= resource("/vendor/jquery/jquery.min.js");?>"></script>
    <!-- Custom Theme files -->
    <!--theme-style-->
    <link href="<?= resource("/eshop-theme/css/style.css");?>" rel="stylesheet" type="text/css" media="all" />
    <!--//theme-style-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!---->
    <link href='//fonts.googleapis.com/css?family=Raleway:400,200,100,300,500,600,700,800,900' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Open+Sans+Condensed:300,300italic,700' rel='stylesheet' type='text/css'>
    <!-- start-smoth-scrolling -->
    <script type="text/javascript" src="<?= resource("/eshop-theme/js/move-top.js");?>"></script>
    <script type="text/javascript" src="<?= resource("/eshop-theme/js/easing.js");?>"></script>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $(".scroll").click(function(event){
                event.preventDefault();
                $('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
            });
        });
    </script>
    <!-- start-smoth-scrolling -->
    <link href="<?= resource("/eshop-theme/css/styles.css");?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?= resource("/eshop-theme/css/component.css");?>" />
    <!-- animation-effect -->
    <link href="<?= resource("/eshop-theme/css/animate.min.css");?>" rel="stylesheet">
    <script src="<?= resource("/eshop-theme/js/wow.min.js");?>"></script>
    <script>
        new WOW().init();
    </script>
    <script src="<?= resource("/jquery-validation-1.17.0/dist/jquery.validate.js") ?>"></script>
    <!-- //animation-effect -->
    <link rel="stylesheet" href="<?= resource("/css/master.css");?>">
</head>
<body>
<?php include_once "includes/header.php"; ?>
<div class="content" id="content-down">
    <?= $content ?>
</div>
<?php include_once "includes/footer.php"; ?>
</body>
</html>