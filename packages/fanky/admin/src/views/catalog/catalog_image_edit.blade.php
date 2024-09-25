<form action="{{ route('admin.catalog.catalogGalleryItemSave', [$image->id]) }}"
	  onsubmit="catalogGalleryItemSave(this, event)" style="width:600px;">
	<label for="image-text">Подпись</label>
	<input id="image-text" class="form-control" type="text"
		   name="image_text" value="{{ $image->text }}">

	<button class="btn btn-primary" style="margin-top: 20px;" type="submit">Сохранить</button>
</form>
<script>
	$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
		checkboxClass: 'icheckbox_minimal-blue',
		radioClass: 'iradio_minimal-blue'
	});
</script>
