<x-main-layout>
	<x-slot name="title">Главная</x-slot>
	<x-slot name="description">descr</x-slot>
	<x-slot name="keywords">keyw</x-slot>
	<x-slot name="center">
		@include('layouts.page-header', [
			'title' => 'Контакты',
			'category' => null ,
		])
		<div class="section">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="section-row">
						<h3>Контактная информация</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
						<ul class="list-style">
							<li>
								<p><strong>Email:</strong> <a href="#">info@sweethome.local</a></p>
							</li>
							<li>
								<p><strong>Телефон:</strong> (861) 213-52-73</p>
							</li>
							<li>
								<p><strong>Адрес:</strong> Краснодар, ул. Красная, 155</p>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-md-5 col-md-offset-1">
					<div class="section-row">
						<h3>Напишите нам</h3>
						<form>
							<div class="row">
								<div class="col-md-7">
									<div class="form-group"> <span>Имя*</span>
										<input class="input" type="name" name="name"> </div>
								</div>
								<div class="col-md-7">
									<div class="form-group"> <span>Email*</span>
										<input class="input" type="email" name="email"> </div>
								</div>
								<div class="col-md-7">
									<div class="form-group"> <span>Тема</span>
										<input class="input" type="text" name="subject"> </div>
								</div>
								<div class="col-md-12">
									<div class="form-group"> <span>Сообщение*</span>
										<textarea class="input" name="message" placeholder=""></textarea>
									</div>
									<button class="primary-button">Отправить</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	</x-slot>
</x-main-layout>