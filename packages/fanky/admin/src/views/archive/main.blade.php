@extends('admin::template')

@section('scripts')
	<script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="/adminlte/interface_archive.js"></script>
@stop

@section('page_name')
	<h1>Архив
		<small><a href="{{ route('admin.archive.edit') }}">Добавить год</a></small>
	</h1>
@stop

@section('breadcrumb')
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Главная</a></li>
		<li class="active">Архив</li>
	</ol>
@stop

@section('content')
	<div class="box box-solid">
		<div class="box-body">
			@if (count($archive))
				<table class="table table-striped table-v-middle">
					<tbody id="archive-list">
						@foreach ($archive as $item)
							<tr data-id="{{ $item->id }}">
								<td style="font-weight: bold" width="60">{{ $item->year }}</td>
								<td style="text-align: start">
									@foreach($item->magazines as $m)
										<img src="{{ $m->thumb(1) }}" height="60" alt="cover" title="{{ $m->number }}">
									@endforeach
								</td>
								<td width="60"><a class="glyphicon glyphicon-edit"
												  href="{{ route('admin.archive.edit', [$item->id]) }}" style="font-size:20px; color:orange;"></a>
								</td>
								<td width="60">
									<a class="glyphicon glyphicon-trash" href="{{ route('admin.archive.delete', [$item->id]) }}"
									   style="font-size:20px; color:red;" onclick="archiveDel(this, event)"></a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			@else
				<p>Нет архива!</p>
			@endif
		</div>
	</div>
@stop
