<?php

$enableBanner = (!empty($_data["pageConfigs"]["banner"]) ? $_data["pageConfigs"]["banner"] : false);

/**
 * @var PageConfig[] $allConfigs
 */
$allConfigs = $_data["configs"];
/**
 * @type User $userId
 */
$userId = !empty($_SESSION["user"]) ? $_SESSION["user"] : "" ;
if(!empty($userId)){
    $rep = new UserRepository();
    $user = $rep->find($userId);
    $this->model("User");
}
?>
<div class="header <?= $enableBanner ? "" : "head" ?>">
    <div class="container">
        <div class="logo animated wow pulse" data-wow-duration="1000ms" data-wow-delay="500ms">
            <h1><a class="navbar-brand" href="<?= GlobalHelper::pageLink("home/index"); ?>">LOS CHARROS HERMANOS</a></h1>
        </div>
        <div class="nav-icon">
            <a href="#" class="navicon"></a>
            <div class="toggle">
                <ul class="toggle-menu">
                    <li><a href="<?= GlobalHelper::pageLink("home/index"); ?>"> Accueil </a></li>
                    <li><a href="<?= GlobalHelper::pageLink("shop/index"); ?>"> Menu </a></li>
                    <li><a href="<?= GlobalHelper::pageLink("home/contact"); ?>"> Nous joindre </a></li>
                </ul>
                <hr>
                <ul class="toggle-menu">
                    <li><a href="<?= GlobalHelper::pageLink("user/cart"); ?>"> Panier </a></li>
                    <?php if(empty($user)){ ?>
                        <li><a href="<?= GlobalHelper::pageLink("user/login"); ?>"> Connexion </a></li>
                    <?php } else { ?>
                        <li><a href="<?= GlobalHelper::pageLink("user/profile"); ?>"> Profile </a></li>
                        <li><a href="<?= GlobalHelper::pageLink("user/logout"); ?>"> Déconnexion </a></li>
                    <?php } ?>
                </ul>
            </div>
            <script>
                $('.navicon').on('click', function (e) {
                    e.preventDefault();
                    $(this).toggleClass('navicon--active');
                    $('.toggle').toggleClass('toggle--active');
                });
            </script>
        </div>
        <div class="clearfix"></div>
    </div>
    <?php if($enableBanner){ ?>
    <div class="banner">
        <p class="animated wow fadeInLeft" data-wow-duration="1000ms" data-wow-delay="500ms">Le meilleur restaurant mexicain en ligne.</p>
        <label></label>
        <h4 class="animated wow fadeInTop" data-wow-duration="1000ms" data-wow-delay="500ms">Bienvenue sur Los Charros Hermanos</h4>
        <a class="scroll down" href="#content-down"><img src="<?= resource("/eshop-theme/images/down.png");?>" alt=""></a>
    </div>
    <?php } ?>
</div>
