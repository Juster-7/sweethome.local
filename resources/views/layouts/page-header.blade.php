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
				<h1>{{ $category ?? $title }}</h1>
			</div>
		</div>
	</div>
</div>