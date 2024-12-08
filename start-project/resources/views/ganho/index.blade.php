@extends('template.main', ['menu' => "admin", 'submenu' => "Ganhos", 'rota'=>"ganho.create"])

@section('titulo') Desenvolvimento Web @endsection

@section('conteudo')

<style>
.table-custom {
    border: 1px solid #007bff;
    border-radius: 8px;
    overflow: hidden;
}

.table-caption {
    text-align: center;
    font-size: 1.5rem;
    color: #0056b3;
    background-color: #e7f3ff;
    padding: 10px;
    font-weight: bold;
}

.table-header {
    background-color: #007bff;
    color: #ffffff;
}

.table-header th {
    text-align: center;
    font-weight: bold;
}

.table-striped tbody tr:nth-of-type(odd) {
    background-color: #f0f8ff;
}

.btn-custom {
    border-radius: 50px;
    padding: 5px 15px;
    transition: all 0.3s ease-in-out;
}

.btn-custom:hover {
    transform: scale(1.1);
}

.btn-primary {
    background-color: #0056b3;
    border-color: #004080;
}

.btn-danger {
    background-color: #ff4d4d;
    border-color: #cc0000;
}

.table td,
.table th {
    padding: 15px;
    text-align: center;
    vertical-align: middle;
}
</style>
<div class="row justify-content-center">
    <div class="col-12 col-lg-10">
        <table class="table align-middle caption-top table-striped bg-white table-custom">
            <thead class="table-header">
                <tr>
                    <th scope="col" class="d-none d-md-table-cell">ID</th>
                    <th scope="col">NOME</th>
                    <th scope="col" class="d-none d-md-table-cell">VALOR</th>
                    <th scope="col">FIXO</th>
                    <th scope="col">CATEGORIA</th>
                    <th scope="col">AÇÕES</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr>
                    <td class="d-none d-md-table-cell">{{ $item->id }}</td>
                    <td>{{ $item->nome }}</td>
                    <td>{{ $item->valor }}</td>
                    <td>
                        @if($item->fixo == 1)
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#009929"
                            class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                            <path
                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                        </svg>
                        @else
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#cc0000"
                            class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                            <path
                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646-2.647a.5.5 0 0 0-.708-.708L8 7.293z" />
                        </svg>
                        @endif
                    </td>
                    <td>{{ $item->categoria->nome ?? 'Categoria não encontrada' }}</td>
                    <td>
                        <a href="{{ route('ganho.edit', $item->id) }}" class="btn btn-primary btn-custom">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FFFFFF"
                                class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                <path
                                    d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z" />
                            </svg>
                        </a>
                        <a nohref style="cursor:pointer"
                            onclick="showRemoveModal('{{ $item->id }}', '{{ $item->nome }}')"
                            class="btn btn-danger btn-custom">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#fff"
                                class="bi bi-trash-fill" viewBox="0 0 16 16">
                                <path
                                    d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                            </svg>
                        </a>
                    </td>
                    <form action="{{ route('ganho.destroy', $item->id) }}" method="POST" id="form_{{$item->id}}">
                        @csrf
                        @method('DELETE')
                    </form>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection