<div class="container s-10">
	<div class="panel panel-fitIn col-lg-4 col-md-8 col-sm-12">
		<div class="panel-heading">
			Veuillez vous connecter pour continuer
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-lg-12">
					<form id="login-form" role="form" action="<?= GlobalHelper::pageLink("user/validateLogin")?>" method="post">
						<div class="form-group">
							<label for="username">Nom d'utilisateur</label>
							<input class="form-control" name="username" id="username" placeholder="Nom d'utilisateur">
						</div>
						<div class="form-group">
							<label for="password">Mot de passe</label>
							<input class="form-control" name="password" id="password" type="password">
							<a href="<?= GlobalHelper::pageLink("user/passwordRecovery") ?>" class="help-block">Mot de passe oublié?</a>
						</div>
						<div class="form-group">
							<div class="checkbox">
								<label>
									<input name="save-session" type="checkbox" value="">Se souvenir de moi
								</label>
							</div>
						</div>
						<button type="submit" class="btn btn-fitIn">Se connecter</button>
					</form>
				</div>
			</div>
		</div>
		<?php if(!empty($_data["type"])){
			$cssClass = ($_data["type"] == "error") ? "alert-danger" : "alert-success";
		} ?>
		<div class="panel-footer <?= (isset($cssClass) ? $cssClass : ""); ?>">
			<div class="row">
				<div class="col-lg-12">
					<div>
						<?php if(!empty($_data["type"])){ ?>
							<div><?= $_data["message"] ?></div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-8 text-center s-40 m-20 align-center">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<img src="<?= resource('/eshop-theme/images/me1.jpg') ?>" class="img-thumbnail"/>
			</div>
		</div>
		<div class="row s-10">
			<i><h2>Connectez-vous pour avoir accès au magasin en ligne et à des offres aussi alléchantes que nos plats!</h2></i>
		</div>
	</div>
</div>