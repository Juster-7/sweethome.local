@foreach ($menu as $item)
	<li><a href="{{ route('posts.postCategory', [ $item->slug ]) }}">{{ $item->title }}</a></li>
@endforeach