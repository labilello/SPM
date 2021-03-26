$(document).ready(function() {
    // Sonidos
    var correcto = document.getElementById("correcto"); // Audio de control
    var error = document.getElementById("error"); // Audio de control

});


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
