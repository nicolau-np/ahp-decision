@php
use App\Http\Controllers\StaticController;
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

                            <td>---</td>
                            <td>---</td>
                        </tr>

                    @endforeach
                    <tr>
                        <td colspan="4">Total</td>
                        <td>---</td>
                        <td>---</td>
                    </tr>
                </tbody>
            </table>
            <!-- fim -->

            @foreach ($getCriterios as $criterios)
                @php

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
                                    <td>---</td>
                                    <td>---</td>
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
