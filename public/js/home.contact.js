$("#contact-form").validate({
    rules:{
        firstname:{
            required:true
        },
        lastname:{
            required:true
        },
        email:{
            required:true,
            email:true
        },
        telephone:{
            required:true
        },
        message:{
            required:true,
            maxlength:200
        }
    },
    messages:{
        firstname:{
            required:"Vous devez inscrire votre prénom."
        },
        lastname:{
            required:"Vous devez inscrire votre nom de famille."
        },
        email:{
            required:"Vous devez inscrire votre e-mail.",
            email:"L'adresse e-mail inscrite est invalide."
        },
        telephone:{
            required:"Vous devez inscrire votre numéro de téléphone."
        },
        message:{
            required:"Vous devez inscrire un message.",
            maxlength:"Votre texte doit contenir moins de 200 caractères."
        }
    }
});