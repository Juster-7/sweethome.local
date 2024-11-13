<div class="bg-white rounded-top shadow-sm mb-3">
    <div class="row g-0">
        <div class="col col-lg-8 mt-6 p-4">
			<label class="form-label">Название статьи</label>
			<p class="h3 text-black fw-light mt-auto">{{ $post->title }}</p>
			<br>
			<br>
			<br>
			<div class="mb-3">
				<div class="row mb-2 g-3 g-mb-4">
					<div class="col">
						<div class="p-4 bg-white rounded shadow-sm h-100 d-flex flex-column">
							<label class="form-label">Автор</label>
							{{ $post->user->name }}
						</div>
					</div>
					<div class="col">
						<div class="p-4 bg-white rounded shadow-sm h-100 d-flex flex-column">
							<label class="form-label">Категория</label>   
							{{ $post->postCategory->title }}
						</div>
					</div>
					<div class="col">
						<div class="p-4 bg-white rounded shadow-sm h-100 d-flex flex-column">
							<label class="form-label">Дата показа</label>
							{{ $post->date_show->translatedFormat('d F Y') }}
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col col-lg-4 mt-6 p-4">
			<img class="col col-lg-12 mt-6 p-4" src="/images/{{ $post->title_image }}">
		</div>		
    </div>
    <div class="row bg-light m-0 p-md-4 p-3 border-top rounded-bottom">
		<div class="bg-white rounded shadow-sm p-4 py-4 d-flex flex-column mb-3">
			<div class="form-group">
				<label class="form-label">Вводный текст</label>
				{{ $post->intro_text }}
			</div>
		</div>
		<div class="bg-white rounded shadow-sm p-4 py-4 d-flex flex-column">
			<div class="form-group">
				<label class="form-label">Основной текст</label>
				{!! $post->main_text !!}
			</div>
		</div>
	</div>
</div>