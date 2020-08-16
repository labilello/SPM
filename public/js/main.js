$(document).ready(function() {
    $('#codigoEan').focus();
    $('#codigoEan').on('keypress', solicitarProductosAJAX);
});

function solicitarProductosAJAX(e) {
    if (e.keyCode === 13) {
        e.preventDefault();

        $('#nroSerie').prop( "disabled", true );


        $('#spinner').removeClass('d-none');
        $('#spinner').addClass('d-flex');
        $('#detallesProducto').addClass('d-none');

        fetch('http://localhost:8000/api/productos/ean/' + $('#codigoEan').val())
            .then(function (response) {
                if(response.ok) // codigo 200
                    response.json().then(json => { verficarCoinicidencias(json) } )
                else { // codigo 404
                    Swal.fire({
                        title: 'Sin coincidencias!',
                        text: 'No se encontraron coincidencias para el codigo ingresado',
                        timer: 2000,
                        timerProgressBar: true,
                        showConfirmButton: false
                    });
                    $('#codigoEan').val("");
                    // reproducirAudio()
                }
            })
            .catch(function(error) {
                console.log('Hubo un problema con la petición Fetch:' + error.message);
            })
    }
}

async function verficarCoinicidencias(body) {

    if (body.length > 1) {
        // reproducirAudio()

        // Generamos el array de opciones formateado para el modal
        var opciones = new Array();
        body.forEach(element => {
            opciones.push(`${element.descripcion} - ${element.codigo_unico}`);
        });

        // Mostramos el modal y esperamos la respuesta
        const { value: opcion } = await Swal.fire({
            title: 'Multiples coincidencias!',
            inputPlaceholder: 'Seleccione un elemento',
            input: 'select',
            inputOptions: opciones,
            allowOutsideClick: false,
            showCancelButton: true,

        });

        if (opcion) { // Si eligio una opcion (no presiono cancelar), insertamos en tabla la opcion elegida
            insertarProducto(body[opcion]);
            setTimeout(() => {
                $('#nroSerie').prop( "disabled", false );
                $('#nroSerie').focus();
                $('#nroSerie').select();
            }, 500)
        } else {
            $('#spinner').addClass('d-none');
            $('#spinner').removeClass('d-flex');
            $('#nroSerie').prop( "disabled", true );
        }
        return;
    }
    insertarProducto(body[0]);
}

function insertarProducto(producto) {
    $('#familia').val(producto.familia);
    $('#descripcion').val(producto.descripcion);
    $('#codigoUnix').val(producto.codigo_unix);
    $('#codigoUnico').val(producto.codigo_unico);
    $('#marca').val(producto.marca);
    $('#costo').val('$' + producto.costo_reposicion);
    $('#iva').val(Math.round(producto.iva * 100) + '%');

    $('#spinner').addClass('d-none');
    $('#spinner').removeClass('d-flex');
    $('#detallesProducto').removeClass('d-none');
    $('#nroSerie').prop( "disabled", false );

    $('#nroSerie').focus();
    $('#nroSerie').select();



}
