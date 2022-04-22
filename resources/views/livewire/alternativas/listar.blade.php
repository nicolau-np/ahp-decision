<div>
    @section('title', $title)
    @section('menu', $menu)
    @section('submenu', $submenu)
    @section('type', $type)

        <div class="content">
            <h1>Projectos</h1>
            <hr />
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Projecto</th>
                        <th>Sígla</th>
                        <th>Estado</th>
                        <th>Operações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($getAlternativas as $alternativas)
                        <tr>
                            <td>{{ $alternativas->id }}</td>
                            <td>{{ $alternativas->alternativa }}</td>
                            <td>{{ $alternativas->sigla }}</td>
                            <td>{{ $alternativas->estado }}</td>
                            <td>
                                <a href="/alternativas/create-vs/{{ $alternativas->id }}" class="">Comparar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>


        </div>
    </div>
