$(document).ready(function() {
    // Initialize
    // ---------------------------------------------------------------------

    // Tooltips
    // Requires Bootstrap 3 for functionality
    $('.js-tooltip').tooltip();

    // Copy to clipboard
    // Grab any text in the attribute 'data-copy' and pass it to the
    // copy function
    $('.js-copy').click(function() {
        var text = $(this).attr('data-copy');
        var el = $(this);
        copyToClipboard(text, el);
    });


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
    $('#id').val(producto.id);
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

function copyToClipboard(text, el) {
    var copyTest = document.queryCommandSupported('copy');
    var elOriginalText = el.attr('data-original-title');

    if (copyTest === true) {
        var copyTextArea = document.createElement("textarea");
        copyTextArea.value = text;
        document.body.appendChild(copyTextArea);
        copyTextArea.select();
        try {
            var successful = document.execCommand('copy');
            var msg = successful ? 'Copiado!' : 'Whoops, no copiado!';
            el.attr('data-original-title', msg).tooltip('show');
        } catch (err) {
            console.log('Oops, imposible copiar');
        }
        document.body.removeChild(copyTextArea);
        el.attr('data-original-title', elOriginalText);
    } else {
        // Fallback if browser doesn't support .execCommand('copy')
        window.prompt("Copie al portapapeles: Ctrl+C o Command+C, Enter", text);
    }
}

$(document).ready(function() {
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

    window.addEventListener('swal:modal', event => { Swal.fire( event.detail ); });
    window.addEventListener('sound:play', event => { soundPlay( event.detail ); });

});



function sinCoincidencias( show ) {
    Swal.fire({
        title: 'Sin coincidencias!',
        text: 'No se encontraron coincidencias para el codigo de barras ingresado',
        icon: 'error',
        showCloseButton: true,
        toast: true,
        position: 'top-right',
        timer: 3000,
        timerProgressBar: true,
        showConfirmButton: false
    });
    soundPlay('error');
}

function mostrarProducto( producto, refs) {
    refs.familia.value = producto.familia;
    refs.descripcion.value = producto.descripcion;
    refs.codunix.value = producto.id;
    refs.codunico.value = producto.codigo_unico;
    refs.marca.value = producto.marca;

    // refs.ean.value = producto.codigo_barras;
    refs.nroserie.focus();
    refs.nroserie.disabled = false;
    soundPlay('success');
    refs.show.style.display = 'block';
}

async function preguntarProducto( productos, refs ) {
    // Generamos el array de opciones formateado para el modal
    var opciones = new Array();
    productos.forEach(element => {
        opciones.push(`${element.descripcion} - ${element.codigo_unico}`);
    });

    // Mostramos el modal y esperamos la respuesta
    Swal.fire({
        title: 'Multiples coincidencias!',
        inputPlaceholder: 'Seleccione un elemento',
        input: 'select',
        inputOptions: opciones,
        allowOutsideClick: false,
        confirmButtonText: 'Seleccionar',
        showCancelButton: true,
        didClose : () => {
            setTimeout(() =>  refs.nroserie.focus(), 110);
        }
    }).then((result) => {
        console.log( result );
        if (result.isConfirmed && result.value !== "")
            mostrarProducto(productos[result.value], refs);
        else
            restablecerFormulario( refs );
    });
}

function informarIngresado( refs ) {
    restablecerFormulario ( refs );
    soundPlay('success');
}

function restablecerFormulario( refs ) {
    refs.familia.value = '';
    refs.descripcion.value = '';
    refs.codunix.value = '';
    refs.codunico.value = '';
    refs.marca.value = '';
    refs.nroserie.value = '';
    refs.nroserie.disabled = true;
    refs.ean.value = '';
    refs.ean.focus();
    refs.show.style.display = 'none';
}

function mostrarNotaReparacion( divNota ) {
    console.log(divNota);
    Swal.fire({
        title: 'Nota de reparacion',
        html: '<div class="text-left">' + divNota.innerText + '</div>',
        allowOutsideClick: true,
        showCloseButton: true,
        showConfirmButton: false,
        showCancelButton: true,
        cancelButtonText: 'Cerrar',
    });
}

function soundPlay( type ) {
    const audio = document.getElementById( type );
    if (!audio.paused) {
        audio.pause();
        audio.currentTime = 0;
    }
    audio.play();
}
