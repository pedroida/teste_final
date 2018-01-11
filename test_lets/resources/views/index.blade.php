@extends('layouts.app')

@section('title','Início')
@section('content')


<div class="container">

	<div class="row text-center panel">
		<div class="page-header">
			<h1>Lista de Produtos</h1>
		</div>
		@isset($message)
		<div class="alert alert-warning">
			<ul>
				<strong>Ops!</strong>

				<li>{{ $message }}</li>

			</ul>
		</div>
		@endisset
		<div class="panel-body">
			@foreach($product as $p)
			<div class="col-md-2 col-lg-3  card" >
				<img id="productImage" src="{{$p->image }}" alt="{{$p->image}}">
				<div class="in-card caption well">
					<h4><b>Título:</b><br> 
						<div id="titulo">
							{{ str_limit($p->title,20) }}
						</div>
					</h4>
					<!-- <h3><b>Descrição:</b> {{ str_limit($p->description) }}</h3> -->
					<span class="badge">{{  'R$ '.number_format($p->price, 2, ',', '.') }} </span>
				</div>
				<div class="btn-card">
					<button type="button" class="btn btn-success" data-toggle="modal" data-target="#{{ $p->id}}">
						Ver Tudo
					</button>
					<a href="{{ action('ProductController@edit',$p->id) }}"  class="btn btn-info">Editar Produto</a>
					
				</div>
			</div>


			<!-- Modal -->
			<div class="modal fade" id="{{ $p->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Visualização Completa</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="thumbnail">
								<img id="showImage" class="img-responsive" src="{{asset($p->image) }}" alt="{{$p->image}}">
								<div class="caption well">
									<h3><b>ID:</b> {{ $p->id }}</h3>
									<h3><b>Título:</b> {{ $p->title }}</h3>
									<h3><b>Descrição:</b> {{ $p->description }}</h3>
									<span class="badge">{{  'R$ '.number_format($p->price, 2, ',', '.') }} </span>
								</div>
								<a class="btn btn-info" href="{{ route('editar',$p->id) }}">Editar</a>

								<a href="{{ action('ProductController@delete', $p->id) }}"  class="btn btn-danger" >Apagar</a>

							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
						</div>
					</div>
				</div>
			</div>
			@endforeach

		</div>
	</div>
</div>






@stop()

