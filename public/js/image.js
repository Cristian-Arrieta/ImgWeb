function init() {

	$(".close").click(function(){
				   $(this).remove();
			});
	
	$(document).ready(function(){
		$("#ok").click(function(){
			$("#tag").val('');
			$("._icon-text").each(function(){
        	    
				$("#tag").val($("#tag").val()+' '+$(this).text());
        	});
			
			
		});
	});
	
	var inputFile = document.getElementById('file');
  inputFile.addEventListener('change', mostrarImagen, false);											  
}

function mostrarImagen(event) {
  var file = event.target.files[0];
  var reader = new FileReader();
  reader.onload = function(event) {
    var img = document.getElementById('uploadForm');
    img.src= event.target.result;
  }
  reader.readAsDataURL(file);
}

window.addEventListener('load', init, false);