<div class="container s-10">
    <div class="panel panel-fitIn col-lg-6 col-md-8 col-sm-12 col-lg-offset-3 col-md-offset-2 col-sm-offset-0">
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
                        <button type="submit" class="btn btn-fitIn">Envoyer le message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>