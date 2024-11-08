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
								<td style="font-weight: bold; text-align: center" width="120">
									<a class="glyphicon"
									   href="{{ route('admin.archive.edit', [$item->id]) }}" style="font-size:20px; color:orange;">
										{{ $item->year }}
									</a>
								</td>
								<td style="text-align: start">
									@foreach($item->magazines as $m)
										<a href="{{ route('admin.magazines.edit', $m->id) }}">
											<img src="{{ $m->thumb(1) }}" height="100" alt="cover" title="{{ $m->number_year }} ({{ $m->number_total }})">
										</a>
									@endforeach
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
