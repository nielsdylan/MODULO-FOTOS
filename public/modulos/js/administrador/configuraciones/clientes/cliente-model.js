class ClienteModel {

    constructor(token) {
        this.token = token;
    }

    guardar = (data) =>{
        return $.ajax({
            url: route('administrador.configuraciones.clientes.guardar'),
            type: 'POST',
            dataType: "JSON",
            // processData: false,
            // contentType: false,
            data: data
        });
    }
    editar = (user_id) =>{
        return $.ajax({
            url: route('administrador.configuraciones.clientes.editar',{id:user_id}),
            type: 'GET',
            dataType: "JSON",
            // processData: false,
            // contentType: false,
            data: {_token: this.token}
        });
    }
    eliminar = (id) =>{
        return $.ajax({
            url: route('administrador.configuraciones.clientes.eliminar',{id:id}),
            type: 'PUT',
            dataType: "JSON",
            // processData: false,
            // contentType: false,
            data: { _token: this.token }
        });
    }
}
