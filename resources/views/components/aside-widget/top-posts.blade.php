<div class="section-title">
	<h2>Самые читаемые</h2> 
</div>
@foreach($top_posts as $post)
<div class="post post-widget">
	<a class="post-img" href="{{ route('posts.post', [ $post->slug ]) }}"><img src="/images/{{ $post->title_image }}" alt></a>
	<div class="post-body">
		<div class="post-meta">
			<div class="post-meta-widget">
				<a class="post-category cat-{{ $post->postCategory->id }}" href="{{ route('posts.postCategory', [ $post->postCategory->slug ]) }}">{{ $post->postCategory->title }}</a> <span class="post-date">{{ $post->date_show->translatedFormat('d.m.Y') }}</span> <span class="post-hits"><img src="/images/eye-symbol.png">{{ $post->hits }}</span>
			</div>
			<h2 class="post-title-widget"><a href="{{ route('posts.post', [ $post->slug ]) }}">{{ $post->title }}</a></h2> 
		</div>
	</div>
</div>
@endforeach