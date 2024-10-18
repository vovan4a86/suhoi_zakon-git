<form action="{{ route('admin.news.imageDataSave', [$image->id]) }}"
      onsubmit="galleryImageDataSave(this, event)" style="width:600px;">
    {!! Form::groupText('image_text', $image->text, 'Подпись') !!}
    <button class="btn btn-primary" type="submit">Сохранить</button>
</form>