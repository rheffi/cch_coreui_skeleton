@extends('layouts.master')

@push('style')
@endpush

@section('content')
    <div class="w-100 h-100" style="
        display: grid;
        place-items: center;
        background:url({{url('/images/baseon_bg.png')}}) bottom right;
        background-repeat: no-repeat;
        background-size: 10%;">
        <div class="text-center font-weight-bold"></div>
        {{--         <div class="position-absolute" style="width:150px;bottom: 10px;right:10px;"><img class="w-100" src="{{}}"></div>--}}
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function(){
            $('.c-subheader').hide();
        })
    </script>
@endpush
