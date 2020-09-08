$(document).ready(function() {
    // vista.reparaciones.nuevo
    // $('.requestFocus').focus();

    $('#nro_serie').on('keypress', solicitarProductosAJAX);

    // Sonidos
    var correcto = document.getElementById("correcto"); // Audio de control
    var error = document.getElementById("error"); // Audio de control

});


function solicitarProductosAJAX(e) {
    if (e.keyCode === 13) {
        e.preventDefault();

        // Deshabilito el input de nro de serie
        $('#nro_serie').prop( "disabled", true );
        let nro_serie = $('#nro_serie').val();
        let user_id = $('#user_id').val();

        // Muestro el spinner
        mostrarSpinner(true);

        const data = {
            nro_serie: nro_serie,
            user_id: user_id
        };

        // Busco los datos por API
        fetch(`/api${location.pathname}/add`, {
            method: 'POST',
            body: JSON.stringify(data),
            headers:{
                'Content-Type': 'application/json'
            }
        }).then(function (response) {
                if(response.ok) // codigo 200
                    response.json().then(json => { verficarCoinicidencias(json) } )
            })
            .catch(function(error) {
                Swal.fire({
                    title: 'Error!',
                    text: 'Hubo un problema con la petición. Verifique la conexion y reintente',
                    timer: 5000,
                    timerProgressBar: true,
                    showConfirmButton: false
                });

                mostrarSpinner(false);
                reproducirAudio(error);
                $('#nro_serie').prop( "disabled", false );
                $('#nro_serie').val("");
                $('#nro_serie').focus();

            })
    }
}

async function verficarCoinicidencias(body) {

    if(body.response == "error") {
        reproducirAudio(error);
        Swal.fire({
            icon: 'error',
            title: 'Sin coincidencias!',
            text: body.message,
            timer: 3000,
            timerProgressBar: true,
            showConfirmButton: true,
            onClose: () => {
                mostrarSpinner(false);
                $('#nro_serie').prop( "disabled", false );
                $('#nro_serie').val("");
                $('#nro_serie').focus();
            }
        });
        return;
    }

    if(body.response == "ok") {
        reproducirAudio(correcto);
        mostrarSpinner(false);
        insertarReparacion(body.repair);
        $('#nro_serie').prop( "disabled", false );
        $('#nro_serie').val("");
        $('#nro_serie').focus();

    }

}

function insertarReparacion(repair) {
    console.log()
    let cant_product = Number.parseInt($('#cant_products').text()) + 1;

    $('#cant_products').text(cant_product);
    $('#mytable tbody').prepend("" +
        "<tr>" +
            `<th scope='row'>${cant_product}</th>` +
            `<td>${repair.producto}</td>` +
            `<td>${repair.nro_serie}</td>` +
            `<td class='text-center'>${repair.is_repair ? '<i class="far fa-check-circle" style="color: #00cc66; font-size: 20px"></i>' : '<i class="far fa-times-circle" style="color: red; font-size: 20px"></i>'}</td>` +
        "</tr>");
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
