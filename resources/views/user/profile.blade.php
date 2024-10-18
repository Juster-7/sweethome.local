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
							@include('user.components.left')							
						</div>
					</div>
					<div class="col-md-8">
						<div class="section-row">
							<h3>Фото профиля</h3>
							<form action="{{ route('user.profile.photo.store') }}" enctype="multipart/form-data" method="post">
								@csrf
								@if($errors->any())
									@foreach ($errors->all() as $message)
										<span class="invalid-feedback error" role="alert">{{ $message }}</span><br>
									@endforeach
									<br>
									<br>
								@endif
								@if (session('success'))
									<div class="alert alert-success" role="alert">
										{{ session('success') }}
									</div>
								@endif
								<input id="profilephoto" type="file" class="input form-control" name="profilephoto" value="{{ old('profilephoto') }}" required autocomplete="profilephoto">
								<br>
								<button type="submit" class="primary-button btn btn-primary">{{ __('Save') }}</button>
							</form>
							@if (Auth()->user()->photo)
							<br>
							<br>
							<h3>Удаление фото профиля</h3>
							<form action="{{ route('user.profile.photo.delete') }}" enctype="multipart/form-data" method="post">
								@csrf
								<button type="submit" class="primary-button btn btn-primary">{{ __('Delete') }}</button>
							</form>
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
	</x-slot>
</x-main-layout>