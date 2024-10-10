<x-main-layout>
	<x-slot name="title">Главная</x-slot>
	<x-slot name="description">descr</x-slot>
	<x-slot name="keywords">keyw</x-slot>
	<x-slot name="center">
		@include('layouts.page-header', [
			'title' => '',
			'category' => 'Войти' ,
		])
	<div class="section">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="section-row">
						<form method="POST" action="{{ route('user.login') }}">
							@csrf
							@if($errors->any())
								@foreach ($errors->all() as $message)
									<span class="invalid-feedback error" role="alert">{{ $message }}</span><br>
								@endforeach
								<br>
								<br>
							@endif
							<div class="row">
								<div class="col-md-7">
									<div class="form-group"> <span>{{ __('Email') }}</span>
										<input id="email" type="email" class="input form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
																				
									</div>
								</div>
								<div class="col-md-7">
									<div class="form-group"> <span>{{ __('Password') }}</span>
										<input id="password" type="password" class="input form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
									</div>
								</div>
								<div class="col-md-7">
									<div class="form-check">
										<input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
										<label class="form-check-label" for="remember">
											{{ __('Remember Me') }}
										</label>
									</div>
								</div>
								<div class="col-md-7">
									<br>
									<br>
									<button type="submit" class="primary-button btn btn-primary">{{ __('Login') }}</button>
									@if (Route::has('user.password.request'))
										<a class="btn btn-link" href="{{ route('user.password.request') }}">
											{{ __('Forgot Your Password?') }}
										</a>
									@endif
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