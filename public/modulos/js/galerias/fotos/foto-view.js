class FotoView {

    constructor(model) {
        this.model = model;
        this.tabla = model;
    }


    eventos = () => {
        $('#formulario-fotos').on('click', 'div[data-action="cargar-imagen"]', (e) => {
            e.preventDefault();
            $('[data-seccion="file"]').trigger('click');
        });
        $('[data-seccion="file"]').change(function (e) {
            // curre
            readImage(this, $(e.currentTarget));
        });
        function readImage (input, current) {
            console.log(input.files[0]);

            let html = '';
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                let id = Math.random();
                reader.onload = function (e) {
                    html = `
                    <div class="col-md-2 text-center" data-id="`+id+`" data-section="remover">
                        <input class="form-control form-control-sm" type="text" value="" name="titulo[`+id+`]" placeholder="Titulo...">
                        <div class="file-image-1" data-id="`+id+`"
                            style="
                                background-image: url(`+e.target.result+`);
                                background-repeat: no-repeat;
                                background-size: contain;
                                background-position: center;
                            "
                            >
                            <a href="#">
                            </a>
                            <ul class="icons">
                                <li>
                                <a href="#" class="btn bg-danger eliminar" data-id="`+id+`" data-action="eliminar">
                                    <i class="fe fe-trash"></i>
                                </a>
                                </li>
                            </ul>

                        </div>
                        <input class="form-control form-control-sm" type="text" value="" name="descripcion[`+id+`]" placeholder="Descripcion...">
                    </div>
                    `;
                    $('#imagenes-productos').append(html);
                    // $('.imagen_logo_nuevo').attr('src', e.target.result); // Renderizamos la imagen
                }
                reader.readAsDataURL(input.files[0]);
                imagenesJSON.push({
                    id:id,
                    nameFile: input.files[0].name,
                    file: input.files[0]
                    // size: input.files[0].size
                })
                $('[data-seccion="file"]').val('');
            }
        }

        $('#imagenes-productos').on('click', 'a[data-action="eliminar"]', (e) => {
            e.preventDefault();
            let key = $(e.currentTarget).attr('data-id');
            let array = [];
            $('#imagenes-productos').find('.col-md-2[data-id="'+key+'"]').remove();

            imagenesJSON = imagenesJSON.filter(obj => obj.id != key);

        });


        $('#formulario-fotos').submit((e) => {
            e.preventDefault();
            let data = new FormData($(e.currentTarget)[0]);


            $.each(imagenesJSON, function (index, element) {
                data.append(`fotos[`+element.id+`]`, element.file);
            });
            let model = this.model;
            $(e.currentTarget).find('[type="submit"]').attr('disabled','true');
            $(e.currentTarget).find('[type="submit"]').find('i').removeClass('fa-save');
            $(e.currentTarget).find('[type="submit"]').find('i').addClass('fa-spinner fa-spin');
            model.guardarFotos(data).then((respuesta) => {
                if(respuesta.estado == true){
                    location.reload();
                }
                console.log(respuesta);


            }).fail(() => {

            }).always(() => {
            });


            // console.log(data);
            // console.log(imagenesJSON);

            // Swal.fire({
            //     title: "¿Está seguro de guardar?",
            //     text: "Se generara un registro!",
            //     icon: "warning",
            //     showCancelButton: true,
            //     confirmButtonText: "Si, Confirmar!",
            //     showLoaderOnConfirm: true,
            //     allowOutsideClick: true,
            //     backdrop: true,

            //     preConfirm: async (login) => {
            //         return model.guardarFotos(data).then((respuesta) => {
            //             return respuesta;

            //         }).fail(() => {

            //         }).always(() => {
            //         });
            //     },
            //     allowOutsideClick: () => !Swal.isLoading()
            // }).then((result) => {
            //     console.log(result);

            //     if (result.isConfirmed) {
            //         Swal.fire({
            //             title: result.value.title,
            //             text: result.value.message,
            //             icon: result.value.type,
            //         });
            //     }
            // });
        });
    }
}
