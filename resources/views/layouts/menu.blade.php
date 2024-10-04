<li><a href="{{ route('posts.index') }}">Статьи</a></li>
@foreach ($menu as $item)
	<li class="{{ $item->css_color_class }}"><a href="{{ route('posts.postCategory', [ $item->slug ]) }}">{{ $item->title }}</a></li>
@endforeach<li><a href="{{ route('shop.index') }}">Магазин</a></li>
<li><a href="{{ route('contacts') }}">Контакты</a></li>