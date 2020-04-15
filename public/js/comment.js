$(document).ready(function() {
	
$.ajaxSetup({

headers: {

'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

}

});

	$('#Post_comment').click(function(){

		var comment = $('#imgcomm').val();
		$('#imgcomm').val('');
		var image_id = $(this).data('id');
		 var $ccom = $("#imgtable");

		$.ajax({

			type:'POST',

			url:'comment',

			data:{comment:comment , image_id:image_id},

			success:function(data){

				console.log(data.success);

				$("#imgtable").load(" #imgtable");
			}

		});

	});

});