@php
use Carbon\Carbon;

echo Carbon::createFromFormat('H:i:s', '14:30:00')->format('H:i');
@endphp