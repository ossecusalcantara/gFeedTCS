
<table class="table datatable">
    <thead>
      <tr>
        <th>Id</th>
        <th>Nome</th>
        <th>E-mail</th>
        <th>Telefone</th>
        <th>CPF</th>
        <th class="text-center">Status</th>
        <th class="text-center">Ações</th>
      </tr>
  
    <tbody>
        @foreach ($users as $user)
        <tr>
            <th> {{ $user->id }}</th>
            <td> {{ $user->name }}</td>
            <td> {{ $user->email }}</td>
            <td> {{ $user->formatted_phone }}</td>
            <td> {{ $user->formatted_cpf }}</td>
            <td class="text-center"> 
                @if ($user->status == 'active')
                    <span class="badge bg-success">Ativo</span>
                @else
                    <span class="badge bg-danger">Inativo</span>
                @endif
            </td>
            <td class="text-center">
                <div class="btn-group">
                    <button type="button" class="btn btn-sm " data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-three-dots"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Visualizar</a></li>
                        <li><a class="dropdown-item" href="#">Editar</a></li>
                        <li><a class="dropdown-item" href="#">Excluir</a></li>
                    </ul>
                </div>
            </td>
        </tr>
        @endforeach
    </tbofy>
</table>
