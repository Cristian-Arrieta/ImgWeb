$(document).ready(function() {

$.ajaxSetup({

headers: {

'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

}

});

$('#action-like').click(function(){

var image_id = $(this).data('id');

var cObj = $(this);

var c = $("#like_count").text();

$.ajax({

type:'POST',

url:'like',

data:{image_id:image_id},

success:function(data){

console.log(data.success);

if(jQuery.isEmptyObject(data.success.attached)){


cObj.find("strong").text("Like : ");
$("#like_count").text(parseInt(c)-1);

}else{

cObj.find("strong").text("UnLike : ");
$("#like_count").text(parseInt(c)+1);


}

}

});

});

});