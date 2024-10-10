<x-main-layout>
	<x-slot name="title">Главная</x-slot>
	<x-slot name="description">descr</x-slot>
	<x-slot name="keywords">keyw</x-slot>
	<x-slot name="center">
		@include('layouts.page-header', [
			'title' => '',
			'category' => 'Личный кабинет' ,
		])
		<div class="section">
			<div class="container">
				<div class="row">
					<div class="col-md-3">
						<div class="section-row">
							<div class="post-author">
								<div class="media">
									<div class="media-left"> 
										<img class="media-object" src="/images/author.png" alt> 
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
						</div>
					</div>
					<div class="col-md-8">
						<div class="section-row">
							<h3>Серединка</h3>						
						</div>
					</div>
				</div>
			</div>
		</div>
	</x-slot>
</x-main-layout>