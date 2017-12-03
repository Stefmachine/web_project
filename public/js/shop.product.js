
$("#addToCartForm").validate({
    rules:{
        size:{
            required : true
        },
        quantity:{
            required : true,
            min:1,
            max:20
        }
    },
    messages:{
        size:{
            required:"Vous devez sélectionner une taille"
        },
        quantity:{
            required:"Vous devez indiquer une quantité",
            min:"La quantité doit être supérieure à 0",
            max:"La quantité doit être égale ou inférieure à 20"
        }
    },
    submitHandler:function(form){
        addToCart($("#productId").val());
    }
});

function addToCart(_productId){
    alertDiv = $("#alertDiv");

    size = $("#size").val();
    quantity = $("#quantity").val();
    $.ajax({
        url: "index.php?url=user/addToCart",
        type: "POST",
        dataType: 'json',
        data: {productId:_productId,size:size,quantity:quantity},
        success: function(data){
            if(data == true){
                toggleInCart(_productId);
                alertMode(alertDiv,"success","Produit ajouté à votre commande avec succès");
            }
            else if(data == "connectionRequired"){
                alertMode(alertDiv,"info","Vous devez être connecté pour pouvoir ajouter un produit à votre panier");
            }
            else{
                alertMode(alertDiv,"warning","Il est impossible d'ajouter ce produit à votre commande");
            }
        },
        error: function(response){
            alertMode(alertDiv,"danger","Un problème est survenu");
        }
    });
}

function toggleInCart(_itemId){
    $("#addToCart").hide();
    $("#inCart").show();
}