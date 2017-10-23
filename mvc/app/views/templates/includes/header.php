<?php
$pageExceptions = array("error");
if(empty($_SESSION["connectedUser"])){
    $pageExceptions[] = "logout";
}
else{
    $pageExceptions[] = "login";
}
?>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="/controller/pageLoader.php?page=home">OOZE</a>
    </div>
    <ul class="nav navbar-nav navbar-right user-icons">
		<?php
			foreach (getAllLinks() as $pageName => $attributes) {
				if(!in_array($pageName,$pageExceptions)) {
					if ($pageName != "login" && $pageName != "cart" && $pageName != "profile" && $pageName != "logout" ) {
						?><li><a href="<?= "/controller/pageLoader.php?page=$pageName" ?>"><?= isset($attributes["title"])? $attributes["title"] : "Page inconnue" ?></a></li><?php
					}
				}
			}
		?>
	
		<div class="col-sm-4"><a href="/controller/pageLoader.php?page=cart" class="glyphicon glyphicon-shopping-cart"></a></div>
		<div class="col-sm-4"><a href="/controller/pageLoader.php?page=profile" class="glyphicon glyphicon-user"></a></div>
		<div class="col-sm-4"><a href="/controller/pageLoader.php?page=logout" class="glyphicon glyphicon-log-out"></a></div>

    </ul>
  </div>
</nav>