var magazineCover = null;
var magazineFile = null;

function magazineCoverAttache(elem, e){
	$.each(e.target.files, function(key, file)
	{
		if(file['size'] > max_file_size){
			alert('Слишком большой размер файла. Максимальный размер 50Мб');
		} else {
			magazineCover = file;
			renderImage(file, function (imgSrc) {
				var item = '<img class="img-polaroid" src="' + imgSrc + '" height="100" data-image="' + imgSrc + '" onclick="return popupImage($(this).data(\'image\'))">';
				$('#magazine-cover-block').html(item);
			});
		}
	});
	$(elem).val('');
}

function magazineFileAttache(elem, e){
	$.each(e.target.files, function(key, file)
	{
		if(file['size'] > max_file_size){
			alert('Слишком большой размер файла. Максимальный размер 50Мб');
		} else {
			magazineFile = file;
			renderImage(file, function () {
				var item = '<img class="img-polaroid" src="/adminlte/pdf_icon.png" height="100" data-image="/adminlte/pdf_icon.png" onclick="return popupImage($(this).data(\'image\'))">';
				$('#magazine-file-block').html(item);
			});
		}
	});
	$(elem).val('');
}

function magazineSave(form, e){
	e.preventDefault();
	var url = $(form).attr('action');
	var data = new FormData();
	$.each($(form).serializeArray(), function(key, value){
		data.append(value.name, value.value);
	});
	if (magazineCover) {
		data.append('image', magazineCover);
	}
	if (magazineFile) {
		data.append('file', magazineFile);
	}

	sendFiles(url, data, function(json){
		if (typeof json.errors != 'undefined') {
			applyFormValidate(form, json.errors);
			var errMsg = [];
			for (var key in json.errors) { errMsg.push(json.errors[key]);  }
			$(form).find('[type=submit]').after(autoHideMsg('red', urldecode(errMsg.join(' '))));
		}
		if (typeof json.redirect != 'undefined') document.location.href = urldecode(json.redirect);
		if (typeof json.msg != 'undefined') $(form).find('[type=submit]').after(autoHideMsg('green', urldecode(json.msg)));
		magazineCover = null;
		magazineFile = null;
	});

	return false;
}

function magazineDel(elem, e){
	e.preventDefault();
	if (!confirm('Удалить журнал?')) return false;
	var url = $(elem).attr('href');
	sendAjax(url, {}, function(json){
		if (typeof json.success != 'undefined' && json.success === true) {
			$(elem).closest('tr').fadeOut(300, function(){ $(this).remove(); });
		}
	});
}

function deleteCover(el, e) {
	e.preventDefault();
	if (!confirm('Удалить изображение?')) return false;
	var url = $(el).attr('href');
	sendAjax(url, {}, function (json) {
		if (json.success === true) {
			$(el).closest('#magazine-cover-block').html('');
		}
	});
}

function deleteFile(el, e) {
	e.preventDefault();
	if (!confirm('Удалить файл?')) return false;
	var url = $(el).attr('href');
	sendAjax(url, {}, function (json) {
		if (json.success === true) {
			$(el).closest('#magazine-file-block').html('');
		}
	});
}

