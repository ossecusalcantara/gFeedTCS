@extends('templates.master')

@section('css-view')
@endsection

@section('conteudo-view')

<div class="card">
    <div class="card-body">
        <div class="row text-center">
            <h4 class="card-title"> Avaliação de Desempenho - Nível {{ $performanceEvaluation->level }} @if( $performanceEvaluation->level == 2) Lideranças @endif </h4>
        </div>
        <h5 class="card-title">Avalie cada compêtencia conforme a frequência que mais
            representa o colaborador.</h5>
            <ul>
                <li>Raramente (1) </li>
                <li>Frequentemente (2) </li>
                <li>Sempre (3) </li>
                <li>Supera/Referência (4) </li>
            </ul>
     
            </p>
                <b>Comentários que evidenciem/ justifiquem sua avaliação e
                sugestões para melhoria do desempenho (recomendável nos
                itens avaliados como raramente e frequentemente).</b>
            </p>
            <br>

        {!! Form::open(['route' => 'answersEvaluation.store', 'method' => 'post', 'class' => ' g-3']) !!}
            {!! Form::number( 'performance_evaluation_id', $performanceEvaluation->id , ['class' => 'd-none']) !!}
        @foreach ($questions_list as $question)
            <div class="row">
                <div class="col-md-12">
                    <p>{{ $question->order }} - {{ $question->question_description }}</p>
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-md-2">
                    {!! Form::number( 'question_id[]', $question->id , ['class' => 'd-none']) !!}
                    <div class="form-floating">
                        {!! Form::number( 'punctuation[]', null, ['class' => 'form-control', 'placeholder' => 'Pontuação', 'required']) !!}
                        <label for="punctuation">Pontuação</label>
                    </div>
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="form-floating">
                        {!! Form::textarea( 'notes[]', null, ['class' => 'form-control', 'placeholder' => 'Notas', 'style' => 'height: 100px;']) !!}
                        <label for="notes">Notas</label>
                    </div>
                </div>
            </div>


        @endforeach
        <div class="text-center">
            {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
           <button type="button"  onclick="window.location='{{ route('performanceEvaluations.managerlist') }}'"  class="btn btn-secondary">Voltar</button>
        </div>
        {!! Form::close() !!}
    <div>
<div>

@endsection

@section('js-view')
@endsection