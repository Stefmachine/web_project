function addToCart(_itemId){
    alertDiv = $("#alert"+_itemId);
    $.ajax({
        url: "index.php?url=user/addToCart",
        type: "POST",
        dataType: 'json',
        data: {productId:_itemId},
        success: function(data){
            if(data == true){
                alertDiv.removeClass("alert-warning");
                alertDiv.removeClass("alert-danger");
                alertDiv.removeClass("hidden");
                alertDiv.addClass("alert-success");
                alertDiv.html("Produit ajouté à votre commande avec succès");
            }
            else{
                alertDiv.removeClass("alert-success");
                alertDiv.removeClass("alert-danger");
                alertDiv.removeClass("hidden");
                alertDiv.addClass("alert-warning");
                alertDiv.html("Il est impossible d'ajouter ce produit à votre commande");
            }
        },
        error: function(){
            alertDiv.removeClass("alert-success");
            alertDiv.removeClass("alert-warning");
            alertDiv.removeClass("hidden");
            alertDiv.addClass("alert-danger");
            alertDiv.html("Un problème est survenu");
        }
    });
}