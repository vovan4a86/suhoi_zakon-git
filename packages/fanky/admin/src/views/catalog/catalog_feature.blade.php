<span class="images_item" data-id="{{ $image->id }}">
	<img class="img-polaroid" src="{{ $image->thumb(1) }}"
		 style="cursor:pointer;" data-image="{{ $image->thumb(1) }}"
		 onclick="popupImage('{{ $image->image_src }}')">
	<a class="images_del" href="{{ route('admin.catalog.catalogFeatureDelete', $image->id) }}"
	   onclick="return catalogFeatureDelete(this)">
		<span class="glyphicon glyphicon-trash"></span>
	</a>
	<a class="images_edit" href="{{ route('admin.catalog.catalogFeatureEdit', [$image->id]) }}"
	   onclick="catalogFeatureEdit(this, event)"><span class="glyphicon glyphicon-edit"></span></a>
</span>
