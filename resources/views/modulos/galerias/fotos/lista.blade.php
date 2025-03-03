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
                <h1 class="page-title">Gestion de Fotos</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Modulos</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Galeria</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Fotos</li>
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
                            <h3 class="card-title">Agregar fotos</h3>
                        </div>
                        <div class="card-body">
                            <form action="" id="formulario-fotos">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group select2-sm">
                                            <label for="album_id">Album: </label>
                                            <select class="form-select form-select-sm select2" name="album_id" id="album_id" required>
                                                <option value="">Seleccione...</option>
                                                @foreach ($albumes as $key=>$value)
                                                <option value="{{$value->id}}">{{$value->titulo}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row"id="imagenes-productos">
                                    <label class="form-label mb-4">Cargar imagenes  :</label>
                                    <div class="col-md-2">

                                        <div class="text-wrap" >
                                            <div class="file-image-1" data-action="cargar-imagen"
                                            style="
                                                background-image: url({{ asset('modulos/images/cloud.jpg') }});
                                                background-repeat: no-repeat;
                                                background-size: cover;
                                                background-position: center;
                                            " >
                                            <a href="#"></a>
                                            </div>
                                            <input type="file" class="d-none" data-seccion="file" name="imagen[]" accept="image/png, image/jpeg, image/jpg">

                                            {{-- @if (sizeof($imagenes)>0)
                                                @foreach ($imagenes as $item)

                                                <div class="file-image-1" data-id="{{$item->id}}"
                                                    style="
                                                        background-image: url({{ asset('admin/marketing/productos/images').'/'.$item->descripcion }});
                                                        background-repeat: no-repeat;
                                                        background-size: contain;
                                                        background-position: center;
                                                    "
                                                    >
                                                    <a href="#">
                                                    </a>
                                                    <ul class="icons">
                                                        <li>
                                                        <a href="#" class="btn bg-danger eliminar" data-id="{{$item->id}}" data-action="eliminar">
                                                            <i class="fe fe-trash"></i>
                                                        </a>
                                                        </li>
                                                    </ul>
                                                </div>

                                                @endforeach
                                            @endif --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button class="btn btn-success btn-sm" type="submit"><i class="fa fa-save"></i> Guardar fotos</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title mb-0">Fotos</h3>
                        </div>
                        <div class="card-body pt-4">
                            <div class="grid-margin">
                                <div class="">
                                    <div class="panel panel-primary">
                                        <div class="tab-menu-heading border-0 p-0">
                                            <div class="tabs-menu1">
                                                <!-- Tabs -->
                                                <ul class="nav panel-tabs product-sale">
                                                    <li>
                                                        <a href="#tab5" class="active" data-bs-toggle="tab">Galeria</a>
                                                    </li>
                                                    <li>
                                                        <a href="#tab6" data-bs-toggle="tab" class="text-dark">Album</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="panel-body tabs-menu-body border-0 pt-0">
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="tab5">
                                                    {{-- tabla 5 --}}
                                                    <ul id="lightgallery" class="list-unstyled row">
                                                        @foreach ($galeria as $item)
                                                        <li class="col-xs-6 col-sm-4 col-md-4 col-xl-3 mb-5 border-bottom-0" data-responsive="{{ asset('').$item->path }}" data-src="{{ asset('').$item->path }}" data-sub-html="<h4>{{$item->titulo}}</h4><p> {{$item->description}}</p>">
                                                            <a href="javascript:void(0)">
                                                                <img class="img-responsive br-5" src="{{ asset('').$item->path }}" alt="Thumb-1">
                                                            </a>
                                                        </li>
                                                        @endforeach

                                                    </ul>
                                                </div>
                                                <div class="tab-pane" id="tab6">
                                                    {{-- tab 6 --}}
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div id="carousel-captions" class="carousel slide" data-bs-ride="carousel">
                                                                <div class="carousel-inner">
                                                                    @foreach ($galeria as $key=>$item)
                                                                        <div class="carousel-item {{ $key == 0 ? 'active':''}}">
                                                                            <div class="pt-3" style="
                                                                                background: url('{{ asset('').$item->path }}');
                                                                                background-size: contain;
                                                                                background-position: center;
                                                                                background-repeat: no-repeat;
                                                                                height: 150px;
                                                                                margin-top: 20px;" data-bs-holder-rendered="true">

                                                                            </div>

                                                                            {{-- <img class="d-block  br-5" alt="" src="{{ asset('').$item->path }}" data-bs-holder-rendered="true"> --}}
                                                                            <div class="carousel-item-background d-none d-md-block"></div>
                                                                            <div class="carousel-caption d-none d-md-block">
                                                                                <h3>{{$item->titulo}}</h3>
                                                                                <p>{{$item->description}}</p>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                </div>

                                                                <a class="carousel-control-prev" href="#carousel-captions" role="button" data-bs-slide="prev">
                                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                                    <span class="sr-only">Previous</span>
                                                                </a>
                                                                <a class="carousel-control-next" href="#carousel-captions" role="button" data-bs-slide="next">
                                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                                    <span class="sr-only">Next</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        @foreach ($galeria as $key=>$item)
                                                            <div class="col-md-4">
                                                                <div class="border mb-5 p-4 br-5">
                                                                    <div class="pt-3" style="
                                                                        background: url('{{ asset('').$item->path }}');
                                                                        background-size: contain;
                                                                        background-position: center;
                                                                        background-repeat: no-repeat;
                                                                        height: 150px;
                                                                        margin-top: 20px;">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
<!-- GALLERY JS -->
<script src="{{ asset('template/plugins/gallery/picturefill.js') }}"></script>
<script src="{{ asset('template/plugins/gallery/lightgallery.js') }}"></script>
<script src="{{ asset('template/plugins/gallery/lightgallery-1.js') }}"></script>
<script src="{{ asset('template/plugins/gallery/lg-pager.js') }}"></script>
<script src="{{ asset('template/plugins/gallery/lg-autoplay.js') }}"></script>
<script src="{{ asset('template/plugins/gallery/lg-fullscreen.js') }}"></script>
<script src="{{ asset('template/plugins/gallery/lg-zoom.js') }}"></script>
<script src="{{ asset('template/plugins/gallery/lg-hash.js') }}"></script>
<script src="{{ asset('template/plugins/gallery/lg-share.js') }}"></script>


<script src="{{ asset('modulos/js/galerias/fotos/foto-model.js') }}"></script>
<script src="{{ asset('modulos/js/galerias/fotos/foto-view.js') }}"></script>
<script>
    const view = new FotoView(new FotoModel(token));
    // // view.listar(buscar);
    // view.listar();
    let imagenesJSON = [];
    view.eventos();
</script>
@endsection
