@extends('panel/panel')
@section('content')
<div class="row">

	<ul class="alf">
		@foreach( range('a', 'z') as $l )
			@if( $l == 'a' )
			<li class="active">{{ $l }}</li>
			@else
			<li>{{ $l }}</li>
			@endif
		@endforeach
	</ul>

	<input type="text" name="searchtag" value="" placeholder="Buscar Tags">

	<ul class="tags">
	@if( !$tags->isEmpty() )
		@foreach( $tags as $t )
		<li data-name="{{ $t->name }}" data-id="{{ $t->id }}">
			<span>
			{{ $t->name }}
			<i class="mdi-content-clear removetag right"></i>
			</span>
		</li>
		@endforeach
	@endif
	</ul>
	<div class="pagetags">
		{!! $tags->render() !!}
	</div>

</div>
@stop