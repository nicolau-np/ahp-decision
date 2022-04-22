@php
use App\Http\Controllers\StaticController;
$total['coluna'] = 0;
$total['linha0'] = 0;
$wj['coluna'] = 0;
@endphp

<div>
    @section('title', $title)
    @section('menu', $menu)
    @section('submenu', $submenu)
    @section('type', $type)

        <div class="content">
            <h1>AHP Decision</h1>

            <hr />
            <!-- tabela dos criterios sobre os criterios-->
            <table border="1">
                <thead>
                    <tr>
                        <th>Critério</th>
                        @foreach ($getCriterios as $criterios)
                            @php
                                $total['linha0'] = StaticController::getTotalLinha($criterios->id);
                                $total['coluna'] = $total['coluna'] + $total['linha0'];
                            @endphp
                            <th>{{ $criterios->sigla }}</th>
                        @endforeach
                        <th>µ</th>
                        <th>wj-peso relativo do critério cj</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($getCriterios as $criterios1)
                        @php
                            $valor = 0;
                            $wj['linha'] = 0;
                            $total['linha'] = StaticController::getTotalLinha($criterios1->id);
                            $wj['linha'] = $total['linha'] / $total['coluna'];
                            $wj['coluna'] = $wj['coluna'] + $wj['linha'];
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

                                @endphp
                                <td>
                                    {{ $valor }}
                                </td>
                            @endforeach

                            <td>{{ $total['linha'] }}</td>
                            <td>{{ round($wj['linha'], 4) }}</td>
                        </tr>

                    @endforeach
                    <tr>
                        <td colspan="4">Total</td>
                        <td>{{ $total['coluna'] }}</td>
                        <td>{{ $wj['coluna'] }}</td>
                    </tr>
                </tbody>
            </table>
            <!-- fim -->

            <hr />
            
        </div>
    </div>
