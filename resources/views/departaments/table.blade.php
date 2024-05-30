
<table class="table data-table">
    <thead>
      <tr>
        <th>Id</th>
        <th>Nome</th>
        <th class="text-center">Ações</th>
      </tr>
  
    <tbody>
        @foreach ($departaments as $departament)
        <tr>
            <th> {{ $departament->id }}</th>
            <td> {{ $departament->name }}</td>
            <td class="text-center">
                <div class="btn-group">
                    <button type="button" class="btn btn-sm " data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-three-dots"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('departament.show', $departament->id)}}">Visualizar</a></li>
                        <li><a class="dropdown-item" href="{{ route('departament.edit', $departament->id)}}">Editar</a></li>
    
                        {!! Form::open(['route' => ['departament.destroy', $departament->id], 'method' => 'DELETE', 'style' => 'display:inline;']) !!}
                            @csrf
                            {!! Form::submit('Excluir', ['class' => 'dropdown-item', 'onclick' => "return confirm('Você tem certeza que deseja excluir esta habilidade?');"]) !!}
                        {!! Form::close() !!}
                    </ul>
                </div>
            </td>
        </tr>
        @endforeach
    </tbofy>
</table>
