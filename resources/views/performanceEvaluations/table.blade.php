
<table class="table data-table">
    <thead>
      <tr>
        <th>Id</th>
        <th class="text-center">Prazo</th>
        <th class="text-center">Gestor</th>
        <th class="text-center">Colaborador</th>
        <th class="text-center">Status</th>
        <th class="text-center">Ações</th>
      </tr>
  
    <tbody>
        @foreach ($performanceEvaluations as $performanceEvaluation)
        <tr>
            <th> {{ $performanceEvaluation->id }}</th>
            <td class="text-center"> {{ $performanceEvaluation->formatted_deadline }}</td>
            <td class="text-center"> {{ $performanceEvaluation->manager->name }}</td>
            <td class="text-center"> {{ $performanceEvaluation->user->name }}</td>
            <td class="text-center"> 
                @if ($performanceEvaluation->status == 'pending')
                    <span class="badge bg-danger">Pendente</span>
                @else
                    <span class="badge bg-success">Concluído</span>
                @endif
            </td>
            <td class="text-center">
                <div class="btn-group">
                    <button type="button" class="btn btn-sm " data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-three-dots"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('performanceEvaluations.show', $performanceEvaluation->id)}}">Visualizar</a></li>

                    @can('manager')
                        @if ($performanceEvaluation->status == 'pending')
                            <li><a class="dropdown-item" href="{{ route('performanceEvaluations.accomplish', $performanceEvaluation->id)}}">Realizar</a></li>
                        @endif
                    @endcan

                    @can('admin')
                        <li><a class="dropdown-item" href="{{ route('performanceEvaluations.edit', $performanceEvaluation->id)}}">Editar</a></li>
    
                        {!! Form::open(['route' => ['performanceEvaluations.destroy', $performanceEvaluation->id], 'method' => 'DELETE', 'style' => 'display:inline;']) !!}
                            @csrf
                            {!! Form::submit('Excluir', ['class' => 'dropdown-item', 'onclick' => "return confirm('Você tem certeza que deseja excluir este cargo?');"]) !!}
                        {!! Form::close() !!}
                        @endcan
                    </ul>
                </div>
            </td>
        </tr>
        @endforeach
    </tbofy>
</table>
