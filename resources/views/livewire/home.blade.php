@php
use App\Http\Controllers\StaticController;

$total_criterio['valor_Global'] = 0;
$total_criterio['total_Global'] = 0;

$soma_alternativasPrioridade['total'] = 0;
$soma_alternativasPrioridadeGlobal['total'] = 0;

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

                            <th>{{ $criterios->sigla }}</th>
                        @endforeach
                        <th>µ</th>
                        <th>wj-peso relativo do critério cj</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($getCriterios as $criterios1)
                        @php
                            //pegar total criterios
                            $total_criterio['valor'] = 0;
                            $total_criterio['total'] = 0;
                            $getTotalCriterio = StaticController::getTotalCriterio($criterios1->id);
                            if ($getTotalCriterio) {
                                $total_criterio['valor'] = $getTotalCriterio->valor;
                                $total_criterio['total'] = $getTotalCriterio->total;
                            } else {
                                $total_criterio['valor'] = 0;
                                $total_criterio['total'] = 0;
                            }
                            $total_criterio['valor_Global'] = $total_criterio['valor_Global'] + $total_criterio['valor'];
                            $total_criterio['total_Global'] = $total_criterio['total_Global'] + $total_criterio['total'];
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

                            <td>{{ $total_criterio['valor'] }}</td>
                            <td>{{ $total_criterio['total'] }}
                                &nbsp;
                                &nbsp;
                                <a href="#" wire:click.prevent="calculateTotalCriterio({{ $criterios1->id }})">C</a>
                            </td>
                        </tr>

                    @endforeach
                    <tr>
                        <td colspan="4">Total</td>
                        <td>{{ $total_criterio['valor_Global'] }}</td>
                        <td>{{ $total_criterio['total_Global'] }}</td>
                    </tr>
                </tbody>
            </table>
            <!-- fim -->

            @foreach ($getCriterios as $criterios)
                @php
                    $total_alternatica_criterio['valor_Global'] = 0;
                    $total_alternatica_criterio['total_Global'] = 0;
                @endphp
                <hr />
                <h4>{{ $loop->iteration }}. Cálculo Peso das alternativas no critério {{ $criterios->criterio }}</h3>
                    <table border="1">
                        <thead>
                            <tr>
                                <th>{{ $criterios->sigla }} ()</th>
                                @foreach ($getAlternativas as $alternativas)
                                    <th>{{ $alternativas->sigla }}</th>
                                @endforeach
                                <th>∑</th>
                                <th>α</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($getAlternativas as $alternativas1)
                                @php
                                    $total_alternatica_criterio['valor'] = 0;
                                    $total_alternatica_criterio['total'] = 0;
                                    //pegar o total dos criterios
                                    $getTotalAlternativaCriterio = StaticController::getTotalAlternativaCriterio($criterios->id, $alternativas1->id);
                                    if ($getTotalAlternativaCriterio) {
                                        $total_alternatica_criterio['valor'] = $getTotalAlternativaCriterio->valor;
                                        $total_alternatica_criterio['total'] = $getTotalAlternativaCriterio->total;
                                    } else {
                                        $total_alternatica_criterio['valor'] = 0;
                                        $total_alternatica_criterio['total'] = 0;
                                    }

                                    $total_alternatica_criterio['valor_Global'] = $total_alternatica_criterio['valor_Global'] + $total_alternatica_criterio['valor'];
                                    $total_alternatica_criterio['total_Global'] = $total_alternatica_criterio['total_Global'] + $total_alternatica_criterio['total'];
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
                                    <td>{{ $total_alternatica_criterio['valor'] }}</td>
                                    <td>
                                        {{ $total_alternatica_criterio['total'] }}
                                        &nbsp;&nbsp;
                                        <a href="#"
                                            wire:click.prevent="calculateTotalAlternativaCriterio({{ $criterios->id }}, '{{ $alternativas1->id }}')">C</a>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="4">Total</td>
                                <td>{{ $total_alternatica_criterio['valor_Global'] }}</td>
                                <td>{{ $total_alternatica_criterio['total_Global'] }}</td>
                            </tr>
                        </tbody>
                    </table>
            @endforeach

            <hr />
            <h4>Prioridade dos Projectos por critérios</h4>
            <table border="1">
                <thead>
                    <tr>
                        <th></th>
                        @foreach ($getCriterios as $criterios)
                            <th>{{ $criterios->sigla }}</th>
                        @endforeach
                        <th>∑</th>
                        <th>π</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($getAlternativas as $alternativas)
                        <tr>
                            <td>{{ $alternativas->sigla }}</td>
                            @foreach ($getCriterios as $criterios)
                                @php
                                    $prioridades['valor'] = 0;
                                    $prioridades['total'] = 0;
                                    $getValorPrioridade = StaticController::getValorPrioridade($criterios->id, $alternativas->id);
                                    if ($getValorPrioridade) {
                                        $prioridades['valor'] = $getValorPrioridade->valor;
                                        $prioridades['total'] = $getValorPrioridade->total;
                                    } else {
                                        $prioridades['valor'] = 0;
                                        $prioridades['total'] = 0;
                                    }
                                @endphp
                                <td>
                                    {{ $prioridades['valor'] }}
                                    &nbsp;&nbsp;
                                    <a href="#"
                                        wire:click.prevent="calculateValorPrioridade({{ $criterios->id }}, '{{ $alternativas->id }}')">C</a>
                                </td>
                            @endforeach
                            @php
                                $somaAlternativaPrioridade = StaticController::somaAlternativaPrioridade($alternativas->id);
                                $soma_alternativasPrioridade['total'] = $soma_alternativasPrioridade['total'] + $somaAlternativaPrioridade;

                                $somaAlternativaPrioridadeGlobal = StaticController::somaAlternativaPrioridadeGlobal($alternativas->id);
                                $soma_alternativasPrioridadeGlobal['total'] = $soma_alternativasPrioridadeGlobal['total'] + $somaAlternativaPrioridadeGlobal;
                            @endphp
                            <td>{{ $somaAlternativaPrioridade }}</td>
                            <td>
                                {{ $prioridades['total'] }}
                                &nbsp;&nbsp;
                                <a href="#" wire:click.prevent="calculateTotalPrioridade({{ $alternativas->id }})">C</a>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="4">Total</td>
                        <td>{{ $soma_alternativasPrioridade['total'] }}</td>
                        <td>
                            <!--{{ $soma_alternativasPrioridadeGlobal['total'] }}-->
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
