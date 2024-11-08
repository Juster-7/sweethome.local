<div class="section-title">
	<h2>Категории</h2> 
</div>
<div class="category-widget">
	<ul>
		@foreach($top_categories as $postCategory)										
			<li><a href="{{ route('posts.postCategory', [ $postCategory->slug ]) }}" class="cat-{{ $postCategory->id }}">{{ $postCategory->title }}<span>{{ $postCategory->posts_count }}</span></a></li>
		@endforeach
	</ul>
</div>
