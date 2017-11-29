function addToCart(_productId){
    alertDiv = $("#alert"+_productId);
    $.ajax({
        url: "index.php?url=user/addToCart",
        type: "POST",
        dataType: 'json',
        data: {productId:_productId},
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
    $("#addToCart"+_itemId).hide();
    $("#inCart"+_itemId).show();
}