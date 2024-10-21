function archiveSave(form, e){
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

function archiveDel(elem, e){
	e.preventDefault();
	if (!confirm('Удалить отзыв?')) return false;
	var url = $(elem).attr('href');
	sendAjax(url, {}, function(json){
		if (typeof json.success != 'undefined' && json.success == true) {
			$(elem).closest('tr').fadeOut(300, function(){ $(this).remove(); });
		}
	});
}

function archiveUploadMagazine(elem, e) {
	var url = $(elem).data('url');
	files = e.target.files;
	var data = new FormData();
	$.each(files, function (key, value) {
		if (value['size'] > max_file_size) {
			alert('Слишком большой размер файла. Максимальный размер 10Мб');
		} else {
			data.append('images[]', value);
		}
	});
	$(elem).val('');

	sendFiles(url, data, function (json) {
		if (typeof json.html != 'undefined') {
			$('.images_list').append(urldecode(json.html));
		}
	});
}