@extends('templates.master')

@section('css-view')
@endsection

@section('conteudo-view')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $departament->name }}</h5>
                <p>{{ $departament->description }}</p>

                <div class="text-center">
                    <button type="button"  onclick="window.location='{{ route('departament.listagem') }}'"  class="btn btn-secondary">Voltar</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js-view')
@endsection