<div class="container">
	<div class="row">
		<div class="col-md-5">
			<div class="footer-widget">
				<div class="footer-logo">
					<a href="{{ route('index') }}" class="logo"><img src="/images/logo4.png" alt></a>
				</div>
				<ul class="footer-nav">
					<li><a href="#">Политика обработки ПД</a></li>
					<li><a href="#">Реклама</a></li>
				</ul>
				<div class="footer-copyright"> <span>&copy;<script>document.write(new Date().getFullYear());</script> Все права защищены</span></div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="row">
				<div class="col-md-6">
					<div class="footer-widget">
						<h3 class="footer-title">О нас</h3>
						<ul class="footer-links">
							<li><a href="{{ route('about') }}">О нас</a></li>
							<li><a href="{{ route('contacts') }}">Контакты</a></li>
						</ul>
					</div>
				</div>
				<div class="col-md-6">
					<div class="footer-widget">
						<h3 class="footer-title">Категории</h3>
						<ul class="footer-links">
							@include('layouts.footer-menu')
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="footer-widget">
				<h3 class="footer-title">Подписаться</h3>
				<div class="footer-newsletter">
					<form name="subscribe" method="post" action="/subscribe">
						<input class="input" type="email" name="newsletter" placeholder="Введите Ваш email">
						<button class="newsletter-btn"><i class="fa fa-paper-plane"></i></button>
					</form>
				</div>
				<ul class="footer-social">
					<li><a href="#"><i class="fa fa-facebook"></i></a></li>
					<li><a href="#"><i class="fa fa-twitter"></i></a></li>
					<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
					<li><a href="#"><i class="fa fa-pinterest"></i></a></li>
				</ul>
			</div>
		</div>
	</div>
</div>