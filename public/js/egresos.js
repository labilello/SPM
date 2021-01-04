$(document).ready(function() {

    $('#nro_serie').on('keypress', solicitarProductosAJAXEgresos);

    // Sonidos
    var correcto = document.getElementById("correcto"); // Audio de control
    var error = document.getElementById("error"); // Audio de control

});


function solicitarProductosAJAXEgresos(e) {
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
                    response.json().then(json => { verficarCoinicidenciasEgresos(json) } )
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

async function verficarCoinicidenciasEgresos(body) {

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


// LISTA DE ARMATUPC
function insertarParte(event) {
    let tipoParte = document.querySelector('#tipoParte');
    let nroSerie = document.querySelector('#nroSerie');
    const formError = document.querySelector('#form-error');

    if (event.keyCode !== 13)
        return;

    if( tipoParte.value === "" || nroSerie.value === "" ) {
        formError.classList.remove('d-none');
        return;
    }

    event.preventDefault();

    const listaPartes = document.querySelector('#listaPartes');

    listaPartes.innerHTML += '<div class="col-12 col-lg-6 row justify-content-between align-items-center mb-2 list-element">\n' +
        `<input type="text" name="data[${listaPartes.children.length}][part]" value="${tipoParte.value}" class="col-4 col-lg-5 text-truncate border-0 bg-transparent" readonly tabindex="-1">\n` +
        `<input type="text" maxlength="15" name="data[${listaPartes.children.length}][serie]" value="${nroSerie.value}" class="col border-top-0 border-left-0 border-right-0 border-success border-2 pl-2 serie" required>\n` +
        '<button type="button" class="btn-sm btn-danger col-1 ml-4" onclick="eliminarParent(event)">&cross;</button>\n' +
        '</div>';

    tipoParte.value = "";
    nroSerie.value = "";
    formError.classList.add('d-none');
}

function eliminarParent(event) {
    event.preventDefault();
    event.target.parentElement.remove();

    document.querySelectorAll('.list-element').forEach(reAsignarId);
}

function reAsignarId(element, index, array) {
    var inputs = element.children;
    inputs[0].name = `data[${index}][part]`;
    inputs[1].name = `data[${index}][serie]`;
}

function enviarFormularioMakePC(e, update) {
    if(update) {
        document.querySelector('#_method').value = "PUT";
        e.form.action = window.location.href;
    }
    else
        document.querySelector('#_method').value = "POST";

    var error = "";

    if( document.querySelector('#NV').value.length == 0 )
        error += '- El numero de venta debe estar completo\n';

    if( document.querySelectorAll('.list-element').length == 0 )
        error += '- Debe haber al menos una parte registrada\n';
    else {
        document.querySelectorAll('.list-element .serie').forEach( element => {
            if( element.value.length == 0 ) {
                error += '- Todas las partes deben tener un numero de serie\n';
                return;
            }
        });
    }

    if( error.length < 1 )
        e.form.submit();
    else {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: 'error',
            title: error
        })
    }
}
