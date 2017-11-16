<?php
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
<div class="header">
    <div class="container">
        <div class="logo animated wow pulse" data-wow-duration="1000ms" data-wow-delay="500ms">
            <h1><a href="index.html"><span>L</span><img src="<?= resource("/eshop-theme/images/oo.png");?>" alt=""><img src="<?= resource("/eshop-theme/images/oo.png");?>" alt="">kery</a></h1>
        </div>
        <div class="nav-icon">
            <a href="#" class="navicon"></a>
            <div class="toggle">
                <ul class="toggle-menu">
                    <li><a class="active" href="index.html">Home</a></li>
                    <li><a href="menu.html">Menu</a></li>
                    <li><a href="blog.html">Blog</a></li>
                    <li><a href="typo.html">Codes</a></li>
                    <li><a href="events.html">Events</a></li>
                    <li><a href="contact.html">Contact</a></li>
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
    <div class="banner">
        <p class="animated wow fadeInLeft" data-wow-duration="1000ms" data-wow-delay="500ms">Le meilleur magasin en ligne de nourriture mexicaine.</p>
        <label></label>
        <h4 class="animated wow fadeInTop" data-wow-duration="1000ms" data-wow-delay="500ms">Bienvenue sur Los Charros Hermanos</h4>
        <a class="scroll down" href="#content-down"><img src="<?= resource("/eshop-theme/images/down.png");?>" alt=""></a>
    </div>
</div>