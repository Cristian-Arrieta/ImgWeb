function btnCol()
{
	$('#galeria').removeClass("row").addClass("galeria");
	var gl = document.getElementsByClassName("CR");
	for (var i=0; i < gl.length ; i++)
	{
		gl[i].classList.remove("col-md-3");
		gl[i].classList.remove("mb-3");
	}
	$("#spRow").css({'color':'gray'});
	$("#spCol").css({'color':'black'});
}

function btnRow()
{
	$('#galeria').removeClass("galeria").addClass("row");
	var gl = document.getElementsByClassName("CR");
	for (var i=0; i < gl.length ; i++)
	{
		gl[i].classList.add("col-md-3");
		gl[i].classList.add("mb-3");
	}
	$("#spRow").css({'color':'black'});
	$("#spCol").css({'color':'gray'});
}