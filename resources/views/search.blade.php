<x-main-layout>
	<x-slot name="title">Главная</x-slot>
	<x-slot name="description">descr</x-slot>
	<x-slot name="keywords">keyw</x-slot>
	<x-slot name="center">
		@include('layouts.page-header', [
			'title' => 'Поиск',
			'category' => request()->search ,
		])
		<div class="section">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="section-row">
						<div class="row" style="text-align:center;">							
							@if (!count($posts))
								<br>
								<br>
								<br>
								<h1>Ничего не найдено</h1>
								<h2>Не расстраивайся!</h2>
								<p><img src="/images/search-query-not-found.png"></p>
								<br>
							@else
								@foreach($posts as $post)		
									<div class="col-md-12">
										<div class="post post-row">								
											<a class="post-img" href="{{ route('posts') }}/{{ $post->id }}"><img src="/images/{{ $post->image_name }}" alt></a>
											<div class="post-body">
												<div class="post-meta"> <a class="post-category cat-2" href="/posts?category={{ $post->theme }}">{{ $post->theme }}</a> <span class="post-date">{{ $post->date_show->translatedFormat('d F Y') }}</span> <span class="post-hits"><img src="/images/eye-symbol.png">{{ $post->hits }}</span></div>
												<h3 class="post-title"><a href="{{ route('posts') }}/{{ $post->id }}">{{ $post->title }}</a></h3> 
												<p>{{ $post->intro_text }}</p>
												</div>
										</div>
									</div>														
								@endforeach
							@endif
						</div>
						{{ $posts->onEachSide(2)->links('pagination') }}
					</div>
				</div>
			</div>
		</div>
	</div>
	</x-slot>
</x-main-layout>