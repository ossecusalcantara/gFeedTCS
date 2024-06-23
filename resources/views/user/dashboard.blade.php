@extends('templates.master');

@section('css-view')
@endsection

@section('conteudo-view')
    <div class="pagetitle">
        <h1>Dashboard</h1>
    </div>

    <section class="section dashboard">
        <div class="row">

            <div class="col-lg-8">
                <div class="row">

                    <div class="col-12">
                        <div class="card">
                            <div class="card-body pb-0">
                                <h5 class="card-title">Habilidades <span>| Resultado de feedbacks recebidos</span></h5>
                                <div id="budgetChart" ></div>
                            </div>
                        </div>
                    </div>

                    <!-- Reports -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Avaliações de Desempenho <span>| Histórico</span></h5>
                                <div id="reportsChart"></div>
                            </div>
                        </div>
                    </div><!-- End Reports -->

                </div>
            </div>

    
            <div class="col-lg-4">

                <div class="col-xxl-12 col-xl-12">
                    <div class="card info-card customers-card">

                        <div class="card-body">
                            <h5 class="card-title">Feedbacks <span>| Este Ano</span></h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-people"></i>
                                </div>
                                <div class="ps-3">
                                    <h6 id="countFeedbackYear">0</h6>
                                    <span class="text-danger small pt-1 fw-bold" id="countFeedbackMounth"></span> 
                                    <span class="text-muted small pt-2 ps-1">Este Mês</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card">
                        <div class="card-body pb-0">
                            <h5 class="card-title">Indicador de Atividades Recentes </h5>
                            <div id="activityChart"></div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="card">

                    <div class="card-body">
                        <h5 class="card-title">Atividades Recentes <span>| Esta semana</span></h5>

                        <div class="activity">

                            @foreach ($activities as $activitie)

                                <div class="activity-item d-flex">
                                    @if($activitie->formatted_created_at == 0) 
                                        <div class="activite-label">Agora <br> mesmo</div>
                                    @elseif($activitie->formatted_created_at <= 24)
                                        <div class="activite-label">{{ $activitie->formatted_created_at }} hrs</div>
                                    @else
                                        <div class="activite-label">{{ $activitie->formatted_created_at }}</div>
                                    @endif
                                    @if($activitie->type == 'N')
                                        <i class='bi bi-circle-fill activity-badge text-primary align-self-start'></i>
                                    @elseif($activitie->type == 'R')
                                        <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                                    @elseif($activitie->type == 'A')
                                        <i class='bi bi-circle-fill activity-badge text-warning align-self-start'></i>
                                    @endif
                                    <div class="activity-content">
                                        {{ $activitie->text }}
                                    </div>
                                </div>
                                
                            @endforeach
                        </div>

                    </div>
                </div><!-- End Recent Activity -->

            </div>

        </div>
    </section>
@endsection

@section('js-view')
    <script src="{{ secure_asset('assets/js/dashboard.js') }}"></script>
@endsection
