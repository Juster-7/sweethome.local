<x-main-layout>
	<x-slot name="title">Главная</x-slot>
	<x-slot name="description">descr</x-slot>
	<x-slot name="keywords">keyw</x-slot>
	<x-slot name="center">
		@include('layouts.page-header', [
			'title' => '',
			'category' => 'Регистрация' ,
		])
	<div class="section">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="section-row">
						<form method="POST" action="{{ route('user.register') }}">
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
									<div class="form-group"> <span>{{ __('Name') }}</span>
										<input id="name" class="input form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus> 
									</div>
								</div>
								<div class="col-md-7">
									<div class="form-group"> <span>{{ __('Email') }}</span>
										<input id="email" class="input form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" required autocomplete="email">
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
									<button type="submit" class="primary-button btn btn-primary">{{ __('Register') }}</button>
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