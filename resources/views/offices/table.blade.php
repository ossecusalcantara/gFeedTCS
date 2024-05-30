
<table class="table data-table">
    <thead>
      <tr>
        <th>Id</th>
        <th>Nome</th>
        <th class="text-center">Ações</th>
      </tr>
  
    <tbody>
        @foreach ($offices as $office)
        <tr>
            <th> {{ $office->id }}</th>
            <td> {{ $office->name }}</td>
            <td class="text-center">
                <div class="btn-group">
                    <button type="button" class="btn btn-sm " data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-three-dots"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('office.show', $office->id)}}">Visualizar</a></li>
                        <li><a class="dropdown-item" href="{{ route('office.edit', $office->id)}}">Editar</a></li>
    
                        {!! Form::open(['route' => ['office.destroy', $office->id], 'method' => 'DELETE', 'style' => 'display:inline;']) !!}
                            @csrf
                            {!! Form::submit('Excluir', ['class' => 'dropdown-item', 'onclick' => "return confirm('Você tem certeza que deseja excluir este cargo?');"]) !!}
                        {!! Form::close() !!}
                    </ul>
                </div>
            </td>
        </tr>
        @endforeach
    </tbofy>
</table>
