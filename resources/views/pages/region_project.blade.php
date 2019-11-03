@extends('index')

@section('content')
    @include('common.header')
    <div class="content page">
        <h1 class="page-title">{{ $Region->name }}</h1>
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
        <h2 class="page-title">Объекты сопровождения</h2>
        <vendor-projects id="vendor-projects" :projects="{{ (($Region->projects) ? json_encode($Region->projects) : json_encode([]) )  }}"></vendor-projects>
    </div>
    @include('common.footer')
@endsection