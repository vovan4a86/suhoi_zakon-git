@extends('admin::template')

@section('scripts')
	<script type="text/javascript" src="/adminlte/interface_articles.js"></script>
@stop

@section('page_name')
	<h1>Статьи
		<small><a href="{{ route('admin.articles.edit') }}">Добавить статью</a></small>
	</h1>
@stop

@section('breadcrumb')
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Главная</a></li>
		<li class="active">Статьи</li>
	</ol>
@stop

@section('content')
	<div class="box box-solid">
		<div class="box-body">
			@if (count($news))
				<table class="table table-striped">
					<thead>
						<tr>
							<th width="100">Дата</th>
							<th width="100">Изображение</th>
							<th>Название</th>
							<th width="50"></th>
						</tr>
					</thead>
					<tbody>
						@foreach ($news as $item)
							<tr>
								<td>{{ $item->dateFormat() }}</td>
								<td style="text-align: center;">
									@if($item->image)
										<img src="{{ $item->thumb(1) }}" alt="{{ $item->name }}">
									@endif
								</td>
								<td><a href="{{ route('admin.articles.edit', [$item->id]) }}">{{ $item->name }}</a></td>
								<td>
									<a class="glyphicon glyphicon-trash" href="{{ route('admin.articles.delete', [$item->id]) }}"
									   style="font-size:20px; color:red;" title="Удалить" onclick="return articleDel(this)"></a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
                {!! $news->render() !!}
			@else
				<p>Нет статей!</p>
			@endif
		</div>
	</div>
@stop