<div>
    @section('title', $title)
    @section('menu', $menu)
    @section('submenu', $submenu)
    @section('type', $type)

        <div class="content">
            <h1>{{ $getCriterio->criterio }} Vs</h1>
            <hr />

            <div class="form">
                <div class="col-md-12">
                    @if (session('error'))
                        <div class="alert alert-error alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
                            <h4 class="alert-heading">Error!</h4>
                            {{ session('error') }}
                        </div>

                    @endif

                    @if (session('success'))

                        <div class="alert alert-success alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
                            <h4 class="alert-heading">Success!</h4>
                            {{ session('success') }}
                        </div>

                    @endif
                </div>

                <form wire:submit.prevent="submit">
                    <select wire:model="criterio">
                        <option hidden>Critério</option>
                        @foreach ($getCriterios as $criterios)
                            <option value="{{ $criterios->id }}">{{ $criterios->criterio }}</option>
                        @endforeach
                    </select>
                    @error('criterio')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <br /><br />
                    <input type="text" placeholder="Valor" wire:model="valor" />
                    @error('valor')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <br /><br />
                    <button type="submit">Salvar</button>
                </form>
            </div>
            <br />
            <div class="table">
                <table border="1">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Critério 1</th>
                            <th>Critério 2</th>
                            <th>Valor</th>
                            <th>Operações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($getCriteriosVS as $criteriosvs)
                            <tr>
                                <td>{{ $criteriosvs->id }}</td>
                                <td>{{ $criteriosvs->id_criterio1 }}</td>
                                <td>{{ $criteriosvs->id_criterio2 }}</td>
                                <td>{{ $criteriosvs->valor }}</td>
                                <td>
                                    <a href="/criterios/eliminar-vs/{{ $criteriosvs->id }}">Eliminar-VS</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
