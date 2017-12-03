
function removeFromCart(_productId){
	$.ajax({
        url: "index.php?url=user/removeFromCart",
        type: "POST",
        dataType: 'json',
        data: {productId:_productId},
		success: function(data){
			if(data == true){
				$("#rowProduct"+_productId).remove();
			}
			else if(data == "connectionRequired"){
                console.log(data);
			}
			else{
                console.log(data);
            }
		},
		error: function(response){
            console.log(response);
        }
	});
}

function updateAttributes(_productId){

    size = $("#rowProduct"+_productId+">td>.size").val();
    quantity = $("#rowProduct"+_productId+">td>.quantity").val();

    $.ajax({
        url: "index.php?url=user/addToCart",
        type: "POST",
        dataType: 'json',
        data: {productId:_productId,size:size,quantity:quantity},
        success: function(data){
            if(data == true){
                updateCost(_productId);
            }
            else if(data == "connectionRequired"){
                console.log(data);
            }
            else{
                console.log(data);
            }
        },
        error: function(response){
            console.log(response);
        }
    });
}

function updateCost(_productId){
    $.ajax({
        url: "index.php?url=user/calculateCost",
        type: "POST",
        dataType: 'json',
        data: {productId:_productId,size:size,quantity:quantity},
        success: function(data){
            if(data != 0){
                $("#cost"+_productId).html(data.toFixed(2)+"$");
            }
            else if(data == "connectionRequired"){
                console.log(data);
            }
            else{
                console.log(data);
            }
        },
        error: function(response){
            console.log(response);
        }
    });
}

function toggleArrow(){
    if($("#arrow").hasClass("glyphicon-menu-up")) {
        $("#arrow").removeClass("glyphicon-menu-up");
        $("#arrow").addClass("glyphicon-menu-down");
    }
    else{
        $("#arrow").removeClass("glyphicon-menu-down");
        $("#arrow").addClass("glyphicon-menu-up");
    }
}