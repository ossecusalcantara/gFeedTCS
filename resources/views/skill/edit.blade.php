@extends('templates.master')

@section('css-view')
@endsection

@section('conteudo-view')

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Editando skill, preencha todas os campos.</h5>

            {!! Form::model($skill, ['route' => ['skill.update', $skill->id], 'method' => 'put', 'class' => 'row g-3',]) !!}
                <div class="col-md-8">
                    <div class="form-floating ">
                        {!! Form::text( 'name', null, ['class' => 'form-control', 'placeholder' => 'Nome', 'required']) !!}
                        <label for="name">Nome</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-floating ">
                        {!! Form::select('type', ['1' => 'Soft Skill', '2' => 'Hard Skill'] , null, [ 'class' => 'form-select', 'aria-label' => 'Tipo', 'required']) !!}
                        <label for="type">Gênero</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating ">
                        {!! Form::textarea( 'description', null, ['class' => 'form-control', 'placeholder' => 'Descrição', 'style' => 'height: 100px;', 'required']) !!}
                        <label for="description">Descrição</label>
                    </div>
                </div>
                <div class="text-center">
                    {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
                    <button type="button"  onclick="window.location='{{ route('skill.listagem') }}'"  class="btn btn-secondary">Voltar</button>
                </div>
            {!! Form::close() !!}

        </div>
    </div>

@endsection

@section('js-view')
@endsection
