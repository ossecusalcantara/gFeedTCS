
<table class="table data-table">
    <thead>
      <tr>
        <th>Id</th>
        @can('admin')
        <th>Avaliado</th>
        @endcan
        <th>Motivo</th>
        {{-- <th>Data</th> --}}
        <th class="text-center">Ações</th>
      </tr>
  
    <tbody>
        @foreach ($feedbacks as $feedback)
        <tr>
            <th> {{ $feedback->id }}</th>
            @can('admin')
            <td> {{ $feedback->user->name }}</td>
            @endcan
            <td> {{ $feedback->reason }}</td>
            {{-- <td> {{ $feedback->formatted_type }}</td> --}}
            <td class="text-center">
                <div class="btn-group">
                    <button type="button" class="btn btn-sm " data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-three-dots"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('feedback.show', $feedback->id)}}">Visualizar</a></li>
    
                        @can('admin')
                            {!! Form::open(['route' => ['feedback.destroy', $feedback->id], 'method' => 'DELETE', 'style' => 'display:inline;']) !!}
                                @csrf
                                {!! Form::submit('Excluir', ['class' => 'dropdown-item', 'onclick' => "return confirm('Você tem certeza que deseja excluir este feedback?');"]) !!}
                            {!! Form::close() !!}
                        @endcan
                    </ul>
                </div>
            </td>
        </tr>
        @endforeach
    </tbofy>
</table>
