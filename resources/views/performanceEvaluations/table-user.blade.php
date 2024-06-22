
<table class="table data-table">
    <thead>
      <tr>
        <th>Id</th>
        <th class="text-center">Prazo</th>
        <th class="text-center">Gestor</th>
        <th class="text-center">Colaborador</th>
        <th class="text-center">Observação</th>
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
            <td class="text-center"> {{ $performanceEvaluation->notes }}</td>
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
                        @if ($performanceEvaluation->status == 'completed')
                            <li><a class="dropdown-item" href="{{ route('performanceEvaluations.show', $performanceEvaluation->id)}}">Visualizar</a></li>
                        @endif

                        @can('manager') 
                            @if ($performanceEvaluation->status == 'pending')
                                <li><a class="dropdown-item" href="{{ route('performanceEvaluations.accomplish', $performanceEvaluation->id)}}">Realizar</a></li>
                            @endif
                        @endcan

                        @can('admin') 
                            @if ($performanceEvaluation->status == 'pending')
                                <li><a class="dropdown-item" href="{{ route('performanceEvaluations.accomplish', $performanceEvaluation->id)}}">Realizar</a></li>
                            @endif
                        @endcan
                    </ul>
                </div>
            </td>
        </tr>
        @endforeach
    </tbofy>
</table>
