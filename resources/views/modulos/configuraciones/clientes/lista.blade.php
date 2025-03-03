@extends('modulos.layouts.app')

@section('style')
<style>
    .dt-buttons.btn-group.btn-foto-posicion {
        position: relative;
        inset-block-start: auto;
        inset-inline-start: auto;
        float: left;
    }
    .dt-buttons.btn-group {
        position: relative !important;
        inset-block-start: auto !important;
        inset-inline-start: auto !important;
        float: left;
    }
</style>
@endsection

@section('content')
<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Gestion de Clientes</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Administrador</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Configuraciones</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Clientes</li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->

            <!-- ROW-1 OPEN -->
            <!-- Row -->
            <div class="row ">
                <div class="col-md-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Lista de clientes</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered text-nowrap border-bottom" id="tabla-data">
                                    <thead>
                                        <tr>
                                            <th class="wd-15p border-bottom-0">#</th>
                                            <th class="wd-15p border-bottom-0">Nombres</th>
                                            <th class="wd-20p border-bottom-0">Apellidos</th>
                                            <th class="wd-15p border-bottom-0">Email</th>
                                            <th class="wd-10p border-bottom-0">Estado</th>
                                            <th class="wd-25p border-bottom-0">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- /Row -->
        </div>
        <!-- CONTAINER CLOSED -->
    </div>
</div>


<!-- MODAL EFFECTS -->
<div class="modal fade" id="modal-cliente">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Message Preview</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="" id="form-cliente">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="" class="form-label">N° de documento</label>
                                <input
                                    type="text"
                                    name="numero_documento"

                                    class="form-control form-control-sm"
                                    placeholder=""
                                    aria-describedby="helpId"
                                    required
                                />
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="" class="form-label">Apellidos</label>
                                <input
                                    type="text"
                                    name="apellidos"

                                    class="form-control form-control-sm"
                                    placeholder=""
                                    aria-describedby="helpId"
                                    required
                                />
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="" class="form-label">Nombres</label>
                                <input
                                    type="text"
                                    name="nombres"

                                    class="form-control form-control-sm"
                                    placeholder=""
                                    aria-describedby="helpId"
                                    required
                                />
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="" class="form-label">Email</label>
                                <input
                                    type="email"
                                    name="email"

                                    class="form-control form-control-sm"
                                    placeholder=""
                                    aria-describedby="helpId"
                                    required
                                />
                            </div>

                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="" class="form-label">Contraseña</label>
                                <input
                                    type="password"
                                    name="password"

                                    class="form-control form-control-sm"
                                    placeholder=""
                                    aria-describedby="helpId"
                                    required
                                />
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="" class="form-label">Repita su contraseña</label>
                                <input
                                    type="password"
                                    name="rep_password"

                                    class="form-control form-control-sm"
                                    placeholder=""
                                    aria-describedby="helpId"
                                    required
                                />
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save"></i> Guardar</button>
                    <button class="btn btn-light btn-sm" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>



<div class="modal fade effect-super-scaled" id="alert-eliminar">
    <div class="modal-dialog modal-dialog-centered text-center modal-sm" role="document">
        <div class="modal-content tx-size-sm">
            <div class="modal-body text-center p-4 pb-5">
                <button aria-label="Close" class="btn-close position-absolute" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                <i class="icon icon-close fs-70 text-danger lh-1 my-5 d-inline-block"></i>
                <h4 class="text-danger">Dar debaja reguistro!</h4>
                <p class="mg-b-20 mg-x-20">Se procedera a inactivar este reguistro de la base de datos.</p>
                <button class="btn btn-danger pd-x-25" data-action="enviar" data-id="0">Aceptar</button>
                <button class="btn btn-default pd-x-25" data-bs-dismiss="modal" aria-label="Close">Cancelar</button>
            </div>
        </div>
    </div>
</div>


@endsection

@section('script')
<!-- INTERNAL SELECT2 JS -->
<script src="{{ asset('template/plugins/select2/select2.full.min.js') }}"></script>

<!-- DATA TABLE JS-->
<script src="{{ asset('template/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('template/plugins/datatable/js/dataTables.bootstrap5.js') }}"></script>
<script src="{{ asset('template/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('template/plugins/datatable/js/buttons.bootstrap5.min.js') }}"></script>
{{-- <script src="{{ asset('template/plugins/datatable/js/jszip.min.js') }}"></script> --}}
{{-- <script src="{{ asset('template/plugins/datatable/pdfmake/pdfmake.min.js') }}"></script> --}}
{{-- <script src="{{ asset('template/plugins/datatable/pdfmake/vfs_fonts.js') }}"></script> --}}
{{-- <script src="{{ asset('template/plugins/datatable/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('template/plugins/datatable/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('template/plugins/datatable/js/buttons.colVis.min.js') }}"></script> --}}
<script src="{{ asset('template/plugins/datatable/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('template/plugins/datatable/responsive.bootstrap5.min.js') }}"></script>
<script src="{{ asset('template/js/table-data.js') }}"></script>

<script src="{{ asset('modulos/js/administrador/configuraciones/clientes/cliente-view.js') }}"></script>
<script src="{{ asset('modulos/js/administrador/configuraciones/clientes/cliente-model.js') }}"></script>
<script>
    const view = new ClienteView(new ClienteModel(token));
    // // view.listar(buscar);
    view.listar();
    view.eventos();
</script>
@endsection
