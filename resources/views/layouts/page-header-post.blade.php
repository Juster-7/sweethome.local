<div id="post-header" class="page-header">
	<div class="background-img" style="background-image: url('/images/post-page.jpg');"></div>
	<div class="container">
		<div class="row">
			<div class="col-md-10">
				<div class="post-meta"> <a class="post-category {{ $post->postCategory->css_color_class }}" href="{{ route('posts.postCategory', [ $post->postCategory->slug ]) }}">{{ $post->postCategory->title }}</a> <span class="post-date">{{ $post->date_show->translatedFormat('d F Y') }}</span>  <span class="post-hits fff"><img src="/images/eye-symbol-white.png"> {{ $post->hits }}</span></div>
				<h1>{{ $post->title }}</h1> </div>
		</div>
	</div>
</div>