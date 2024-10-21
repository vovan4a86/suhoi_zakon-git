<span class="images_item magazine-item" data-id="{{ $item->id }}">
	<span class="magazine-name">{{ $item->number }}</span>
	<img class="img-polaroid" src="{{ $item->thumb(2) }}"
         style="cursor:pointer;" data-image="{{ $item->image_src }}"
         onclick="popupImage('{{ $item->image_src }}')" alt="magazine image">
	<a class="images_del" href="{{ route('admin.magazines.delete', $item->id) }}"
       onclick="return magazineDel(this)">
		<span class="glyphicon glyphicon-trash"></span>
	</a>
	<a class="images_edit" href="{{ route('admin.magazines.edit', $item->id) }}"><span class="glyphicon glyphicon-edit"></span></a>
</span>
