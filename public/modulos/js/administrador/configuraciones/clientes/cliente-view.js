class ClienteView {

    constructor(model) {
        this.model = model;
        this.tabla = model;
    }

    listar = () => {

        const $tabla = $('#tabla-data').DataTable({
            destroy: true,
            dom: 'Bftip',
            autoWidth: false,
            responsive: true,
            pageLength: 50,
            language: {
                url: "https://cdn.datatables.net/plug-ins/2.2.2/i18n/es-ES.json"
            },
            serverSide: true,
            processing: true,
            buttons: [
                {
                    text: '<i class="fa fa-plus"></i> Nuevo',
                    attr: {
                        id: 'btn-cliente',
                    },
                    action: () => {
                        // vistaCrear();
                        $('#modal-cliente').modal('show');
                        $("#form-cliente")[0].reset();
                        $('#modal-cliente').find('.modal-header').find('h6.modal-title').text('Nuevo Cliente');
                        // $(selector).attr(attributeName);
                        $('#form-cliente').find('[name="password"]').attr('required', 'true');
                        $('#form-cliente').find('[name="rep_password"]').attr('required', 'true');
                    },
                    init: function(api, node, config) {

                        $(node).removeClass('btn-secondary')
                    },
                    className: 'btn-light btn-sm'
                }
            ],
            // pagingType: 'full_numbers',
            // scrollCollapse: true,
            // scrollY: '60vh',
            // scrollX: '100vh',
            initComplete: function (settings, json) {
                const $filter = $('#tabla-data_filter');
                const $input = $filter.find('input');
                $filter.append('<button id="btnBuscar" class="btn btn-default btn-sm" type="button" style="border-bottom-left-radius: 0px;border-top-left-radius: 0px;"><i class="fa fa-search"></i></button>');
                $input.addClass('form-control-sm');
                $input.attr('style','border-bottom-right-radius: 0px;border-top-right-radius: 0px;padding-top: 3px;');

                $('#tabla-data_wrapper .dt-buttons.btn-group.flex-wrap').addClass('btn-foto-posicion');
                $input.off();
                $input.on('keyup', (e) => {
                    if (e.key == 'Enter') {
                        $('#btnBuscar').trigger('click');
                    }
                });
                $('#btnBuscar').on('click', (e) => {
                    $tabla.search($input.val()).draw();
                });
                // $('#tabla-data_length label').addClass('select2-sm');
                // //______Select2
                // $('[name="tabla-data_length"]').select2({
                //     minimumResultsForSearch: Infinity
                // });
                // const $paginate = $('#tabla-data_paginate');
                // $paginate.find('ul.pagination').addClass('pagination-sm');

            },
            drawCallback: function (settings) {
                $('#tabla-data_filter input').prop('disabled', false);
                $('#btnBuscar').html('<i class="fa fa-search"></i>').prop('disabled', false);
                $('#tabla-data_filter input').trigger('focus');
                const $paginate = $('#tabla-data_paginate');
                $paginate.find('ul.pagination').addClass('pagination-sm');

            },
            order: [[0, 'desc']],
            ajax: {
                url: route('administrador.configuraciones.clientes.listar'),
                method: 'POST',
                // headers: {'X-CSRF-TOKEN': token},
                dataType: "JSON",
                // data: buscar,
                data: {_token : token},
            },
            columns: [
                {data: 'id', className: 'text-center'},
                {data: 'nombres', className: 'text-center'},
                {data: 'apellidos', className: 'text-center'},
                {data: 'email', className: 'text-center'},
                // {data: 'telefono', className: 'text-center'},
                {data: 'habilitado', className: 'text-center'},
                {data: 'accion', className: 'text-center'},
            ]
        });
        $tabla.on('search.dt', function() {
            $('#tabla-data_filter input').attr('disabled', true);
            $('#btnBuscar').html('<i class="fa fa-clock-o" aria-hidden="true"></i>').prop('disabled', true);
        });
        $tabla.on('init.dt', function(e, settings, processing) {
            // $('#tabla-data_length label').addClass('select2-sm');
            // $(e.currentTarget).LoadingOverlay('show', { imageAutoResize: true, progress: true, imageColor: '#3c8dbc' });
        });
        $tabla.on('processing.dt', function(e, settings, processing) {
            if (processing) {
                // $(e.currentTarget).LoadingOverlay('show', { imageAutoResize: true, progress: true, imageColor: '#3c8dbc' });
            } else {
                // $(e.currentTarget).LoadingOverlay("hide", true);
            }
        });
        this.tabla = $tabla;
        // $tabla.buttons().container().appendTo('#tabla-data_wrapper .col-md-6:eq(0)');
    }

    eventos = () => {
        $('#form-cliente').submit((e) => {
            e.preventDefault();
            let data = $(e.currentTarget).serialize();
            let password = $('[name="password"]').val();
            let re_password = $('[name="rep_password"]').val();
            let button = $(e.currentTarget).find('button[type="submit"]')
            let tabla = this.tabla;
            button.attr('disabled','true');
            button.find('i').removeClass('fa-save')
            button.find('i').addClass('fa-spinner fa-spin');
            if(password == re_password){
                this.model.guardar(data).then((respuesta) => {

                    if (respuesta.status == true) {
                        console.log(respuesta);
                        tabla.ajax.reload(null, false);
                    }
                    button.removeAttr('disabled')
                    button.find('i').removeClass('fa-spinner fa-spin')
                    button.find('i').addClass('fa-save');
                    $('#modal-cliente').modal('hide');
                }).always(() => {
                }).fail(() => {
                    tabla.ajax.reload(null, false);
                    $('#modal-cliente').modal('hide');
                    button.removeAttr('disabled')
                    button.find('i').removeClass('fa-spinner fa-spin')
                    button.find('i').addClass('fa-save');
                });

            }else{
                console.log('fals');
            }
        });
        $('#tabla-data').on('click', 'a.editar',(e) => {
            e.preventDefault();
            let user_id = $(e.currentTarget).attr('data-id');
            this.model.editar(user_id).then((respuesta) => {
                if(respuesta.status=="success"){

                    $('#modal-cliente').modal('show');
                    $("#form-cliente")[0].reset();
                    $("#form-cliente").find('h5.modal-title').text('Esitar Cliente');


                    $('#form-cliente').find('[name="numero_documento"]').val(respuesta.cliente.numero_documento)
                    $('#form-cliente').find('[name="apellidos"]').val(respuesta.cliente.apellidos)
                    $('#form-cliente').find('[name="nombres"]').val(respuesta.cliente.nombres)
                    $('#form-cliente').find('[name="email"]').val(respuesta.cliente.email)

                    $('#form-cliente').find('[name="password"]').removeAttr('required');
                    $('#form-cliente').find('[name="rep_password"]').removeAttr('required');
                }

            }).always(() => {

            }).fail(() => {

            });
        });
        $('#tabla-data').on('click', 'a.eliminar',(e) => {
            e.preventDefault();
            $('#alert-eliminar').modal('show');
            let id = $(e.currentTarget).attr('data-id');
            console.log(id);
            $('#alert-eliminar').find('button[data-action="enviar"]').attr('data-id',id);
        });
        $('button[data-action="enviar"]').click((e) => {
            e.preventDefault();
            let usuario_id = $(e.currentTarget).attr('data-id');
            let tabla = this.tabla;
            $(e.currentTarget).html('<i class="fa fa-spinner fa-spin"></i> Cargando...');
            this.model.eliminar(usuario_id).then((respuesta) => {
                $('#alert-eliminar').modal('hide');
                console.log(respuesta);
                tabla.ajax.reload(null, false);
                $(e.currentTarget).find('i').remove();
                $(e.currentTarget).text('Aceptar');
            }).always(() => {
            }).fail(() => {
                tabla.ajax.reload(null, false);
                $('#modal-cliente').modal('hide');
                button.removeAttr('disabled')
                button.find('i').removeClass('fa-spinner fa-spin')
                button.find('i').addClass('fa-save');
            });
        });
    }
}
