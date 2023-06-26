$(document).ready(function () {
	calendar();
	navbar();
	pjaxNotificationReload();
	pjaxClick();
	To();
	clickChat();
	tops();
	clickClient();

	$(document).on('pjax:success', function (selector, xhr, status, selector, container) {
		if (container.container == '#pjax-click') {
			updateNotif();
		}
		calendar();
		clickChat();
		tops();
		clickClient();
		if (container.container == '#pjaxchild') {
			To();
		}
	});

});


function updateNotif() {
	var array = [];
	//Цикл получение id оповещения
	$('.ul-notif').children().each(function () {
		array.push($(this).attr('data-id'));

		//console.log($(this).attr('data-id'));
	});
	console.log(array);
	$.ajax({
		url: '/notification/flag-update',
		type: "get", //метод отправки
		dataType: "html", //формат данных
		data: { array: array.toString() },
		success: function (response) { //Данные отправлены успешно

		}
	});
}

function pjaxClick() {
	$(".notification-click").on("click", function () {
		$.pjax.reload({ container: '#pjax-click' });
	}
	)
}

function pjaxNotificationReload() {
	var timerId = setInterval(function () {
		$.pjax.reload({ container: '#pjax-grid-view' });
	}, 20000);

}

//выводим код календаря
function calendar() {

	if ($(".datepicker").length) {
		$(".datepicker").datepicker({
			dateFormat: 'yy-mm-dd',
			onSelect: function (dateText, inst) {

				if (!$(this).hasClass("index")) {
					var dt = new Date();
					var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
					$(this).val(dateText + ' ' + time);
				} else {
					$(this).val(dateText);
					$(this).trigger('change');
				}

			}
		});
	}
}


function navbar() {
	var current_url = window.location.pathname;
	$('.page-header a').each(function () {
		var link_url = $(this).attr('href');
		if (link_url == current_url) {
			$(this).parent().addClass('active');
		} else {
			$(this).parent().removeClass('active');
		}
	});
}

function To() {
	var user = $('#comments-to').val();
	$('.user-commnets-to').on("click", function () {
		var id = $(this).attr('data-id');
		var redactor = $('.redactor-editor');
		$('#comments-to').val(id);
		$('.who').html('<span class="to-user">Ответить:' + $(this).text() + '</span>' + '<br>' + '<span class="close-to">  	X</span>');

		$('.close-to').on("click", function () {
			$('#comments-to').val(user);
			$('.who').html('');
		});
	});


}

