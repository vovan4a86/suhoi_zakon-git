<form action="{{ route('admin.catalog.catalogFeaturesSave', [$image->id]) }}"
	  onsubmit="catalogFeatureDataSave(this, event)" style="width:600px;">
	<label for="feat-text">Подпись</label>
	<input id="feat-text" class="form-control" type="text"
		   name="feat_text" value="{{ $image->text }}">

	<button class="btn btn-primary" style="margin-top: 20px;" type="submit">Сохранить</button>
</form>
<script>
	$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
		checkboxClass: 'icheckbox_minimal-blue',
		radioClass: 'iradio_minimal-blue'
	});
</script>
