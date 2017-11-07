<div class="panel panel-primary col-lg-4 col-md-8 col-sm-12">
    <div class="panel-heading">
        Veuillez entrer votre adresse e-mail
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">
                <form id="login-form" role="form" action="<?= GlobalHelper::pageLink("user/sendPassword")?>" method="post">
                    <div class="form-group">
                        <input class="form-control" name="e-mail" id="e-mail" placeholder="example@email.com">
                    </div>
                    <button type="submit" class="btn btn-primary">Envoyer le message</button>
                </form>
            </div>
        </div>
    </div>
</div>