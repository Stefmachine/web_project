$("#login-form").validate({
    rules:{
        username:{
            required:true,
            remote:{
                url:"index.php?url=user/checkUserName",
                type:"POST",
                dataType:"json",
                data:{username:$("#usename").val()}
            }
        },
        password:{
            required:true
        }
    },
    messages:{
        username:{
            required:"Vous devez inscrire un nom d'utilisateur.",
            remote:"Ce nom d'utilisateur n'existe pas."
        },
        password:{
            required:"Vous devez inscrire un mot de passe."
        }
    }
});
