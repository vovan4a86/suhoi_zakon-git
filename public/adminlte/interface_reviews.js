function reviewsSave(form, e){
	e.preventDefault();

	var url = $(form).attr('action');
	var data = $(form).serialize();

	sendAjax(url, data, function(json){
		if (typeof json.errors != 'undefined') {
			applyFormValidate(form, json.errors);
			var errMsg = [];
			for (var key in json.errors) { errMsg.push(json.errors[key]);  }
			$(form).find('[type=submit]').after(autoHideMsg('red', urldecode(errMsg.join(' '))));
		}
		if (typeof json.redirect != 'undefined') document.location.href = urldecode(json.redirect);
		if (typeof json.msg != 'undefined') $(form).find('[type=submit]').after(autoHideMsg('green', urldecode(json.msg)));
	});
}

function reviewsDel(elem, e){
	e.preventDefault();
	if (!confirm('Удалить отзыв?')) return false;
	var url = $(elem).attr('href');
	sendAjax(url, {}, function(json){
		if (typeof json.success != 'undefined' && json.success == true) {
			$(elem).closest('tr').fadeOut(300, function(){ $(this).remove(); });
		}
	});
}

function reviewImageDel(el, e) {
	e.preventDefault();
	if (!confirm('Удалить изображение?')) return false;
	var url = $(el).attr('href');
	sendAjax(url, {}, function (json) {
		if (json.success === true) {
			$(el).closest('#article-image-block').html('');
		}
	});
}