<div class="panel panel-default col-lg-4 col-md-8 col-sm-12">
    <div class="panel-heading">
        Veuillez vous connecter pour continuer
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">
                <form id="login-form" role="form" action="/public/user/validateLogin" method="post">
                    <div class="form-group">
                        <label>Nom d'utilisateur</label>
                        <input class="form-control" name="username" id="username" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <label>Mot de passe</label>
                        <input class="form-control" name="password" id="password" type="password">
                        <a class="help-block">Mot de passe oublié?</a>
                    </div>
                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="">Se rappeller de moi
                            </label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-default">Se connecter</button>
                </form>
            </div>
        </div>
    </div>
</div>