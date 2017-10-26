<?php ob_start(); ?>
    <h2>Nous apprécions votre point de vue!</h2>

    <div class="container text-center">
        <i class="glyphicon big-icon glyphicon-envelope"></i>

        <div>
            C'est pourquoi nous vous offrons la possibilité de nous communiquer votre opinion.
        </div>
        <div class="col-sm-3">
        </div><div class="col-sm-6">
            <div class="form-area">
                <form role="form">
                    <br style="clear:both">
                    <h3 style="margin-bottom: 25px;">Contact Form</h3>
                    <div class="form-group">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" type="textarea" id="message" placeholder="Message" maxlength="140" rows="7"></textarea>
                        <span class="help-block"><p id="characterLeft" class="help-block ">You have reached the limit</p></span>
                    </div>

                    <button type="button" id="submit" name="submit" class="btn btn-primary">Submit Form</button>
                </form>
            </div>
        </div>
        <div class="col-sm-3">
        </div>
    </div>

<?php $content = ob_get_clean();