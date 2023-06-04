$(document).ready(function() {	
calendar();
$(document).on( 'pjax:success' , function(selector, xhr, status, selector, container) {
	//if (container.container == '#pjaxContent') {
	//calendar();
    //}
	
	calendar();
 });

});


//выводим код календаря
function calendar() {
	
if ($(".datepicker").length){

$(".datepicker").datepicker({
	dateFormat: 'yy-mm-dd',
    onSelect : function(dateText, inst){
		var dt = new Date();
		var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
		$(this).val(dateText+' '+time);
    }
});
}
}