<div id="nav-aside">
	<div class="section-row">
		<ul class="nav-aside-menu">
			<li><a href="{{ route('index') }}">Главная</a></li>
			<li><a href="{{ route('about') }}">О нас</a></li>
			<li><a href="{{ route('contacts') }}">Контакты</a></li>
		</ul>
	</div>
	<div class="section-row">
		<h3>Недавнее</h3>
		@foreach ($last_posts as $post)	
		<div class="post post-widget">
			<a class="post-img" href="{{ route('posts.post', [ $post->slug ]) }}"><img src="/images/{{ $post->title_image }}" alt></a>
			<div class="post-body">
				<h3 class="post-title"><a href="{{ route('posts.post', [ $post->slug ]) }}">{{ $post->title }}</a></h3> 
			</div>
		</div>
		@endforeach
	</div>
	<div class="section-row">
		<h3>Присоединяйтесь</h3>
		<ul class="nav-aside-social">
			<li><a href="#"><i class="fa fa-facebook"></i></a></li>
			<li><a href="#"><i class="fa fa-twitter"></i></a></li>
			<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
			<li><a href="#"><i class="fa fa-pinterest"></i></a></li>
		</ul>
	</div>
	<button class="nav-aside-close"><i class="fa fa-times"></i></button>
</div>