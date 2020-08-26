$(document).ready(function() {
    $('#requestFocus').focus();
    $('#codigoEan').focus();

    $('#codigoEan').on('keypress', solicitarProductosAJAX);

    $('[data-toggle="tooltip"]').tooltip()

    $("#search").keyup(function(){
        _this = this;
        // Show only matching TR, hide rest of them
        $.each($("table tbody tr"), function() {
            if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
                $(this).hide();
            else
                $(this).show();
        });
    });
});

function solicitarProductosAJAX(e) {
    if (e.keyCode === 13) {
        e.preventDefault();

        // Deshabilito el input de nro de serie
        $('#nroSerie').prop( "disabled", true );

        // Deshabilito el detalle del producto
        $('#detallesProducto').addClass('d-none');

        // Muestro el spinner
        mostrarSpinner(true);

        // Busco los datos por API
        fetch('/api/productos/ean/' + $('#codigoEan').val())
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
                    $('#codigoEan').focus();

                    // Escondo el spinner
                    mostrarSpinner(false);

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
        } else {
            mostrarSpinner(false);
            $('#nroSerie').prop( "disabled", true );
            $('#codigoEan').focus();
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

    mostrarSpinner(false);

    $('#detallesProducto').removeClass('d-none');
    $('#nroSerie').prop( "disabled", false );

    $('#nroSerie').focus();
    $('#nroSerie').select();

}


function mostrarSpinner(mostrar) {
    if(mostrar == true) {
        $('#spinner').removeClass('d-none');
        $('#spinner').addClass('d-flex');
    } else {
        $('#spinner').addClass('d-none');
        $('#spinner').removeClass('d-flex');
    }
}
