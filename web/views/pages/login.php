<?php ob_start(); ?>
	
	<div class="container-fluid text-center">
		<div class="col-sm-4"></div>
		<div class="col-sm-4">
		<i class="glyphicon glyphicon-globe big-icon"></i>
		<h4>Veuillez vous connecter pour continuer</h4>
			<form id="login-form" action="/controller/pageLoader.php?page=process_login" method="post" role="form" style="display: block;">
				<div class="form-group">
					<input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="">
				</div>
				<div class="form-group">
					<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
				</div>
				<div class="form-group text-center">
					<input type="checkbox" tabindex="3" class="" name="remember" id="remember">
					<label for="remember"> Remember Me</label>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-sm-6 col-sm-offset-3">
							<input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
						</div>
					</div>
				</div>
			</form>
		</div>
		<div class="col-sm-4"></div>
	</div>
		
<?php $content = ob_get_clean();