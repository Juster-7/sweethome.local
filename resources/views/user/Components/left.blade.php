<div class="post-author">
	<div class="media">
		<div class="media-left"> 
			<a href="{{ route('user.profile') }}" title="Редактировать фото">
				<img class="media-object" src="{{ Auth()->user()->getProfilePhotoUrl() }}" alt>
			</a> 
		</div>
		<br>
		<h3>{{ auth()->user()->name }}</h3>	
		<p>{{ auth()->user()->email }}</p>	
		<form action="{{ route('user.logout') }}" method="post">
			@csrf
			<button type="submit" class="primary-button btn btn-primary">{{ __('Logout') }}</button>
		</form>
		<br>
		<br>
		<h3>Статьи</h3>
		<ul class="shop-menu-links">
			<li><a href="#" class="">Посты</a></li>
			<li><a href="#" class="">Комментарии</a></li>
		</ul>
		<br>
		<h3>Магазин</h3>
		<ul class="shop-menu-links">
			<li><a href="#" class="">Заказы</a></li>
			<li><a href="#" class="">Избранное</a></li>
		</ul>									
	</div>
</div>