@extends('templates.master')

@section('css-view')
@endsection

@section('conteudo-view')
    <div class="pagetitle">
        <h1>Perfil</h1>
    </div>

    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">

                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                        <img src="{{ asset("img/profile/{$user->profile_picture}") }}" alt="Profile" class="rounded-circle">
                        <h2>{{ $user->name }}</h2>
                        <h3>{{ $user->office->name }}</h3>
                        <div class="social-links mt-2">
                            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-xl-8">

                <div class="card">
                    <div class="card-body pt-3">
                        <ul class="nav nav-tabs nav-tabs-bordered">

                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab"
                                    data-bs-target="#profile-overview">Sobre</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Editar
                                    Perfil</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab"
                                    data-bs-target="#profile-change-password">Mudar Senha</button>
                            </li>

                        </ul>
                        <div class="tab-content pt-2">

                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <h5 class="card-title">Sobre</h5>
                                <p class="small fst-italic">{{ $user->notes }}</p>

                                <h5 class="card-title">Destalhes do Perfil </h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Nome</div>
                                    <div class="col-lg-9 col-md-8">{{ $user->name }}</div>
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

                            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                {!! Form::model($user, [ 'route' => ['user.profileUpdate', $user->id], 'method' => 'put', 'enctype' => 'multipart/form-data', ]) !!}
                                    <div class="row mb-3">
                                        <label for="image" class="col-md-4 col-lg-3 col-form-label">Foto de Perfil </label>
                                        <div class="col-md-8 col-lg-9">
                                            <div class="mb-3">
                                                {!! Form::file('image', ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Nome</label>
                                        <div class="col-md-8 col-lg-9">
                                            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nome', 'required']) !!}
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="about" class="col-md-4 col-lg-3 col-form-label">Sobre</label>
                                        <div class="col-md-8 col-lg-9">
                                            {!! Form::textarea('notes', null, [ 'class' => 'form-control', 'placeholder' => 'Notas', 'style' => 'height: 100px;',]) !!}
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Telefone</label>
                                        <div class="col-md-8 col-lg-9">
                                            {!! Form::text('phone', null, ['class' => 'form-control', 'placeholder' => 'Telefone', 'required']) !!}
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="Email" class="col-md-4 col-lg-3 col-form-label">E-mail</label>
                                        <div class="col-md-8 col-lg-9">
                                            {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'E-mail', 'required']) !!}
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
                                    </div>
                                {!! Form::close() !!}
                            </div>

                            <div class="tab-pane fade pt-3" id="profile-change-password">

                                @if(session('error'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <i class="bi bi-exclamation-octagon me-1"></i>
                                            {{ session('error') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                    <br>
                                @endif

                                @if(session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <i class="bi bi-check-circle me-1"></i>
                                            {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                    <br>
                                @endif

                                {!! Form::open(['route' => 'user.changePassword', 'method' => 'post', 'class' => 'row g-3']) !!}
                                    <div class="row mb-3">
                                        <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Senha
                                            Atual</label>
                                        <div class="col-md-8 col-lg-9">
                                            {!! Form::password('currentPassword', ['class' => 'form-control', 'id' => 'newPassword', 'required']) !!}
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Nova Senha</label>
                                        <div class="col-md-8 col-lg-9">
                                            {!! Form::password('newPassword', ['class' => 'form-control', 'id' => 'newPassword', 'required']) !!}
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Confirme a
                                            nova senha</label>
                                        <div class="col-md-8 col-lg-9">
                                            {!! Form::password('renewPassword', ['class' => 'form-control', 'id' => 'renewPassword', 'required']) !!}
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
                                    </div>
                                {!! Form::close() !!}
                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@section('js-view')
@endsection
