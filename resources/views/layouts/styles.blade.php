<style type="text/css">
@foreach ($styles as $style)
	@if(!empty($style->css_color))
	 .nav-menu li.cat-{{ $style->id }} a:after {
		 background-color: {{ $style->css_color }};
	}
	 .nav-menu li.cat-{{ $style->id }} a:hover, .nav-menu li.cat-{{ $style->id }} a:focus {
		 color: {{ $style->css_color }};
	}
	 .post-meta .post-category.cat-{{ $style->id }} {
		 background-color: {{ $style->css_color }};
	}
	 .category-widget ul li > a.cat-{{ $style->id }} > span {
		 background-color: {{ $style->css_color }};
	}
	 .category-widget ul li > a.cat-{{ $style->id }}:hover, .category-widget ul li > a.cat-{{ $style->id }}:focus {
		 color: {{ $style->css_color }};
	}
	@endif
@endforeach
</style>
