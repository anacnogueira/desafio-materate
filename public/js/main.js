$(document).ready(function(){
	if($(".datepicker").val() != undefined) {
	    $('.datepicker').datepicker({
	      format: "dd/mm/yyyy",
	      language: "pt-BR",
	      autoclose: true
	    });
	}

	$("input[type='password']").focus(function(){
		$("input[type='password']").attr("readonly",false);
	});

	//$(".notifications-alert").html(10); 

	//Cep
  	$('.cep').blur(function(){
    	var cep = this.value.replace(/[^0-9]/gi, "");
    	if(cep.length != 8) return false;
    	$.getJSON('//viacep.com.br/ws/'+cep+'/json/', function(data){
    		//console.log(data);
        	if (typeof data.erro == 'undefined') {
          		$('#address').val(data.logradouro);
          		$('#neighborhood').val(data.bairro);
          		$('#city').val(data.localidade);
          		$("#state").val(data.uf);          
        	}
    	});
  	}).trigger('blur');     
});

function deleteConfirm(event, id){
	event.preventDefault();
	var form = document.getElementById("form"+id);

	swal({   
		title: "Tem certeza que deseja excluir o registro " + id + "?",   
		text: "Você não poderá recuperar esse registro após esta ação",   
		type: "warning",   
		showCancelButton: true, 
		cancelButtonText: "Cancelar",  
		confirmButtonColor: "#DD6B55",   
		confirmButtonText: "Sim",   
		closeOnConfirm: false 
	}, 
	function(isConfirm){  
		if(isConfirm){
			form.submit(); 
		} else {
			event.returnValue = false; 
			return false;
		}		
	});
}

