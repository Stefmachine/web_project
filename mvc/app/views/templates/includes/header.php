<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="<?= $this->getRoute("index","home"); ?>">OOZE</a>
    </div>
    <ul class="nav navbar-nav navbar-right user-icons">
		<?php
			foreach ($this->getAllRoutes() as $route) {
                ?><li><a href="<?= $route ?>"><?= isset($title)? $title : "Page inconnue" ?></a></li><?php
			}
		?>
	
		<div class="col-sm-4"><a href="" class="glyphicon glyphicon-shopping-cart"></a></div>
		<div class="col-sm-4"><a href="" class="glyphicon glyphicon-user"></a></div>
		<div class="col-sm-4"><a href="" class="glyphicon glyphicon-log-out"></a></div>

    </ul>
  </div>
</nav>