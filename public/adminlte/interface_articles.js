var articleImage = null;
function articleImageAttache(elem, e){
    $.each(e.target.files, function(key, file)
    {
        if(file['size'] > max_file_size){
            alert('Слишком большой размер файла. Максимальный размер 10Мб');
        } else {
            articleImage = file;
            renderImage(file, function (imgSrc) {
                var item = '<img class="img-polaroid" src="' + imgSrc + '" height="100" data-image="' + imgSrc + '" onclick="return popupImage($(this).data(\'image\'))">';
                $('#article-image-block').html(item);
            });
        }
    });
    $(elem).val('');
}

function articleSave(form, e){
    e.preventDefault();
    var url = $(form).attr('action');
    var data = new FormData();
    $.each($(form).serializeArray(), function(key, value){
        data.append(value.name, value.value);
    });
    if (articleImage) {
        data.append('image', articleImage);
    };

    sendFiles(url, data, function(json){
        if (typeof json.errors != 'undefined') {
            applyFormValidate(form, json.errors);
            var errMsg = [];
            for (var key in json.errors) { errMsg.push(json.errors[key]);  }
            $(form).find('[type=submit]').after(autoHideMsg('red', urldecode(errMsg.join(' '))));
        }
        if (typeof json.redirect != 'undefined') document.location.href = urldecode(json.redirect);
        if (typeof json.msg != 'undefined') $(form).find('[type=submit]').after(autoHideMsg('green', urldecode(json.msg)));
        articleImage = null;
    });

    return false;
}

function articleDel(elem){
    if (!confirm('Удалить статью?')) return false;
    var url = $(elem).attr('href');
    sendAjax(url, {}, function(json){
        if (typeof json.success != 'undefined' && json.success === true) {
            $(elem).closest('tr').fadeOut(300, function(){ $(this).remove(); });
        }
    });
    return false;
}

function articleImageDel(el, e){
    e.preventDefault();
    if (!confirm('Удалить изображение?')) return false;
    var url = $(el).attr('href');
    sendAjax(url, {}, function(json){
        if (typeof json.success != 'undefined' && json.success == true) {
            $(el).closest('#article-image-block').html('');
        }
    });
}