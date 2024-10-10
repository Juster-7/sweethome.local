<x-main-layout>
	<x-slot name="title">Главная</x-slot>
	<x-slot name="description">descr</x-slot>
	<x-slot name="keywords">keyw</x-slot>
	<x-slot name="center">
		@include('layouts.page-header', [
			'title' => '',
			'category' => __('Reset Password'),
		])
	<div class="section">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="section-row">
						<form method="POST" action="{{ route('user.password.update') }}">
							@csrf
							<input type="hidden" name="token" value="{{ $token }}">
							@if($errors->any())
								@foreach ($errors->all() as $message)
									<span class="invalid-feedback error" role="alert">{{ $message }}</span><br>
								@endforeach								
								<br>
							@endif
							@if (session('status'))
								<span class="invalid-feedback success" role="alert">{{ session('status') }}</span>
								<br>
								<br>
							@endif
							<div class="row">
								<div class="col-md-7">
									<div class="form-group"> <span>{{ __('Email') }}</span>
										<input id="email" type="email" class="input form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" readonly required autocomplete="email" autofocus>
									</div>
								</div>
								<div class="col-md-7">
									<div class="form-group"> <span>{{ __('Password') }}</span>
										<input id="password" class="input form-control @error('password') is-invalid @enderror" type="password" name="password" required autocomplete="new-password"> 
									</div>
								</div>
								<div class="col-md-7">
									<div class="form-group"> <span>{{ __('Confirm Password') }}</span>
										<input id="password-confirm" class="input form-control" type="password" name="password_confirmation" required autocomplete="new-password">                            
									</div>
									<br>
									<br>
									<button type="submit" class="primary-button btn btn-primary">{{ __('Reset Password') }}</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	</x-slot>
</x-main-layout>