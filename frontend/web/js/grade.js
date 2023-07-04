$(document).ready(function () {
	grade();
});

function grade() {
	var url = window.location.href;
	var parser = document.createElement("a");
	parser.href = url;
	$('#select-grade').children().each(function(){
		
		if($(this).val() == parser.pathname+parser.search) {
			$(this).attr("selected","selected");
		}
	});
}