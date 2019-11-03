@extends('index')

@section('content')
    @include('common.header')
    <div class="content page">
        <h1 class="page-title">{{ $Region->name }}</h1>
        @if(isset($WorkProgress) && isset($WorkProgress['all']))
            <work-progress 
                id="work-progress" 
                :all="{{$WorkProgress['all']}}" 
                :complete="{{$WorkProgress['complete']}}" 
                :work="{{$WorkProgress['work']}}" 
                price="{{$WorkProgress['price']}}"
                :symbol="''"
            ></work-progress>
        @endif
        <h2 class="page-title">Объекты сопровождения</h2>
        @if(isset($Region) && isset($Region->vendors) && count($Region->vendors))
            <vendors id="vendors" :show-all-btn="false" :no-ajax="true" :vendors="{{ (isset($Region) && isset($Region->vendors)) ? json_encode($Region->vendors) : null }}"></vendors>
        @else
            <p>Объекты еще не добавлены</p>
        @endif
    </div>
    @include('common.footer')
@endsection