@extends('templates.master')

@section('css-view')
@endsection

@section('conteudo-view')

    @if(session('success'))
        <h3>{{ session('success')['messages'] }}</he>
    @endif


	{!! Form::open(['route' => 'user.store','method' => 'post', 'class' => 'form-padrao']) !!}

        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Usuário</h2>
                <p class="mt-1 text-sm leading-6 text-gray-600">Cadastro de novo usuário, preencha todas os campos.</p>

                @include('user.form-fields')
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            @include('templates.formulario.submit', [
                'input' => 'Cadastrar',
                'attributes' => ['class' => 'rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600'] ])
        </div>
    {!! Form::close() !!}

@endsection

@section('js-view')
@endsection