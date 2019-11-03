@extends('index')

@section('content')
    @include('common.header')
    <div class="content page page-project">
        @if(isset($project) && $project)
            <h1 class="page-title">
                <span class="page-title__value">{{$project->name}}</span>
            </h1>
            <div class="page-project__info">
                <circle-progress
                    id="circle-progress"
                    title="Процесс выполнения работ"
                    width="150px"
                    :text-size="30"
                    :title-size="16"
                    :value="{{$project->percent}}"
                    symbol="%"
                ></circle-progress>

                <section class="page-project__info-section">
                    @if($project->start_date)
                        <article class="page-project__info-section__item">
                            <b>Дата начала работ:</b>
                            <span>{{ date('d.m.Y', strtotime($project->start_date)) }}</span>
                        </article>
                    @endif
                    @if($project->end_date)
                        <article class="page-project__info-section__item">
                            <b>Дата окончания работ:</b>
                            <span>{{ date('d.m.Y', strtotime($project->end_date)) }}</span>
                        </article>
                    @endif
                    @if($project->status_name)
                        <article class="page-project__info-section__item">
                            <b>Статус:</b>
                            <span>{{ $project->status_name }}</span>
                        </article>
                    @endif
                    @if($project->price)
                        <article class="page-project__info-section__item">
                            <b>Стоимость контролируемых СМР:</b>
                            <span>{{ number_format($project->price, 0, '', ' ') . ' руб.'}}</span>
                        </article>
                    @endif
                </section>
            </div>

            @if($project->description)
                <p class="page-project__description page-description">{{$project->description}}</p>
            @endif

            <project-media
                id="project-media"
                :photos-by-date='{{((isset($project->photos_by_date)) ? json_encode($project->photos_by_date) : json_encode([]))}}'
                :docs='{{  ((isset($project->docs))   ? json_encode($project->docs)   : json_encode([]))}}'
                :videos='{{((isset($project->videos)) ? json_encode($project->videos) : json_encode([]))}}'
            ></project-media>
        @endif
    </div>
    @include('common.footer')
@endsection