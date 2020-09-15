
$(function() {
  var $ccom = $("#imgtable");
  var $ul = $("ul.pagination");
 // Prevent the default Laravel paginator from showing, but we need the links...
 $ul.hide();
 
  $("#see-more").click(function() {
	  if ($ul.find("a[rel='next']").attr("href") != null){
      $.get($ul.find("a[rel='next']").attr("href"), function(response) {
           $ccom.append(
               $(response).find("#imgtable").html()
           );
      });
	  }
	
	  $ur = $ul.find("a[rel='next']").attr("href");
	  $num = $ur.substring($ur.length-1 , $ur.length);
	  $ur = $ur.substring(0, $ur.length - 1);
	  ++$num;
	  $ur = $ur + $num
	 
	   $ul.find("a[rel='next']").attr("href", $ur);  
  });
});