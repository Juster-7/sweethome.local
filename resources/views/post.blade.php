<x-main-layout>
	<x-slot name="title">Статьи</x-slot>
	<x-slot name="description">descr</x-slot>
	<x-slot name="keywords">keyw</x-slot>
	<x-slot name="center">
	@include('layouts.page-header-post', [
		'title' => $post->title,
		'date' => $post->date_show->translatedFormat('d F Y'), 
		'theme' => $post->theme,
		'hits' => $post->hits,
	])
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
								<div class="media-left"> <img class="media-object" src="/images/author.png" alt> </div>
								<div class="media-body">
									<div class="media-heading">
										<h3>{{ $post->author }}</h3> 
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
							<p>Ваш email адрес не будет публиковаться</p>
						</div>
						@if($errors->any())
							@foreach ($errors->all() as $message)
								<p class="error">{{ $message }}</p>
							@endforeach
						@endif
						<form class="post-reply" name="add_comment" id="add_comment" action="{{ route('comment.add') }}" method="post">
							@csrf
							<div class="row">
								<div class="col-md-4">
									<div class="form-group"> <span>Имя*</span>
										<input class="input" type="text" name="name" value="{{ old('name') }}"> 
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group"> <span>Email*</span>
										<input class="input" type="email" name="email" value="{{ old('email') }}"> 
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<textarea class="input" name="text" placeholder="Комментарий*">{{ old('text') }}</textarea>
									</div>
									<input class="input" type="hidden" name="post_id" id="post_id" value="{{ $post->id }}">
									<input class="input" type="hidden" name="parent_id" id="parent_id" value="">
									<input name="add_comment" class="primary-button" type="submit" value="Отправить">
								</div>
							</div>
						</form>
					</div>
				</div>					
				<div class="col-md-4">
					<div class="aside-widget">
						<div class="section-title">
							<h2>Самое читаемое</h2> 
						</div>
						@foreach($top_posts as $post)
							<div class="post post-widget">
								<a class="post-img" href="{{ route('posts') }}/{{ $post->slug }}"><img src="/images/{{ $post->image_name }}" alt></a>
								<div class="post-body">
									<h3 class="post-title"><a href="{{ route('posts') }}/{{ $post->slug }}">{{ $post->title }}</a></h3> 
								</div>
							</div>
						@endforeach
					</div>
						<div class="aside-widget">
							<div class="section-title">
								<h2>Категории</h2> </div>
							<div class="category-widget">
								<ul>
									@foreach($top_categories as $category)
										<li><a href="{{ route('posts', ['category' => $category->theme]) }}" class="cat-1">{{ $category->theme }}<span>{{ $category->total }}</span></a></li>
									@endforeach
								</ul>
							</div>
						</div>
						<div class="aside-widget">
							<div class="tags-widget">
								<ul>
									@foreach($all_categories as $category)
										<li><a href="{{ route('posts', ['category' => $category->theme]) }}">{{ $category->theme }}</a></li>
									@endforeach
								</ul>
							</div>
						</div>
						<div class="aside-widget">
							<div class="section-title">
								<h2>Архив</h2> </div>
							<div class="archive-widget">
								<ul>
									<li><a href="#">Январь 2024</a></li>
									<li><a href="#">Февраль 2024</a></li>
									<li><a href="#">Март 2024</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>	
			</div>	
		</div>	
	</x-slot>
</x-main-layout>