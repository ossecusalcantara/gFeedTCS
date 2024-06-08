@extends('templates.master')

@section('css-view')
@endsection

@section('conteudo-view')

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-10">
                            <h5 class="card-title">Avaliações de Desempenho</h5>
                        </div>
                    </div>
               
                @include('performanceEvaluations.table')
            </div>
        </div>
    </div>
</section>

@endsection

@section('js-view')
@endsection