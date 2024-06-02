@extends('templates.master')

@section('css-view')
@endsection

@section('conteudo-view')
    @if (session('success'))
        <h3>{{ session('success')['messages'] }}</he>
    @endif

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Cadastro de avaliação de desempenho, preencha todas os campos.</h5>

            
            {!! Form::open(['route' => 'performanceEvaluations.store', 'method' => 'post', 'class' => 'row g-3']) !!}

                <div class="col-md-4">
                    <div class="form-floating">
                        {!! Form::date( 'deadline', null, ['class' => 'form-control', 'placeholder' => 'Prazo de entrega', 'required']) !!}
                        <label for="deadline">Prazo de entrega</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-floating ">
                        {!! Form::select('manager_id', $usuarios_list , null, [ 'class' => 'form-select select2', 'aria-label' => 'Gestor', 'required']) !!}
                        <label for="manager_id">Gestor</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-floating ">
                        {!! Form::select('user_id', $usuarios_list , null, [ 'class' => 'form-select select2', 'aria-label' => 'Colaborador', 'required']) !!}
                        <label for="user_id">Colaborador</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating">
                        {!! Form::textarea( 'notes', null, ['class' => 'form-control', 'placeholder' => 'Notas', 'style' => 'height: 100px;']) !!}
                        <label for="notes">Notas</label>
                    </div>
                </div>
                <div class="text-center">
                    {!! Form::submit('Cadastrar', ['class' => 'btn btn-primary']) !!}
                    <button type="button"  onclick="window.location='{{ route('user.listagem') }}'"  class="btn btn-secondary">Voltar</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>


@endsection

@section('js-view')
 
@endsection
    