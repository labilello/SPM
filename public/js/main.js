$(document).ready(function() {
    // vista.reparaciones.nuevo
    $('#requestFocus').focus();
    $('#codigoEan').focus();

    $('#codigoEan').on('keypress', solicitarProductosAJAX);

    // filtro vistas.pendientes
    $('#buscarAPI').on('click', busquedaReparacionesAPI)

    // Sonidos
    var correcto = document.getElementById("correcto"); // Audio de control
    var error = document.getElementById("error"); // Audio de control

    if (location.href.indexOf("?correcto=true") != -1)
        reproducirAudio(correcto);
    else if (location.href.indexOf("?correcto=false") != -1)
        reproducirAudio(error);


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

                    reproducirAudio(error);
                }
            })
            .catch(function(error) {
                Swal.fire({
                    title: 'Error!',
                    text: 'Hubo un problema con la petición. Verifique la conexion y reintente',
                    timer: 5000,
                    timerProgressBar: true,
                    showConfirmButton: false
                });

                $('#codigoEan').val("");
                $('#codigoEan').focus();

                // Escondo el spinner
                mostrarSpinner(false);

                reproducirAudio(error);
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

    reproducirAudio(correcto);

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

// ============== BUSQUEDA PRODUCTOS API =================
function busquedaReparacionesAPI(e) {
    e.preventDefault();

    let key = $('#clave').val();
    let filtro = $('#buscarPor').val();
    let status = $('#status').val();
    let entidad = $('#entidad').val();

    fetch('/api/' + entidad + '/' + status + '/' + filtro + '/' + key)
        .then(function (response) {
            if(response.ok) // codigo 200
                response.json().then(json => { cargarTablaBusquedaAPI(json) } )
            else { // codigo 404
                Swal.fire({
                    title: 'Sin coincidencias!',
                    text: 'No se encontraron coincidencias para la clave ingresada',
                    timer: 2000,
                    timerProgressBar: true,
                    showConfirmButton: false
                });

                $('#clave').val("");
            }
        })
        .catch(function(error) {
            Swal.fire({
                title: 'Error!',
                text: 'Hubo un problema con la petición. Verifique la conexion y reintente',
                timer: 5000,
                timerProgressBar: true,
                showConfirmButton: false
            });

            $('#clave').val("");
        })
}

function cargarTablaBusquedaAPI(json) {

    $('#mytable tbody').empty();
    $('.pagination').empty();
    $('#totalTabla').text(json.length);

    json.forEach(reparacion => {
        $('#mytable tbody').append("" +
            "<tr>" +
            `<td>${reparacion.id}</td>` +
            `<td>${reparacion.product.descripcion}</td>` +
            `<td>${reparacion.date_in}</td>` +
            `<td>${reparacion.product.familia}</td>` +
            `<td>${reparacion.nro_serie}</td>` +
            `<td><a href='/reparaciones/reparar/${reparacion.id}'>Reparar</a></td>` +
            `</tr>`);
    });
}


function reproducirAudio(audio) {
    if (!audio.paused) {
        audio.pause();
        audio.currentTime = 0;
    }

    audio.play();
}


function egresarProducto(e, repair) {

}
