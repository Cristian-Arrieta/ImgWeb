$(document).ready(function() {
$.ajaxSetup({

headers: {

'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

}

});
         $('#buttonRead').click(function(){
            $.ajax({
               url:'read',
               type:'get',
               success:function(data){
				console.log(data.success);
				if(jQuery.isEmptyObject(data.success.attached)){
				   $("#countNoty").text('0');
               }
			   else{
					$("#notifyc").load(" #notifyc");
				}
            }
    });
	});
	});