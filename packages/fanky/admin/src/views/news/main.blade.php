@extends('admin::template')

@section('scripts')
	<script type="text/javascript" src="/adminlte/interface_news.js"></script>
@stop

@section('page_name')
	<h1>Новости
		<small><a href="{{ route('admin.news.edit') }}">Добавить новость</a></small>
	</h1>
@stop

@section('breadcrumb')
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Главная</a></li>
		<li class="active">Новости</li>
	</ol>
@stop

@section('content')
	<div class="box box-solid">
		<div class="box-body">
			@if (count($news))
				<table class="table table-striped news-table">
					<thead>
						<tr>
							<th width="100">Дата</th>
							<th width="100">Изображение</th>
							<th>Название</th>
							<th width="50">X</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($news as $item)
							<tr>
								<td>{{ $item->dateFormat() }}</td>
								<td style="text-align: center;">
									@if($item->image)
										<img src="{{ $item->thumb(1) }}" alt="image">
									@endif
								</td>
								<td><a href="{{ route('admin.news.edit', [$item->id]) }}">{{ $item->name }}</a></td>
{{--								<td width="100">{{ $item->on_main ? 'Да' : 'Нет' }}</td>--}}
								<td>
									<a class="glyphicon glyphicon-trash" href="{{ route('admin.news.delete', [$item->id]) }}"
									   style="font-size:20px; color:red;" title="Удалить" onclick="return newsDel(this)"></a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
				{!! Pagination::render('admin::pagination') !!}
			@else
				<p>Нет новостей!</p>
			@endif
		</div>
	</div>
@stop