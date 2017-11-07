<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Site web pour projet final en web III">
    <meta name="author" content="Christian Medel & Stéphane Godin">

    <title><?= $_data["pageConfigs"]->getTitle(); ?></title>

    <!-- Bootstrap Core CSS -->
    <link href="<?= resource("/bootstrap/theme-sb-admin-2-gh/vendor/bootstrap/css/bootstrap.min.css") ?>" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?= resource("/bootstrap/theme-sb-admin-2-gh/vendor/metisMenu/metisMenu.min.css"); ?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?= resource("/bootstrap/theme-sb-admin-2-gh/dist/css/sb-admin-2.css");?>" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?= resource("/bootstrap/theme-sb-admin-2-gh/vendor/morrisjs/morris.css");?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?= resource("/bootstrap/theme-sb-admin-2-gh/vendor/font-awesome/css/font-awesome.min.css");?>" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="<?= resource("css/master.css"); ?>" type="text/css">

    <script src="<?= resource("/bootstrap/theme-sb-admin-2-gh/vendor/jquery/jquery.min.js");?>" ></script>
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

</head>

<body>

<div id="wrapper">
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <?php include_once "includes/header.php"; ?>
        <?php include_once "includes/sidebar.php"; ?>
    </nav>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><?= $_data["pageConfigs"]->getTitle(); ?></h1>
            </div>
        </div>
        <?= $content ?>
    </div>
</div>

<!-- jQuery -->

<!-- Bootstrap Core JavaScript -->
<script src="<?= resource("/bootstrap/theme-sb-admin-2-gh/vendor/bootstrap/js/bootstrap.min.js");?>" ></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="<?= resource("/bootstrap/theme-sb-admin-2-gh/vendor/metisMenu/metisMenu.min.js");?>" ></script>

<!-- Custom Theme JavaScript -->
<script src="<?= resource("/bootstrap/theme-sb-admin-2-gh/dist/js/sb-admin-2.js");?>" ></script>

<script src="<?= resource("/jquery-validation-1.17.0/dist/jquery.validate.js") ?>"></script>

</body>

</html>