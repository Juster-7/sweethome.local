<div id="nav">
	<div id="nav-fixed">
		<div class="container">
			<div class="nav-logo">
				<a href="{{ route('index') }}" class="logo"><img src="/images/logo4.png" alt></a>
			</div>
			<ul class="nav-menu nav navbar-nav">
				@include('layouts.header-menu')
			</ul>
			<div class="nav-btns">
				<button class="cart-btn" title="Корзина"><a href="{{ route('cart.index') }}"><i class="fa fa-cart"></i></a> <span class="cart-count">@if ($cart_count>0) {{ $cart_count }} @endif</span></button>
				@guest
					<button class="aside-btn-login" title="Вход"><a href="{{ route('user.login') }}"<i class="fa fa-sign-in"></i></a></button>
					@if (Route::has('user.register'))
						<button class="aside-btn-register" title="Регистрация"><a href="{{ route('user.register') }}"<i class="fa fa-user-plus"></i></a></button>
					@endif
				@else
					<button class="aside-btn-user-main" title="Личный кабинет"><a href="{{ route('user.index') }}"<i class="fa fa-user"></i></a></button>
				@endif
				<button class="aside-btn"><i class="fa fa-bars"></i></button>
				<button class="search-btn"><i class="fa fa-search"></i></button>
				<form name="search" method="get" action="{{ route('search') }}">
					@csrf
					<div class="search-form">
							<input class="search-input" type="text" name="search" placeholder="Введите запрос..." value="{{ request()->search }}">
							<button class="search-close"><i class="fa fa-times"></i></button>
						
					</div>
				</form>
			</div>
		</div>
	</div>
	@include('layouts.aside-nav')
</div>