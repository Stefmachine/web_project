// JavaScript Document
$(document).ready(
	function() {
		$("#lst_departement").change(OnIndexChanged);
	}
);

function OnIndexChanged()
{	
	var selected_dept = $("#lst_departement option:selected");
	
	$.ajax( {
		url : "liste_prof.php",
		type : 'POST',
		data : {no_departement:selected_dept.val()},   
		success : function(output) {
			  //ici on envoie le résultat de la réponse dans la div txt_prof
			  $('#display_area').html(output); 
			  }			
	});
}