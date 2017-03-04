@extends('layouts.master')

@section('content')
	@include('includes.message-block')
	<section class="row new-post">
		<div class="col-md-6 col-md-offset-3">
			<header><h3>Que tienes para decir?</h3></header>
			<form action="{{ route('post.create') }}" method="post">
				<div class="form-group">
					<textarea class="form-control" name="body" id="new-post" rows="5" placeholder="Tu Post"></textarea>
				</div>
				<button type="submit" class="btn btn-primary">Publicar Post</button>
				<input type="hidden" value="{{ Session::token() }}" name="_token">
			</form>
		</div>
	</section>
	<section class="row posts">
		<div class="col-md-6 col-md-offset-3">
			<header><h3>Lo que dicen otras personas...</h3></header>
			@foreach($posts as $post)
				<article class="post" data-postid="{{ $post->id }}">
					<p>{{ $post->body }}</p>
					<div class="info">
						Publicado por {{ $post->user->first_name }} el {{ $post->created_at }}
					</div>
					<div class="interaction">
						<a href="#" class="like">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 1 ? 'Te gusta este post' : 'Me Gusta' : 'Me Gusta'  }}</a> |
                        <a href="#" class="like">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 0 ? 'No te gusta este post' : 'No me Gusta' : 'No me Gusta'  }}</a>
						@if(Auth::user() == $post->user)
							|
							 <a href="#" class="edit">Editar</a> |
							<a href="{{ route('post.delete', ['post_id' => $post->id]) }}">Borrar</a>
						@endif
					</div>
				</article>
			@endforeach
		</div>
	</section>

	<div class="modal fade" tabindex="-1" role="dialog" id="edit-modal">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">Editar Post</h4>
	      </div>
	      <div class="modal-body">
	        <form action="">
	        	<div class="form-group">
	        		<label for="post-body">Editar el Post</label>
	        		<textarea class="form-control" name="post-body" id="post-body" rows="5"></textarea>
	        	</div>
	        </form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	        <button type="button" class="btn btn-primary" id="modal-save">Guardar Cambios</button>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<script>
		var token = '{{ Session::token() }}';
		var urlEdit = '{{ route('edit') }}';
		var urlLike = '{{ route('like') }}';
	</script>
@endsection