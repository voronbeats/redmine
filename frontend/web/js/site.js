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
	resend();
		if (container.container == '#pjax-click') {
			updateNotif();
		}
		resend();
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
	$('.user-comment-to').on("click", function () {
		var id = $(this).attr('data-userId');
		var redactor = $('.redactor-editor');
		$('#comments-to').val(id);
		$('.who').html('<span class="to-user">Ответить:' + $(this).text() + '</span>' + '<br>' + '<span class="close-to">  	X</span>');

		$('.close-to').on("click", function () {
			$('#comments-to').val(user);
			$('.who').html('');
		});
	});
}



function resend() {
	$('.redact').on("click", function() {	
		$('.redact-del').remove();
        $(this).parent().append('<div class="redact-del"><i id="cross" style="cursor: pointer; color: red;" class="fa fa-times cross-resend" aria-hidden="true"></i><div id="addRedactor"></div><button id="redcom" class="btn btn-success">Сохранить</button></div>');
		jQuery('#addRedactor').redactor({"lang":"ru","minHeight":200,"formatting":["h1","h2","p","blockquote"],"plugins":["clips","fullscreen","video","fontcolor","fontfamily","fontsize"],"imageUpload":"/ajax/save-redactor-img?sub=article","imageDelete":"/ajax/save-img-del","clips":[["Красный","Здесь вставить текст"],["Зеленый","Здесь вставить текст"],["Голубой","Здесь вставить текст"]],"uploadImageFields":{"_csrf":"aYx22FYLWi9HoBWWkdXQj3Ou32XDoVbOWKiO6mX3iFkt2SPsHjozZgTBYqbkgbrNMv-8JIjODK0XxfS5PLm-AA=="},"uploadFileFields":{"_csrf":"aYx22FYLWi9HoBWWkdXQj3Ou32XDoVbOWKiO6mX3iFkt2SPsHjozZgTBYqbkgbrNMv-8JIjODK0XxfS5PLm-AA=="},"imageUploadErrorCallback":function (response) { alert("Во время процесса загрузки произошла ошибка!"); }})
		$('#addRedactor').html($(this).next().next().html());
		//  $(this).parent().append('<div class="redact-del"><i id="cross" style="cursor: pointer; color: red;" class="fa fa-times cross-resend" aria-hidden="true"></i><input value="'+$(this).next().text()+'" id="redinput" class="form-control top-input-text" type="text"/><a id="redcom" class="btn btn-success">Сохранить</a></div>');
	    var comId = $(this).next().next().attr('id');

		$('#cross').on("click", function() {
			$('.redact-del').remove();
		});
			$('#redcom').on("click", function() {			
				var text = $('#addRedactor').html();
				var text_id = $('.user-comment-to').attr('data-id');
				var user_id = $('.user-comment-to').attr('data-userId');
				$.ajax({
					url: '/ajax/resend',
					type: "get", //метод отправки
					dataType: "html", //формат данных
					data: { text:text, comment_id:text_id, user_id:user_id },
					success: function (response) { //Данные отправлены успешно
						$.pjax.reload({ container: '#p0' });
					}
				});
				
			});
});
}

