@if($paginator->hasPages())
	<div class="clearfix visible-md visible-lg"></div>
	<div class="pagination col-md-1">
		<div class="text-center">
			@foreach ($elements as $element)
				@if(is_string($element))
					<span class="three-dots">{{ $element }}</span>
				@endif
				@if(is_array($element))
					@foreach($element as $page => $url)
						@if($page == $paginator->currentPage())
							<span class="page-current">{{ $page }}</span>
						@else
							<a href="{{ $url }}"><span>{{ $page }}</span></a>
						@endif
					@endforeach
				@endif
			@endforeach		
		</div>
	</div>
@endif