
<div>
    @section('title', $title)
    @section('menu', $menu)
    @section('submenu', $submenu)
    @section('type', $type)

        <div class="content">
            <h1>Critérios</h1>
            <hr />

            <table border="1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Critério</th>
                        <th>Sígla</th>
                        <th>Estado</th>
                        <th>Operações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($getCriterios as $criterios)
                        <tr>
                            <td>{{ $criterios->id }}</td>
                            <td>{{ $criterios->criterio }}</td>
                            <td>{{ $criterios->sigla }}</td>
                            <td>{{ $criterios->estado }}</td>
                            <td>
                                <a href="/criterios/create-vs/{{ $criterios->id }}">Criterio-VS</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
       
        </div>
    </div>
