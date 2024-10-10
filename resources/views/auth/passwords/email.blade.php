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
					<form method="POST" action="{{ route('user.password.email') }}">
							@csrf
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
										<input id="email" type="email" class="input form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
									</div>
								</div>
								<div class="col-md-7">
									<br>
									<br>
									<button type="submit" class="primary-button btn btn-primary">{{ __('Send Password Reset Link') }}</button>
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