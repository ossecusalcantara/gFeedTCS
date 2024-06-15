@extends('templates.master')

@section('css-view')
@endsection

@section('conteudo-view')

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Cadastro de de perguntas para avaliação de desempenho, preencha todas os campos.</h5>

            {!! Form::open(['route' => 'questions.store', 'method' => 'post', 'class' => 'row g-3',]) !!}
                <div class="col-md-4">
                    <div class="form-floating ">
                        {!! Form::select('type_question_id', $typeQuestions_list , null, [ 'class' => 'form-select', 'aria-label' => 'Tipo', 'required']) !!}
                        <label for="type_question_id">Tipo</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-floating ">
                        {!! Form::select('level', [1 => 'Colaboradores', 2 => 'Lideranças'] , null, [ 'class' => 'form-select', 'aria-label' => 'Nível', 'required']) !!}
                        <label for="level">Nível</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating ">
                        {!! Form::textarea( 'question_description', null, ['class' => 'form-control', 'placeholder' => 'Descrição da Pergunta', 'style' => 'height: 100px;', 'required']) !!}
                        <label for="description">Descrição da Pergunta</label>
                    </div>
                </div>
                <div class="text-center">
                    {!! Form::submit('Cadastrar', ['class' => 'btn btn-primary']) !!}
                    <button type="button"  onclick="window.location='{{ route('questions.listagem') }}'"  class="btn btn-secondary">Voltar</button>
                </div>
            {!! Form::close() !!}

        </div>
    </div>

@endsection

@section('js-view')
@endsection
