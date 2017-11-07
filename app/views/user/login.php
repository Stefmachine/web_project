<div class="panel panel-primary col-lg-4 col-md-8 col-sm-12">
    <div class="panel-heading">
        Veuillez vous connecter pour continuer
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">
                <form id="login-form" role="form" action="<?= GlobalHelper::pageLink("user/validateLogin")?>" method="post">
                    <div class="form-group">
                        <label>Nom d'utilisateur</label>
                        <input class="form-control" name="username" id="username" placeholder="Nom d'utilisateur">
                    </div>
                    <div class="form-group">
                        <label>Mot de passe</label>
                        <input class="form-control" name="password" id="password" type="password">
                        <a href="<?= GlobalHelper::pageLink("user/passwordRecovery") ?>" class="help-block">Mot de passe oublié?</a>
                    </div>
                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="">Se souvenir de moi
                            </label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Se connecter</button>
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