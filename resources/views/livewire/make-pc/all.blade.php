<div class="container-sm">
    @if(session('status'))
        <div class="alert alert-{{ session('type_status') }}" role="alert">
            {{ session('status') }}
        </div>
    @endif

    @livewire('make-pc.filter')

    <div class="row justify-content-center mt-4">
        <h4 class="col-12">Armados de PC (<span>{{ $makepcs->total() }}</span>)</h4>
        <div class="col-12 table-responsive">
            <table class="table table-sm table-hover border-0 " id="mytable">
                <thead>
                    <tr class="border-0">
                        <th scope="col">N. Interno</th>
                        <th scope="col">N. Venta</th>
                        <th scope="col">Fecha Ult. Modif.</th>
                        <th scope="col" class="d-none d-md-table-cell">Ult. Modif. Por</th>
                        <th scope="col" class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="">
                    @foreach($makepcs as $pc)
                        <tr>
                            <td>{{ $pc->id }}</td>
                            <td>{{ $pc->NV }}</td>
                            <td>{{ $pc->updated_at}}</td>
                            <td class="d-none d-md-table-cell">{{ $pc->user->name}}</td>
                            <td class="text-center">
                                <a class="d-block d-lg-inline-block btn-sm btn btn-primary mr-lg-1 mb-lg-0 mb-1" href="{{ route('vista.makepc.editar', ['makepc' => $pc->id]) }}">
                                    Ver registro
                                </a>
                                <a class="d-block d-lg-inline-block btn-sm btn btn-danger mr-lg-1 mb-lg-0 mb-1" href="{{ route('accion.makepc.imprimir', ['makepc' => $pc->id]) }}">
                                    Imprimir etiqueta
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row">
                <div class="col">{{ $makepcs->links('vendor.pagination.bootstrap-4-livewire') }}</div>
            </div>
        </div>
    </div>
</div>
