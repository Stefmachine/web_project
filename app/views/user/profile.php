<?php
/**
 * @type User $user
 */
$user = $_data["user"]; ?>
<div class="container">
	<div class="panel-heading">
		<h4><?= "Profile page of ",$user->getUsername(); ?></h4>
	</div>
	
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="row">
				<div class="col-md-6">
					<h4>Prénom</h4><?= $user->getFirstName(); ?>
				</div>
				<div class="col-md-6">
					<h4>Nom</h4><?= $user->getLastName(); ?>
				</div>
			</div>
			<hr>
			<h4>Courriel</h4><?= $user->getEmail(); ?>
		</div>
	</div>
</div>