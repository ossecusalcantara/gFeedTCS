@extends('templates.master')

@section('css-view')
@endsection

@section('conteudo-view')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $skill->name }}</h5>
                <p>{{ $skill->description }}</p>

                <div class="text-center">
                    <button type="button"  onclick="window.location='{{ route('skill.listagem') }}'"  class="btn btn-secondary">Voltar</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js-view')
@endsection