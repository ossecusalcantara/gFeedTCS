
<div class="mt-10 grid grid-cols-2 gap-x-6 gap-y-8 sm:grid-cols-6">
    <div class="sm:col-span-3">
        @include('templates.formulario.input', [
            'input' => 'name', 
            'label' => 'Nome',
            'class' => 'block text-sm font-medium leading-6 text-gray-900' ,
            'attributes' => ['class' => 'block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6']])
    </div>
    <div class="sm:col-span-3">
        @include('templates.formulario.input', [
            'input' => 'cpf', 
            'label' => 'CPF', 
            'class' => 'block text-sm font-medium leading-6 text-gray-900' ,
            'attributes' => ['class' => 'block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6']])
    </div>
</div>

<div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
    <div class="sm:col-span-3">
        @include('templates.formulario.input', [
            'input' => 'email', 
            'label' => 'E-mail',
            'class' => 'block text-sm font-medium leading-6 text-gray-900' ,
            'attributes' => [ 'class' => 'input block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6']])
    </div>
    <div class="sm:col-span-3">
        @include('templates.formulario.select', [
            'select' => 'gender', 
            'label' => 'Gênero',
            'data' => ['M' => 'Masculino', 'F' => 'Feminino'],
            'class' => 'block text-sm font-medium leading-6 text-gray-900' ,
            'attributes' => [ 'class' => 'block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6']])
    </div>
</div>

<div class="mt-10 grid grid-cols-2 gap-x-6 gap-y-8 sm:grid-cols-6">
    <div class="sm:col-span-3">
        @include('templates.formulario.input', [
            'input' => 'phone', 
            'label' => 'Telefone',
            'class' => 'block text-sm font-medium leading-6 text-gray-900' ,
            'attributes' => ['class' => 'block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6']])
    </div>
    <div class="sm:col-span-2">
        @include('templates.formulario.input', [
            'input' => 'birth', 
            'label' => 'Data de Aniversário',
            'class' => 'block text-sm font-medium leading-6 text-gray-900' ,
            'attributes' => ['class' => 'block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6']])
     </div>
</div>

<div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
    <div class="sm:col-span-3">
        @include('templates.formulario.password', [
            'input' => 'password', 
            'label' => 'Senha',
            'attributes' => ['class' => 'block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6']])
    </div>
</div>