@php
use App\Http\Controllers\StaticController;
$total['coluna'] = 0;
$total['linha0'] = 0;
$wj['coluna'] = 0;

$total['coluna_alternativa'] = 0;
$total['linha0_alternativa'] = 0;
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
                            <td>{{ round($wj['linha'], 3) }}</td>
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

            @foreach ($getCriterios as $criterios)
                @php
                    $total['linha001'] = StaticController::getTotalLinha($criterios->id);
                    $wj['linha_alternativa'] = $total['linha001'] / $total['coluna'];
                    //$wj['coluna_alternativa'] = $wj['coluna_alternativa'] + $wj['linha_alternativa'];
                @endphp
                <hr />
                <h4>{{ $loop->iteration }}. Cálculo Peso das alternativas no critério {{ $criterios->criterio }}</h3>
                    <table border="1">
                        <thead>
                            <tr>
                                <th>{{ $criterios->sigla }} ({{ round($wj['linha_alternativa'], 3) }})</th>
                                @foreach ($getAlternativas as $alternativas)
                                    @php
                                        $total['linha0_alternativa'] = StaticController::getTotalLinhaAlternativa($alternativas->id, $criterios->id);
                                        $total['coluna_alternativa'] = $total['coluna_alternativa'] + $total['linha0_alternativa'];
                                    @endphp
                                    <th>{{ $alternativas->sigla }}</th>
                                @endforeach
                                <th>∑</th>
                                <th>α</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($getAlternativas as $alternativas1)
                                @php
                                    $valor_alternativa = 0;
                                    $total['linha_alternativa'] = StaticController::getTotalLinhaAlternativa($alternativas1->id, $criterios->id);
                                    $wj['linha_alternativa1'] = $total['linha_alternativa'] / $total['coluna_alternativa'];

                                @endphp
                                <tr>
                                    <td>{{ $alternativas1->sigla }}</td>
                                    @foreach ($getAlternativas as $alternativas2)
                                        @php
                                            $valor_alternativa = 0;
                                            $getAlternativaValue = StaticController::getAlternativaValue($criterios->id, $alternativas1->id, $alternativas2->id);
                                            if ($getAlternativaValue) {
                                                $valor_alternativa = $getAlternativaValue->valor;
                                            } else {
                                                $valor_alternativa = 0;
                                            }
                                        @endphp
                                        <td>{{ $valor_alternativa }}</td>
                                    @endforeach
                                    <td>{{ $total['linha_alternativa'] }}</td>
                                    <td>{{ round($wj['linha_alternativa1'],3) }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="4">Total</td>
                                <td>--</td>
                                <td>--</td>
                            </tr>
                        </tbody>
                    </table>
            @endforeach

        </div>
    </div>
