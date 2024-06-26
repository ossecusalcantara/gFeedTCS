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
                                <h5 class="card-title">Cargos</h5>
                            </div>
                            <div class="col-lg-2 pt-3 text-end">
                                
                                <button type="button" onclick="window.location='{{ route('office.store') }}'" class="btn btn-primary btn-sm ">
                                    Add Cargo
                                </button>
                            </div>
                        </div>
                   
                    @include('offices.table')
                </div>
            </div>
        </div>
    </section>

@endsection

@section('js-view')
@endsection