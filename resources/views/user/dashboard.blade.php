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

                                @if($activitie->type == 'N')

                                    <div class="activity-item d-flex">
                                        <div class="activite-label">2 hrs</div>
                                        <i class='bi bi-circle-fill activity-badge text-primary align-self-start'></i>
                                        <div class="activity-content">
                                            {{ $activitie->text }}
                                        </div>
                                    </div>

                                @elseif($activitie->type == 'R')
                                    
                                    <div class="activity-item d-flex">
                                        <div class="activite-label">32 min</div>
                                        <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                                        <div class="activity-content">
                                            {{ $activitie->text }}
                                        </div>
                                    </div>

                                @elseif($activitie->type == 'A')

                                    <div class="activity-item d-flex">
                                        <div class="activite-label">2 days</div>
                                        <i class='bi bi-circle-fill activity-badge text-warning align-self-start'></i>
                                        <div class="activity-content">
                                            {{ $activitie->text }}
                                        </div>
                                    </div>

                                @endif
                                
                            @endforeach

                            {{-- <div class="activity-item d-flex">
                                <div class="activite-label">32 min</div>
                                <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                                <div class="activity-content">
                                    Quia quae rerum <a href="#" class="fw-bold text-dark">explicabo officiis</a>
                                    beatae
                                </div>
                            </div>

                            <div class="activity-item d-flex">
                                <div class="activite-label">56 min</div>
                                <i class='bi bi-circle-fill activity-badge text-danger align-self-start'></i>
                                <div class="activity-content">
                                    Voluptatem blanditiis blanditiis eveniet
                                </div>
                            </div><!-- End activity item-->

                            <div class="activity-item d-flex">
                                <div class="activite-label">2 hrs</div>
                                <i class='bi bi-circle-fill activity-badge text-primary align-self-start'></i>
                                <div class="activity-content">
                                    Voluptates corrupti molestias voluptatem
                                </div>
                            </div>

                            <div class="activity-item d-flex">
                                <div class="activite-label">1 day</div>
                                <i class='bi bi-circle-fill activity-badge text-info align-self-start'></i>
                                <div class="activity-content">
                                    Tempore autem saepe <a href="#" class="fw-bold text-dark">occaecati
                                        voluptatem</a> tempore
                                </div>
                            </div><!-- End activity item-->

                            <div class="activity-item d-flex">
                                <div class="activite-label">2 days</div>
                                <i class='bi bi-circle-fill activity-badge text-warning align-self-start'></i>
                                <div class="activity-content">
                                    Est sit eum reiciendis exercitationem
                                </div>
                            </div><!-- End activity item-->

                            <div class="activity-item d-flex">
                                <div class="activite-label">4 weeks</div>
                                <i class='bi bi-circle-fill activity-badge text-muted align-self-start'></i>
                                <div class="activity-content">
                                    Dicta dolorem harum nulla eius. Ut quidem quidem sit quas
                                </div>
                            </div><!-- End activity item--> --}}

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
