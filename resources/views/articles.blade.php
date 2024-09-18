<x-main-layout>
	<x-slot name="title">Статьи</x-slot>
	<x-slot name="description">descr</x-slot>
	<x-slot name="keywords">keyw</x-slot>
	<x-slot name="center">
		@include('layouts.page-header', [
			'title' => 'Статьи',
			'category' => request()->category,
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
											<a class="post-img" href="{{ route('articles') }}/{{ $post->alias }}"><img src="/images/{{ $post->image_name }}" alt></a>
											<div class="post-body">
												<div class="post-meta"> <a class="post-category cat-2" href="/articles?category={{ $post->theme }}">{{ $post->theme }}</a> <span class="post-date">{{ $post->date_show->translatedFormat('d F Y') }}</span> <span class="post-hits"><img src="/images/eye-symbol.png">{{ $post->hits }}</span></div>
												<h3 class="post-title"><a href="{{ route('articles') }}/{{ $post->alias }}">{{ $post->title }}</a></h3> 
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
							<div class="section-title">
								<h2>Категории</h2> </div>
							<div class="category-widget">
								<ul>
									@foreach($top_categories as $category)
										<li><a href="{{ route('articles', ['category' => $category->theme]) }}" class="cat-1">{{ $category->theme }}<span>{{ $category->total }}</span></a></li>
									@endforeach
								</ul>
							</div>
						</div>
						<div class="aside-widget">
							<div class="tags-widget">
								<ul>
									@foreach($all_categories as $category)
										<li><a href="{{ route('articles', ['category' => $category->theme]) }}">{{ $category->theme }}</a></li>
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