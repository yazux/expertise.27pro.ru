@extends('index')

@section('content')
    @include('common.header')
    <div class="content page">
        <h1 class="page-title">{{setting('site.home_title')}}</h1>
        @if($WorkProgress)
            <work-progress 
                id="work-progress" 
                :all="{{$WorkProgress['all']}}" 
                :complete="{{$WorkProgress['complete']}}" 
                :work="{{$WorkProgress['work']}}" 
                price="{{$WorkProgress['price']}}"
                :symbol="''"
            ></work-progress>
        @endif
        <h2 class="page-title">{{setting('site.home_vendor_title')}}</h2>
        <regions id="regions" :regions="{{ ($regions) ? json_encode($regions) : null }}"></regions>
    </div>
    @include('common.footer')
@endsection