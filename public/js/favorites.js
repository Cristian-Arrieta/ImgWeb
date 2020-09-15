$(document).ready(function() {

$.ajaxSetup({

headers: {

'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

}

});

$('#action-favorite').click(function(){

var image_id = $(this).data('id');

var cObj = $(this);

$.ajax({

type:'POST',

url:'favorite',

data:{image_id:image_id},

success:function(data){

console.log(data.success);

if(jQuery.isEmptyObject(data.success.attached)){


cObj.find("strong").text("Favorite ");

}else{

cObj.find("strong").text("UnFavorite ");


}

}

});

});

});