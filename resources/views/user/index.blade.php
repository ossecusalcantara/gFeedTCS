@extends('templates.master')

@section('css-view')
@endsection

@section('conteudo-view')
    @if (session('success'))
        <h3>{{ session('success')['messages'] }}</he>
    @endif

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Cadastro de novo usuário, preencha todas os campos.</h5>

            {!! Form::open(['route' => 'user.store', 'method' => 'post', 'class' => 'row g-3']) !!}
                <div class="col-md-12">
                    <div class="form-floating">
                        {!! Form::text( 'name', null, ['class' => 'form-control', 'placeholder' => 'Nome']) !!}
                        <label for="name">Nome</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        {!! Form::text( 'email', null, ['class' => 'form-control', 'placeholder' => 'E-mail']) !!}
                        <label for="email">E-mail</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Senha']) !!}
                        <label for="password">Senha</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        {!! Form::text( 'cpf', null, ['class' => 'form-control', 'placeholder' => 'CPF']) !!}
                        <label for="cpf">CPF</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-floating ">
                        {!! Form::select('gender', ['M' => 'Masculino', 'F' => 'Feminino'] , null, [ 'class' => 'form-select', 'aria-label' => 'Gênero']) !!}
                        <label for="gender">Gênero</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating ">
                        {!! Form::select('departament_id', $departament_list , null, [ 'class' => 'form-select', 'aria-label' => 'Setor']) !!}
                        <label for="departament_id">Setor</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating ">
                        {!! Form::select('office_id', $office_list , null, [ 'class' => 'form-select', 'aria-label' => 'Cargo']) !!}
                        <label for="office_id">Cargo</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        {!! Form::text( 'phone', null, ['class' => 'form-control', 'placeholder' => 'Telefone']) !!}
                        <label for="email">Telefone</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        {!! Form::date( 'birth', null, ['class' => 'form-control', 'placeholder' => 'Data de Aniversário']) !!}
                        <label for="birth">Data de Aniversário</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating">
                        {!! Form::textarea( 'notes', null, ['class' => 'form-control', 'placeholder' => 'Notas', 'style' => 'height: 100px;']) !!}
                        <label for="notes">Notas</label>
                    </div>
                </div>
                <div class="text-center">
                    @include('templates.formulario.submit', [
                        'input' => 'Cadastrar',
                        'attributes' => [
                            'class' => 'btn btn-primary',
                        ],
                    ])
                    <button type="reset" class="btn btn-secondary">Voltar</button>
                </div>
            {!! Form::close() !!}

        </div>
    </div>

@endsection

@section('js-view')
@endsection
