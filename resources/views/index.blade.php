<x-main-layout>
	<x-slot name="title">Главная</x-slot>
	<x-slot name="description">descr</x-slot>
	<x-slot name="keywords">keyw</x-slot>
	<x-slot name="center">
		<div class="section">
			<div class="container">
				<div class="row">
					@foreach($posts as $post)
						@if($loop->first)
							<div class="col-md-8">
								<div class="row">
									<div class="col-md-12">
										<div class="post post-thumb">
											<a class="post-img" href="{{ route('posts', [ 'slug' => $post->slug ]) }}"><img src="/images/{{ $post->image_name }}" alt></a>
											<div class="post-body">
												<div class="post-meta"> <a class="post-category cat-2" href="/posts?category={{ $post->theme }}">{{ $post->theme }}</a> <span class="post-date">{{ $post->date_show->translatedFormat('d F Y') }}</span> <span class="post-hits"><img src="/images/eye-symbol-white.png"> {{ $post->hits }}</span></div>
												<h3 class="post-title"><a href="{{ route('posts', [ 'slug' => $post->slug ]) }}">{{ $post->title }}</a></h3> 
											</div>
										</div>
									</div>						
								</div>
							</div>
							@break
						@endif					
					@endforeach
					<div class="col-md-4">
						<div class="aside-widget">
							<div class="section-title">
								<h2>Самые читаемые</h2> 
							</div>
							@foreach($top_posts as $post)
							<div class="post post-widget">
								<a class="post-img" href="{{ route('posts', [ 'slug' => $post->slug ]) }}"><img src="/images/{{ $post->image_name }}" alt></a>
								<div class="post-body">
									<h3 class="post-title"><a href="{{ route('posts', [ 'slug' => $post->slug ]) }}">{{ $post->title }}</a></h3> 
								</div>
							</div>
							@endforeach							
						</div>					
					</div>
				</div>			
				<div class="row">
					@foreach($posts as $post)
						@if($loop->first)
							@continue
						@else	
							@if(($loop->iteration-1)%3==1)
							<div class="clearfix visible-md visible-lg"></div>
							@endif
							<div class="col-md-4">
								<div class="post">
									<a class="post-img" href="{{ route('posts', [ 'slug' => $post->slug ]) }}"><img src="/images/{{ $post->image_name }}" alt></a>
									<div class="post-body">
										<div class="post-meta"> <a class="post-category cat-1" href="/posts?category={{ $post->theme }}">{{ $post->theme }}</a> <span class="post-date">{{ $post->date_show->translatedFormat('d F Y') }}</span> <span class="post-hits fr"><img src="/images/eye-symbol.png"> {{ $post->hits }}</span></div>
										<h3 class="post-title"><a href="{{ route('posts', [ 'slug' => $post->slug ]) }}">{{ $post->title }}</a></h3> </div>
								</div>
							</div>
						@endif
					@endforeach
				</div>
			</div>
		</div>
		
		
		<div class="section section-grey">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="section-title text-center">
							<h2>Магазин</h2> 
						</div>
					</div>
						@foreach($products as $product)
						<div class="col-md-3">
							<div class="post">
								<a class="post-img" href="{{ route('shop.product', ['slug' => $product->slug ]) }}"><img src="/images/post-4.jpg" alt></a>
								<div class="post-body">
									<div class="post-meta"><span class="post-date">@money($product->price)</span> <a class="post-category cat-4 fr" href="/posts/&category={{ $post->theme }}">КУПИТЬ</a></div>
									<h3 class="post-title"><a href="{{ route('shop.product', ['slug' => $product->slug ]) }}">{{ $product->title }}</a></h3> </div>
							</div>
						</div>
						@endforeach
				</div>
			</div>
		</div>	
	</x-slot>
</x-main-layout>