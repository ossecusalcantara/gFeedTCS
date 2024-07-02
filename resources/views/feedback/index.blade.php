@extends('templates.master')

@section('css-view')
@endsection

@section('conteudo-view')

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Bem-vindo ao Formulário de Feedback.</h5>

        <p>Este formulário foi criado para coletar feedbacks valiosos e construtivos. Sua opinião é essencial para o desenvolvimento e crescimento profissional dos seus colegas de trabalho. 
        Por favor, reserve um momento para fornecer suas impressões sinceras e detalhadas.</p>

        <h6>Instruções</h6>
        <ul>
            <li> 1. Descreva suas impressões atentamente. </li>
            <li> 2. Responda de forma honesta e específica. </li>
            <li> 3. Use exemplos concretos sempre que possível. </li>
            <li> 4. Todas as suas respostas são confidenciais e serão usadas apenas para fins de desenvolvimento pessoal. </li>
        </ul>
        <br>
    
        {!! Form::open(['route' => 'feedback.store', 'method' => 'post', 'class' => 'row g-3']) !!}
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label" for="user_id">Colaborador</label>
                    {!! Form::select('user_id', $user_list , null, [ 'class' => 'form-select select2', 'aria-label' => 'Colaborador', 'required']) !!}
                </div>
                <div class="col-md-9">
                    <label class="form-label" for="reason">Descreva brevemente o motivo do feedback</label>
                    {!! Form::text('reason', null, ['class' => 'form-control', 'required']) !!}
                </div>
                <div class="col-12">
                    <label class="form-label" for="notes">Descreva com detalhes o que te levou a fazer este feedback</label>
                    {!! Form::textarea( 'notes', null, ['class' => 'form-control', 'style' => 'height: 100px;']) !!}
                </div>
                <div class="col-md-12">
                    <h6 class="card-title">Habilidades</h6>
                    <p>Escolha uma ou mais habilidades para pontuar em relaçãa a este feedback e a situação ocorrida.</p>
                </div>
                <div class="col-md-5">
                    <label class="form-label" for="skill">Habilidade Considerada</label>
                    {!! Form::select('skill', $skill_list , null, [ 'class' => 'form-select select2', 'aria-label' => 'Colaborador', 'required']) !!}
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="button" class="btn btn-secondary" id="btnAdicionar" title="Search"><i class="bi bi-plus"></i> Adicionar</button>
                </div>
                <div id="skillsContainer">
                    <div id="skillsInputBase" class="col-md-4 d-none">
                        <label class="form-label" for="ponctuation">Habilidade</label>
                        {!! Form::input('hidden', 'skill_id[]')!!}
                        {!! Form::input('range', 'pontuation[]', 5, ['min' => 1, 'max' => 10, 'step' => 1, 'class' => 'form-range']) !!}
                    </div>
                </div>
                <div class="text-center">
                    {!! Form::submit('Cadastrar', ['class' => 'btn btn-primary']) !!}
                 </div>
            </div>
        {!! Form::close() !!}
    </div>
</div>


@endsection

@section('js-view')
    <script src="{{ secure_asset('assets/js/feedback.js') }}"></script>
@endsection