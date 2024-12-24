<x-main-layout>
	<x-slot name="title">Главная</x-slot>
	<x-slot name="description">descr</x-slot>
	<x-slot name="keywords">keyw</x-slot>
	<x-slot name="center">
		@include('layouts.page-header', [
			'title' => 'Магазин',
			'category' => $product->title ,
		])
		<div class="section">
			<div class="container">
				<div class="row">
					<div class="col-md-3">
						<div class="section-row">
							@include('shop.components.catalog')
							<br>
							<br>
							@include('shop.components.top-brands')
						</div>
					</div>
					<div class="col-md-8">
						<div class="section-row">
							<div class="col-md-12">
								<div class="post">
									<img src="/images/post-4.jpg" alt>
									<div class="post-body">
										<div class="post-meta">
											<form action="{{ route('cart.add', ['id' => $product->id]) }}" method="post">
												<a class="post-category cat-4" href="{{ route('shop.productCategory', [ $product->productCategory->slug ]) }}">{{ $product->productCategory->title }}</a> {{ $product->productBrand->title }}
												<span class="post-date-big fr"><nobr>@money($product->price)</nobr>
													@csrf
													<input type="text" name="quantity" id="quantity" value="1" style="width:30px;margin-left:20px;">
													<button class="post-category cat-2" style="margin-left:20px;">В КОРЗИНУ</button>
												</span>
											</form>
										</div>
										<br>
										{!! $product->main_text !!}
									</div>
									<br>
									<div class="section-row" id="comments">
										<div class="section-title">
											<h2>{{ $product->comments_count }} {{ trans_choice('отзыв|отзыва|отзывов', $product->comments_count) }}</h2>
										</div>
										<div class="post-comments">
											@foreach($comments as $comment)
												@include('components.comment', ['comment' => $comment])
											@endforeach
										</div>
									</div>
									<div class="section-row">
										<div class="section-title">
											<h2>Оставить отзыв</h2>
										</div>
										@guest
											Чтобы оставить отзыв <a href="{{ route('user.login') }}">авторизуйтесь</a> или <a href="{{ route('user.register') }}">зарегистрируйтесь</a>.
										@else
											@if($errors->any())
												@foreach ($errors->all() as $message)
													<p class="error">{{ $message }}</p>
												@endforeach
											@endif
											<form class="post-reply" name="add_comment" id="add_comment" action="{{ route('comment.add') }}" method="post">
												@csrf
												<div class="row">
													<div class="col-md-12">
														<div class="form-group">
															<textarea class="input" id='add_comment_textarea' name="text" placeholder="Отзыв*">{{ old('text') }}</textarea>
														</div>
														<input class="input" type="hidden" name="commentable_id" id="commentable_id" value="{{ $product->id }}">
														<input class="input" type="hidden" name="commentable_type" id="commentable_type" value="{{ $product->getMorphClass() }}">
														<input class="input" type="hidden" name="user_id" id="user_id" value="{{ auth()->user()->id }}">
														<input class="input" type="hidden" name="parent_id" id="parent_id" value="">
														<input name="add_comment" class="primary-button" type="submit" value="Отправить">
													</div>
												</div>
											</form>
										@endif
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</x-slot>
</x-main-layout>
