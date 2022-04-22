<div>
    @section('title', $title)
    @section('menu', $menu)
    @section('submenu', $submenu)
    @section('type', $type)

        <div class="content">
            <h1>Alternativas</h1>
            <hr />
            <table border="1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Alternativa</th>
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
                                <a href="/alternativas/create-vs/{{ $alternativas->id }}">Alternativa-VS</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>


        </div>
    </div>
