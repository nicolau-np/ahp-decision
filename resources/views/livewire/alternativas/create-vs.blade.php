<div>
    @section('title', $title)
    @section('menu', $menu)
    @section('submenu', $submenu)
    @section('type', $type)

        <div class="content">
            <h1>{{ $getAlternativa->alternativa }} =>{{ $getAlternativa->sigla }} Vs</h1>
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
                    <select wire:model="alternativa">
                        <option hidden>Projecto</option>
                        @foreach ($getAlternativas as $alternativas)
                            <option value="{{ $alternativas->id }}">{{ $alternativas->sigla }}</option>
                        @endforeach
                    </select>
                    @error('alternativa')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <br /><br />
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
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Critério</th>
                            <th>Projecto A</th>
                            <th>Projecto B</th>
                            <th>Valor</th>
                            <th>Operações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($getAlternativasVS as $alternativasvs)
                            <tr>
                                <td>{{ $alternativasvs->id }}</td>
                                <td>{{ $alternativasvs->criterios->criterio }}</td>
                                <td>{{ $alternativasvs->alternativas1->sigla }}</td>
                                <td>{{ $alternativasvs->alternativas2->sigla }}</td>
                                <td>{{ $alternativasvs->valor }}</td>
                                <td>
                                    <a href="/alternativas/eliminar-vs/{{ $alternativasvs->id }}">Eliminar-VS</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
