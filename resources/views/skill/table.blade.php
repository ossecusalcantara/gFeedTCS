
<table class="table data-table">
    <thead>
      <tr>
        <th>Id</th>
        <th>Nome</th>
        <th>Tipo</th>
        <th class="text-center">Ações</th>
      </tr>
  
    <tbody>
        @foreach ($skills as $skill)
        <tr>
            <th> {{ $skill->id }}</th>
            <td> {{ $skill->name }}</td>
            <td> {{ $skill->formatted_type }}</td>
            <td class="text-center">
                <div class="btn-group">
                    <button type="button" class="btn btn-sm " data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-three-dots"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('skill.show', $skill->id)}}">Visualizar</a></li>
                        <li><a class="dropdown-item" href="{{ route('skill.edit', $skill->id)}}">Editar</a></li>
    
                        {!! Form::open(['route' => ['skill.destroy', $skill->id], 'method' => 'DELETE', 'style' => 'display:inline;']) !!}
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
