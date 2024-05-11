<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Login | G-Feed</title>
    @vite('resources/css/app.css')
</head>

<body>

    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <img class="mx-auto h-10 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">
            <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">G-Feed</h2>
            <h2 class="text-center text-1xl font-bold leading-9 tracking-tight text-gray-900">O nosso gerenciador de feedbacks</h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            {!! Form::open(['route' => 'user.login', 'method' => 'post', 'class' => 'space-y-6']) !!}
                <div>
                    <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email:</label>
                    <div class="mt-2">
                        {!! Form::text( 'username', null, ['class' => 'input block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6' ]) !!}
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Senha:</label>
                        <div class="text-sm">
                            <a href="#" class="font-semibold text-blue-600 hover:text-blue-500">Esqueceu a senha?</a>
                        </div>
                    </div>
                    <div class="mt-2">
                       {!! Form::password('password', ['class' => 'block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6']) !!}
                    </div>
                </div>

                <div>
                    {!! Form::submit('Entrar', ['class' => 'flex w-full justify-center rounded-md bg-gray-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-blue-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600']) !!}
                </div>
            {!! Form::close() !!}

        </div>
    </div>

</body>

</html>