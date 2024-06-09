@extends('templates.master')

@section('css-view')
@endsection

@section('conteudo-view')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
        
                <div class="profile-overview" >
                    <h5 class="card-title">{{ $user->name }}</h5>
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
                    <button type="button"  onclick="window.location='{{ route('user.listagem') }}'"  class="btn btn-secondary">Voltar</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js-view')
@endsection