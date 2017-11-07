<?php
/**
 * @var Exception $error
 */
$error = $_data["error"]; ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 text-center">
            <div class="row">
                <div class="col-lg-12">
                    <i class="glyphicon big-icon red glyphicon-remove-sign"></i>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Une erreur est survenue.</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="">Erreur: <?= $error->getMessage(); ?></h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <a class="btn btn-primary" href="<?= GlobalHelper::pageLink("home/index")?>" >Retour à la page d'accueil</a>
                </div>
            </div>
        </div>
    </div>
</div>