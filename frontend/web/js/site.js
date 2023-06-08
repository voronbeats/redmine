$(document).ready(function () {
	calendar();
	navbar();
	$(document).on('pjax:success', function (selector, xhr, status, selector, container) {
		//if (container.container == '#pjaxContent') {
		//calendar();
		//}
		calendar();
	});

});


//выводим код календаря
function calendar() {

	if ($(".datepicker").length) {
		$(".datepicker").datepicker({
			dateFormat: 'yy-mm-dd',
			onSelect: function (dateText, inst) {
				var dt = new Date();
				var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
				$(this).val(dateText + ' ' + time);
			}
		});
	}
}


function navbar() {
	var current_url = window.location.pathname;
	$('.page-header a').each(function () {
		var link_url = $(this).attr('href');
		if (link_url == current_url ) {
			$(this).parent().addClass('active');
		} else {
			$(this).parent().removeClass('active');
		}
	});
}