<li><a href="{{ route('posts.index') }}">Статьи</a></li>
@foreach ($menu as $item)
	<li class="cat-{{ $item->id }}"><a href="{{ route('posts.postCategory', [ $item->slug ]) }}">{{ $item->title }}</a></li>
@endforeach<li><a href="{{ route('shop.index') }}">Магазин</a></li>
<li><a href="{{ route('contacts') }}">Контакты</a></li>