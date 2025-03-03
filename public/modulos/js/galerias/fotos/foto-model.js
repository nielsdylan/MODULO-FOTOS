class FotoModel {

    constructor(token) {
        this.token = token;
    }

    guardarFotos = (data) =>{
        return $.ajax({
            url: route('modulos.galerias.fotos.guardar-fotos'),
            type: 'POST',
            dataType: "JSON",
            processData: false,
            contentType: false,
            data: data
        });
    }
}
