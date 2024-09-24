<x-main-layout>
	<x-slot name="title">Главная</x-slot>
	<x-slot name="description">descr</x-slot>
	<x-slot name="keywords">keyw</x-slot>
	<x-slot name="center">
		@include('layouts.page-header', [
			'title' => 'Магазин',
			'category' => null ,
		])
		<div class="section">
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					<div class="section-row">
						<h3>Каталог</h3>
						<ul>
						@foreach ($root_categories as $category)
							<li><a href="{{ route('shop.category', [ 'slug' => $category->slug ]) }}">{{ $category->title }}</a></li>
						@endforeach
						</ul>
						<br>
						<br>
						<h3>Топ брендов</h3>
						<ul class="shop-menu-links">
						@foreach ($top_brands as $brand)
							<li><a href="{{ route('shop.brand', [ 'slug' => $brand->slug ]) }}" class="{{ (request()->segment(3) == $brand->slug) ? 'active' : '' }}">{{ $brand->title }}</a></li>
						@endforeach
						</ul>
					</div>
				</div>
				<div class="col-md-8">
					<div class="section-row">
						<h3>Новинки</h3>
						@foreach($last_products as $product)
						<div class="col-md-4">
							<div class="post">
								<a class="post-img" href="{{ route('shop.product', ['slug' => $product->slug ]) }}"><img src="/images/post-4.jpg" alt></a>
								<div class="post-body">
									<div class="post-meta"><a class="post-category cat-4" href="{{ route('shop.category', [ 'slug' => $product->category->slug ]) }}">{{ $product->category->title }}</a> <span class="post-date fr">@money($product->price) <a href="#" title="В корзину"><i class="fa fa-cart"></i></a></span></div>
									<h3 class="post-title"><a href="{{ route('shop.product', ['slug' => $product->slug ]) }}">{{ $product->title }}</a></h3> </div>
							</div>
						</div>
						@endforeach
				</div>
			</div>
		</div>
	</div>
	</x-slot>
</x-main-layout>