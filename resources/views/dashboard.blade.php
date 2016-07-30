@extends('layouts.master')

@section('content')
	@include('includes.message-block')
	<section class="row new-post">
		<div class="col-md-6 col-md-offset-3">
			<header><h3>What's on your mind?</h3></header>
			<form action="{{ route('post.create') }}" method="post">
				<div class="form-group">
					<textarea class="form-control" name="body" id="new-post" rows="5" placeholder="Your Post"></textarea>
				</div>
				<button type="submit" class="btn btn-primary">Create Post</button>
				<input type="hidden" name="_token" value="{{ Session::token() }}">
			</form>
		</div>
	</section>

	<section class="row posts">
		<div class="col-md-6 col-md-offset-3">
			<header><h3>What others say</h3></header>
			
			@foreach($posts as $post)
				<article class="post">
					<p>{{ $post->body }}</p>
					<div class="info">
						posted by {{  $post->user->first_name }} on {{ $post->created_at }} 
					</div>
					<div class="interaction">
						<a href="#">Like</a> |
						<a href="#">Dislike</a> 
						@if( Auth::user() == $post->user )
							|
							<a href="#" class="edit">Edit</a> |
							<a href="{{ route( 'post.delete', ['post_id' => $post->id] ) }}">Delete</a> 
						@endif
					</div>
				</article>
			@endforeach

		</div>
	</section>

	<div class="modal fade" tabindex="-1" role="dialog" id='edit-modal'>  
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">Edit Post</h4>
	      </div>
	      <div class="modal-body">
	        	<form>
	        		<div class="form-group">
	        			<label for="post-body">Edit the Post</label>
	        			<textarea class="form-control" name="post-body" id="modal-post-body" rows="5"></textarea>
	        		</div>
	        	</form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-primary">Save changes</button>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

@endsection