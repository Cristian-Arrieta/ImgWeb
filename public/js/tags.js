    document.addEventListener('DOMContentLoaded', () => {
      document.querySelectorAll('input[type=text]').forEach( node => node.addEventListener('keypress', e => {
        if(e.keyCode == 13) {
          e.preventDefault();
        }
      }))
    });
function num(e) {
    evt = e ? e : event;
    tcl = (window.Event) ? evt.which : evt.keyCode;
		
    if ((tcl == 32 )||(tcl == 13))
    {        
			
			
			
			
			var tag = $("#tag").val().trim();
			
			var contenido;
			
			  var li = document.createElement("li");
			  li.className += "close";
			  var span = document.createElement("span");
			   span.className += "_icon-text";
			  contenido = "#" + tag;
			  span.appendChild(document.createTextNode(contenido));
			  document.querySelector(".tags").appendChild(li).appendChild(span);
			  
					
			$("#tag").val('');
			
			$(".close").click(function(){
				   $(this).remove();
			});
			
    }
		
}