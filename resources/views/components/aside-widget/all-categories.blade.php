<div class="tags-widget">
	<ul>								
		@foreach($all_categories as $postCategory)
			<li><a href="{{ route('posts.postCategory', [ $postCategory->slug ]) }}">{{ $postCategory->title }}</a></li>
		@endforeach
	</ul>
</div>