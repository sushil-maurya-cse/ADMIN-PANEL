
@if ($image != "")
@foreach(explode(',', $image) as $info)
  <img src="{{ asset('image') }}/{{ $info }}" alt="" style="width:25%">
@endforeach
@endif

