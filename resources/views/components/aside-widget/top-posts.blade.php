<div class="section-title">
	<h2>Самые читаемые</h2> 
</div>
@foreach($top_posts as $post)
<div class="post post-widget">
	<a class="post-img" href="{{ route('posts.post', [ $post->slug ]) }}"><img src="/images/{{ $post->title_image }}" alt></a>
	<div class="post-body">
		<h3 class="post-title"><a href="{{ route('posts.post', [ $post->slug ]) }}">{{ $post->title }}</a></h3> 
	</div>
</div>
@endforeach