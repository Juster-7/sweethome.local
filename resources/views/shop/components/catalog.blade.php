<h3>Каталог</h3>
<ul class="shop-menu-links">
@foreach ($root_categories as $productCategory)
	<li><a href="{{ route('shop.productCategory', [ $productCategory->slug ]) }}" class="{{ (request()->segment(3) == $productCategory->slug) ? 'active' : '' }}">{{ $productCategory->title }}</a></li>
@endforeach
</ul>