@extends('templates.master')

@section('css-view')
@endsection

@section('conteudo-view')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"> Avaliação de Desenpenho - Nível {{ $performanceEvaluation->level }} @if ($performanceEvaluation->level == 2)
                            Lideranças
                        @endif
                    </h5>

                    <div class="row mb-3">
                        <div class="col-lg-3 col-md-4 ">
                            <span class="text-muted  pt-2 ps-1">Colaborador: </span>
                            <span class="text-primary pt-1 fw-bold"> {{ $performanceEvaluation->user->name }}</span>
                        </div>
                    </div>


                    @if ($performanceEvaluation->media <= 2.5)
                        <div class="row">
                            <div class="col-lg-3 col-md-4">
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <i class="bi bi-exclamation-triangle me-1"></i>
                                    <span class="text-muted  pt-2 ps-1">Média: </span>
                                    <span class="text-warning pt-1 fw-bold"> {{ $performanceEvaluation->media }}</span>
                                    <br>
                                    Necessita desenvolver
                                </div>
                            </div>
                        </div>
                    @elseif($performanceEvaluation->media > 2.5 && $performanceEvaluation->media <= 3.5)
                        <div class="row">
                            <div class="col-lg-3 col-md-4">
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="bi bi-check-circle me-1"></i>
                                    <span class="text-muted  pt-2 ps-1">Média: </span>
                                    <span class="text-success pt-1 fw-bold"> {{ $performanceEvaluation->media }}</span>
                                    <br>
                                    Atende aos requisitos
                                </div>
                            </div>
                        </div>
                    @elseif($performanceEvaluation->media > 3.5 && $performanceEvaluation->media <= 4.0)
                        <div class="row">
                            <div class="col-lg-3 col-md-4">
                                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                    <i class="bi bi-star me-1"></i>
                                    <span class="text-muted  pt-2 ps-1">Média: </span>
                                    <span class="text-primary pt-1 fw-bold"> {{ $performanceEvaluation->media }}</span>
                                    <br>
                                    Supera / É referência
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="accordion accordion-flush" id="faq-group-1">
                        @foreach ($answersEvaluations_list as $answers)
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" data-bs-target="#faqsOne-{{ $answers->id }}" type="button"
                                        data-bs-toggle="collapse">
                                        {{ $answers->question->order }} - {{ $answers->question->question_description }}
                                    </button>
                                </h2>
                                <div id="faqsOne-{{ $answers->id }}" class="accordion-collapse collapse" data-bs-parent="#faq-group-{{ $answers->id }}">
                                    <div class="accordion-body">
                                        <span class="text-muted  pt-2 ps-1">Nota: </span>
                                        <span class="text-primary pt-1 fw-bold"> {{ $answers->punctuation }}</span> <br> <br>
                                        {{ $answers->notes }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @can('manager')
                        <div class="text-center">
                            <button type="button" onclick="window.location='{{ route('performanceEvaluations.managerlist') }}'"
                                class="btn btn-secondary">Voltar</button>
                        </div>
                    @endcan

                    @can('admin')
                        <div class="text-center">
                            <button type="button" onclick="window.location='{{ route('performanceEvaluations.listagem') }}'"
                                class="btn btn-secondary">Voltar</button>
                        </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js-view')
@endsection
