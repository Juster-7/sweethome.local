<div class="page-header">
	<div class="container">
		<div class="row">
			<div class="col-md-10">
				<ul class="page-header-breadcrumb">
					<li><a href="{{ route('index') }}">Главная</a></li>
					@if($category)
					<li><a href="/{{ Request::segment(1) }}">{{ $title }}</a></li>					
					@else
					<li>{{ $title }}</li>
					@endif
				</ul>				 
				@if($errors->any())
					@foreach ($errors->all() as $message)
						<h1 class="error">{{ $message }}</h1>
					@endforeach
				@else
					<h1>{{ $category ?? $title }}</h1>
				@endif
			</div>
		</div>
	</div>
</div>