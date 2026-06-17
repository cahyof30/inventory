<div class="d-flex gap-2">

<a
href="{{ route('items.scan-camera') }}">

Scan QR

</a>

@if(auth()->check())

<a href="/admin">

Dashboard

</a>

@endif

</div>