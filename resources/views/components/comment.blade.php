<div class="media">
	<div class="media-left"> <img class="media-object" src="/images/avatar.png" alt> </div>
	<div class="media-body">
		<div class="media-heading">
			<h4>{{ $comment->name }}</h4> 
			<span class="time">{{ $comment->created_at->translatedFormat('d F Y H:i:s') }}</span> 
			@can('delete', $comment)
			<a href="{{ route('comment.delete', ['comment' => $comment]) }}" class="delete">Удалить</a>
			@endcan
			<a href="#add_comment" onclick="document.getElementById('parent_id').value = {{ $comment->id }}" class="reply">Ответить</a> 
		</div>
		<p>{{ $comment->text }}</p>
		@foreach ($comment->children as $child)
			@include('components.comment', ['comment' => $child])
		@endforeach
	</div>
</div>