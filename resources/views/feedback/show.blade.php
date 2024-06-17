@extends('templates.master')

@section('css-view')
@endsection

@section('conteudo-view')
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"> Feedback </h5>

                        <div class="row mb-3">
                            <div class="col-lg-3 col-md-4 ">
                                <span class="text-primary  pt-2 ps-1 fw-bold">Motivo: </span>
                                <span class="text-muted pt-1 "> {{ $feedback->reason }} </span>
                                <br>
                                <br>
                                <span class="text-primary  fw-bold pt-2 ps-1">Detalhes do feedback: </span>
                                <span class="text-muted pt-1 "> {{ $feedback->notes }} </span>
                            </div>
                        </div>


                        <div class="row"> 
                            @foreach ($skillsFeedback_list as $skillFeedback)
                                <div class="col-xxl-4 col-xl-4">
                                    @if($skillFeedback->pontuation <= 3)
                                        <div class="card info-card customers-card">
                                    @elseif($skillFeedback->pontuation > 3 && $skillFeedback->pontuation <= 7)
                                        <div class="card info-card sales-card">
                                    @elseif($skillFeedback->pontuation > 7 && $skillFeedback->pontuation <= 10)
                                        <div class="card info-card revenue-card">
                                    @endif
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $skillFeedback->skill->name }} | Pontuação:</h5>
                                            <div class="d-flex align-items-center">
                                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                    <h6 >{{ $skillFeedback->pontuation }}</h6>
                                                </div>
                                                <div class="ps-3">
                                                    <span class="text-muted small pt-2 ps-1">{{ $skillFeedback->skill->description }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    

                        @canany(['manager', 'user'])
                            <div class="text-center">
                                <button type="button" onclick="window.location='{{ route('feedback.listagem') }}'"
                                    class="btn btn-secondary">Voltar</button>
                            </div>
                        @endcanany
                        
                        @can('admin')
                            <div class="text-center">
                                <button type="button" onclick="window.location='{{ route('feedback.adminList') }}'"
                                    class="btn btn-secondary">Voltar</button>
                            </div>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js-view')
@endsection
