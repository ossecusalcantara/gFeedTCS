@extends('templates.master')

@section('css-view')
@endsection

@section('conteudo-view')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <div class="profile-overview">
                        <h5 class="card-title">{{ $user->name }}</h5>
                        <input id="userId" type="hidden" value="{{ $user->id }}">
                        <h5 class="card-title">Sobre</h5>
                        <p class="small fst-italic">{{ $user->notes }}</p>

                        <h5 class="card-title">Destalhes do Perfil </h5>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label ">Nome</div>
                            <div class="col-lg-9 col-md-8">{{ $user->name }}</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">CPF</div>
                            <div class="col-lg-9 col-md-8">{{ $user->formatted_cpf }}</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Data de Nascimento</div>
                            <div class="col-lg-9 col-md-8">{{ $user->formatted_birth }}</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Gênero</div>
                            <div class="col-lg-9 col-md-8">{{ $user->formatted_gender }}</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Setor</div>
                            <div class="col-lg-9 col-md-8">{{ $user->departament->name }}</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Cargo</div>
                            <div class="col-lg-9 col-md-8">{{ $user->office->name }}</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Telefone</div>
                            <div class="col-lg-9 col-md-8">{{ $user->formatted_phone }}</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Email</div>
                            <div class="col-lg-9 col-md-8">{{ $user->email }}</div>
                        </div>

                    </div>
                    <div class="text-center">
                        <button type="button" onclick="window.location='{{ route('user.listagem') }}'"
                            class="btn btn-secondary">Voltar</button>
                    </div>
                </div>
            </div>

            <section class="section dashboard">
                <div class="row">

                    <div class="col-lg-4">
                        <div class="row">

                            <div class="col-12">
                                <div class="card">
                                    <div class="filter">
                                        <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                                class="bi bi-three-dots"></i></a>
                                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                            <li class="dropdown-header text-start">
                                                <h6>Filter</h6>
                                            </li>

                                            <li><a class="dropdown-item" href="#">Today</a></li>
                                            <li><a class="dropdown-item" href="#">This Month</a></li>
                                            <li><a class="dropdown-item" href="#">This Year</a></li>
                                        </ul>
                                    </div>

                                    <div class="card-body pb-0">
                                        <h5 class="card-title">Habilidades <span>| Resultado de feedbacks recebidos</span>
                                        </h5>
                                        <div id="budgetChart"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="row">

                            <!-- Reports -->
                            <div class="col-12">
                                <div class="card">

                                    <div class="filter">
                                        <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                                class="bi bi-three-dots"></i></a>
                                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                            <li class="dropdown-header text-start">
                                                <h6>Filter</h6>
                                            </li>

                                            <li><a class="dropdown-item" href="#">Today</a></li>
                                            <li><a class="dropdown-item" href="#">This Month</a></li>
                                            <li><a class="dropdown-item" href="#">This Year</a></li>
                                        </ul>
                                    </div>

                                    <div class="card-body">
                                        <h5 class="card-title">Avaliações de Desempenho <span>/Histórico</span></h5>

                                        <div id="reportsChart"></div>

                                    </div>

                                </div>
                            </div><!-- End Reports -->

                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>
@endsection

@section('js-view')
    <script src="{{ asset('assets/js/show-user-dashboard.js') }}"></script>
@endsection
