@php
use App\Http\Controllers\StaticController;
@endphp
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
            <hr />

            <table border="1">
                <thead>
                    <tr>
                        <th>Critério</th>
                        @foreach ($getCriterios as $criterios)
                            <th>{{ $criterios->sigla }}</th>
                        @endforeach
                        <th>µ</th>
                        <th>wj-peso relativo do critério cj</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total['coluna'] = 0;
                    @endphp
                    @foreach ($getCriterios as $criterios1)
                        @php
                            $valor = 0;
                            $total['linha'] = 0;
                        @endphp
                        <tr>
                            <td>{{ $criterios1->sigla }}</td>
                            @foreach ($getCriterios as $criterios2)
                                @php
                                    $valor = 0;
                                    $getValueCriterio = StaticController::getValueCriterio($criterios1->id, $criterios2->id);
                                    if ($getValueCriterio) {
                                        $valor = $getValueCriterio->valor;
                                    } else {
                                        $valor = 0;
                                    }

                                    $total['linha'] = $total['linha'] + $valor;
                                @endphp
                                <td>
                                    {{ $valor }}
                                </td>
                            @endforeach
                            <td>{{ $total['linha'] }}</td>
                            <td></td>
                        </tr>
                        @php
                            $total['coluna'] = $total['coluna'] + $total['linha'];
                        @endphp
                    @endforeach
                    <tr>
                        <td colspan="4">Total</td>
                        <td>{{ $total['coluna'] }}</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
