<h3>Топ брендов</h3>
<ul class="shop-menu-links">
@foreach ($top_brands as $brand)
	<li><a href="{{ route('shop.brand', [ $brand->slug ]) }}" class="{{ (request()->segment(3) == $brand->slug) ? 'active' : '' }}">{{ $brand->title }}</a></li>
@endforeach
</ul>