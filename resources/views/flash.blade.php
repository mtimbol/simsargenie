@foreach (session('flash_notification', collect())->toArray() as $message)
	<script>
		swal({
			title: '{{ $alertTitle ?? 'Pcasa'}}',
			text: '{{ $message['message'] }}',
			icon: '{{ $message['level'] == 'danger' ? 'error' : $message['level'] }}'
		})
	</script>
@endforeach

{{ session()->forget('flash_notification') }}