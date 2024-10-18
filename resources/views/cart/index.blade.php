<x-main-layout>
	<x-slot name="title">Главная</x-slot>
	<x-slot name="description">descr</x-slot>
	<x-slot name="keywords">keyw</x-slot>
	<x-slot name="center">
		@include('layouts.page-header', [
			'title' => 'Корзина',
			'category' => null ,
		])
		<div class="section">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="section-row">
							@if (count($products))
								<table class="table table-bordered">
									<tr>
										<th>№</th>
										<th>Наименование</th>
										<th>Цена</th>
										<th><nobr>Кол-во</nobr></th>
										<th>Стоимость</th>
										<th>&nbsp;</th>
									</tr>
									@foreach($products as $product)
										<tr>
											<td>{{ $loop->iteration }}</td>
											<td>
												<a href="{{ route('shop.product', [$product->slug]) }}">{{ $product->title }}</a>
											</td>
											<td>@money($product->price)</td>
											<td>
												<table style="width:70px;">
													<tr>
														<td>
															<form action="{{ route('cart.decrease', [ 'product_id' => $product->id ]) }}" method="post">
																@csrf
																<button type="submit" class="transparent">
																	<i class="fa fa-minus-square"></i>
																</button>
															</form>
														</td>
														<td width="60%" align="center">
															<span class="mx-1">{{ $product->pivot->quantity }}</span>
														</td>
														<td>
															<form action="{{ route('cart.increase', [ 'product_id' => $product->id ]) }}" method="post">
																@csrf
																<button type="submit" class="transparent">
																	<i class="fa fa-plus-square"></i>
																</button>
															</form>
														</td>
													</tr>
												</table>
											</td>
											<td>@money($product->price * $product->pivot->quantity)</td>
											<td>
												<form action="{{ route('cart.remove', [ 'product_id' => $product->id ]) }}" method="post">
													@csrf
													<button type="submit" class="transparent">
														<i class="fa fa-trash"></i>
													</button>
												</form>
											</td>
										</tr>
									@endforeach
									<tr>
										<th>&nbsp;</th>
										<th colspan="3" class="text-right">Итого</th>
										<th>@money($totalCost)</th>
										<th>&nbsp;</th>
									</tr>
								</table>
							@else
								<p>Ваша корзина пуста</p>
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
	</x-slot>
</x-main-layout>