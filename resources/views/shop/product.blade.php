<x-main-layout>
	<x-slot name="title">Главная</x-slot>
	<x-slot name="description">descr</x-slot>
	<x-slot name="keywords">keyw</x-slot>
	<x-slot name="center">
		@include('layouts.page-header', [
			'title' => 'Магазин',
			'category' => $product->title ,
		])
		<div class="section">
			<div class="container">
				<div class="row">
					<div class="col-md-3">
						<div class="section-row">
							<h3>Каталог</h3>
							<ul class="shop-menu-links">
							@foreach ($root_categories as $category)
								<li><a href="{{ route('shop.category', [ 'slug' => $category->slug ]) }}" class="{{ (request()->segment(3) == $category->slug) ? 'active' : '' }}">{{ $category->title }}</a></li>
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
							<div class="col-md-12">
								<div class="post">
									<img src="/images/post-4.jpg" alt>									
									<div class="post-body">
										<div class="post-meta">
											<form action="{{ route('cart.add', ['id' => $product->id]) }}" method="post">
												<a class="post-category cat-4" href="{{ route('shop.category', [ 'slug' => $product->category->slug ]) }}">{{ $product->category->title }}</a>
												<span class="post-date-big fr"><nobr>@money($product->price)</nobr> 
													@csrf
													<input type="text" name="quantity" id="quantity" value="1" style="width:30px;margin-left:20px;">
													<button class="post-category cat-2" style="margin-left:20px;">В КОРЗИНУ</button>
												</span>
											</form>
										</div>
										<br>
										{!! $product->main_text !!}
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</x-slot>
</x-main-layout>