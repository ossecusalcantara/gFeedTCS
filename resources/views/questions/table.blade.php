
<table class="table data-table">
    <thead>
      <tr>
        <th>Id</th>
        <th>Nome</th>
        <th>Tipo</th>
        <th class="text-center">Ações</th>
      </tr>
  
    <tbody>
        @foreach ($questions as $question)
        <tr>
            <th> {{ $question->id }}</th>
            <td> {{ $question->question_description }}</td>
            <td> {{ $question->type_question->name }}</td>
            <td class="text-center">
                <div class="btn-group">
                    <button type="button" class="btn btn-sm " data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-three-dots"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('questions.edit', $question->id)}}">Editar</a></li>
    
                        {!! Form::open(['route' => ['questions.destroy', $question->id], 'method' => 'DELETE', 'style' => 'display:inline;']) !!}
                            @csrf
                            {!! Form::submit('Excluir', ['class' => 'dropdown-item', 'onclick' => "return confirm('Você tem certeza que deseja excluir esta pergunta?');"]) !!}
                        {!! Form::close() !!}
                    </ul>
                </div>
            </td>
        </tr>
        @endforeach
    </tbofy>
</table>
