<x-main-layout>
	<x-slot name="title">Статьи</x-slot>
	<x-slot name="description">descr</x-slot>
	<x-slot name="keywords">keyw</x-slot>
	<x-slot name="center">
		@include('layouts.page-header', [
			'title' => 'Статьи',
			'category' => $postCategory->title ?? null,
		])
		<div class="section">
			<div class="container">
				<div class="row">
					<div class="col-md-8">
						<div class="row">						
							@foreach($posts as $post)
								@if(($loop->iteration == 1 || $loop->iteration == 2) && (request()->page == 1 || !request()->page ))
									@php($class1 = "col-md-6")
									@php($class2 = "")
								@else
									@php($class1 = "col-md-12")
									@php($class2 = "post-row")
								@endif									
									<div class="{{ $class1 }}">
										<div class="post {{ $class2 }}">								
											<a class="post-img" href="{{ route('posts.post', [ $post->slug ]) }}"><img src="/images/{{ $post->title_image }}" alt></a>
											<div class="post-body">
												<div class="post-meta"> <a class="post-category {{ $post->postCategory->css_color_class }}" href="{{ route('posts.postCategory', [ $post->postCategory->slug ]) }}">{{ $post->postCategory->title }}</a> <span class="post-date">{{ $post->date_show->translatedFormat('d F Y') }}</span> <span class="post-hits"><img src="/images/eye-symbol.png">{{ $post->hits }}</span></div>
												<h3 class="post-title"><a href="{{ route('posts.post', [ $post->slug ]) }}">{{ $post->title }}</a></h3> 
												@if(($loop->iteration > 2 && (request()->page == 1 || !request()->page)) || request()->page > 1)
													<p>{{ $post->intro_text }}</p>
												@endif
												</div>
										</div>
									</div>														
							@endforeach							
						</div>
						{{ $posts->onEachSide(2)->links('pagination') }}								
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