@extends('templates.master')

@section('css-view')
@endsection

@section('conteudo-view')

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Editango setor, preencha todas os campos.</h5>

            {!! Form::model($departament, ['route' => ['departament.update', $departament->id], 'method' => 'put', 'class' => 'row g-3']) !!}
                <div class="col-md-12">
                    <div class="form-floating">
                        {!! Form::text( 'name', null, ['class' => 'form-control', 'placeholder' => 'Nome', 'required']) !!}
                        <label for="name">Nome</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating">
                        {!! Form::textarea( 'description', null, ['class' => 'form-control', 'placeholder' => 'Descrição', 'style' => 'height: 100px;', 'required']) !!}
                        <label for="description">Descrição</label>
                    </div>
                </div>
                <div class="text-center">
                    {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
                    <button type="reset" class="btn btn-secondary">Voltar</button>
                </div>
            {!! Form::close() !!}

        </div>
    </div>

@endsection

@section('js-view')
@endsection