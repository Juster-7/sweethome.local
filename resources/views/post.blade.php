<x-main-layout>
	<x-slot name="title">Статьи</x-slot>
	<x-slot name="description">descr</x-slot>
	<x-slot name="keywords">keyw</x-slot>
	<x-slot name="center">
	@include('layouts.page-header-post')
	<div class="section">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<div class="section-row sticky-container">
						<div class="main-post">
							{!! $post->main_text !!}
						</div>
						<div class="post-shares sticky-shares"> <a href="#" class="share-facebook"><i class="fa fa-facebook"></i></a> <a href="#" class="share-twitter"><i class="fa fa-twitter"></i></a> <a href="#" class="share-google-plus"><i class="fa fa-google-plus"></i></a> <a href="#" class="share-pinterest"><i class="fa fa-pinterest"></i></a> <a href="#" class="share-linkedin"><i class="fa fa-linkedin"></i></a> <a href="#"><i class="fa fa-envelope"></i></a> </div>
					</div>
					<div class="section-row">
						<div class="post-author">
							<div class="media">
								<div class="media-left"> 
									<img class="media-object" src="{{ $post->user->getProfilePhotoUrl() }}" alt> 
								</div>
								<div class="media-body">
									<div class="media-heading">
										<h3>{{ $post->user->name }}</h3> 
									</div>
									<ul class="author-social">
										<li><a href="#"><i class="fa fa-facebook"></i></a></li>
										<li><a href="#"><i class="fa fa-twitter"></i></a></li>
										<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
										<li><a href="#"><i class="fa fa-instagram"></i></a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div class="section-row" id="comments">
						<div class="section-title">
							<h2>{{ $comments_count }} {{ trans_choice('комментарий|комментария|комментариев', $comments_count) }}</h2> 
						</div>
						<div class="post-comments">
							@foreach($comments as $comment)										
								@include('components.comment', ['comment' => $comment])
							@endforeach
						</div>
					</div>
					<div class="section-row">
						<div class="section-title">
							<h2>Оставить комментарий</h2>
						</div>
						@guest
							Чтобы оставить комментарий <a href="{{ route('user.login') }}">авторизуйтесь</a> или <a href="{{ route('user.register') }}">зарегистрируйтесь</a>.
						@else
							@if($errors->any())
								@foreach ($errors->all() as $message)
									<p class="error">{{ $message }}</p>
								@endforeach
							@endif
							<form class="post-reply" name="add_comment" id="add_comment" action="{{ route('comment.add') }}" method="post">
								@csrf
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<textarea class="input" name="text" placeholder="Комментарий*">{{ old('text') }}</textarea>
										</div>
										<input class="input" type="hidden" name="post_id" id="post_id" value="{{ $post->id }}">
										<input class="input" type="hidden" name="user_id" id="user_id" value="{{ auth()->user()->id }}">
										<input class="input" type="hidden" name="parent_id" id="parent_id" value="">
										<input name="add_comment" class="primary-button" type="submit" value="Отправить">
									</div>
								</div>
							</form>
						@endif							
					</div>
				</div>					
				<div class="col-md-4">
					<div class="aside-widget">
						@include('components.aside-widget.top-posts')
					</div>
					<div class="aside-widget">
						@include('components.aside-widget.top-categories')
					</div>
					<div class="aside-widget">
						@include('components.aside-widget.all-categories')
					</div>
					<div class="aside-widget">
						@include('components.aside-widget.archive')
					</div>
				</div>
			</div>	
		</div>	
	</div>	
	</x-slot>
</x-main-layout>