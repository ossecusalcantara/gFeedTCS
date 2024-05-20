
<table class="table datatable">
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
