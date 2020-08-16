$(document).ready(function() {
    $('#stockVirtual').on('submit', enviarArchivoAJAX);
    $('#stockBase').on('submit', enviarArchivoAJAX);
    var audio = document.getElementById("audio"); // Audio de control

    loadDataStorage(); // Cargamos la tabla con la informacion de localStorage

})

function solicitarProductosAJAX(e) {
    if (e.keyCode === 13) {
        e.preventDefault();

        // if ($('#codigoBarras').val().length < 6) {
        //     Swal.fire({
        //         icon: 'error',
        //         title: 'Codigo de barras invalido!',
        //         text: 'El codigo de barras debe superar los 6 caracteres',
        //         timer: 2000,
        //         timerProgressBar: true,
        //         showConfirmButton: false
        //     });
        //     reproducirAudio();
        //     $('#codigoBarras').val("");
        //     $('#codigoBarras').focus();
        //     return
        // }


        const datos = {
            codigo: $('#codigoBarras').val(),
            tipoCodigo: 'EAN'
        };

        console.log("ENVIANDO INFORMACION!");
        $.ajax({
            url: "http://localhost/MisProyectos/GAC---WEB/inc/funciones/stock.php",
            data: datos,
            type: 'GET',
            dataType: 'json',
            success: function(json) {
                console.log(json);
                if (json.resultado == "error")
                    console.log("Error al obtener el resultado: " + json.body.descripcion);
                else
                    verficarCoinicidencias(json.body);

            },
            error: function(xhr, status) {
                if (xhr.status == 0) {
                    alert('You are offline!!\n Please Check Your Network.');
                } else if (xhr.status == 404) {
                    alert('Requested URL not found.');
                } else if (xhr.status == 500) {
                    alert('Internel Server Error.');
                } else if (status == 'parsererror') {
                    alert('Error.\nParsing JSON Request failed.');
                } else if (status == 'timeout') {
                    alert('Request Time out.');
                } else {
                    alert('Unknow Error.\n' + xhr.responseText);
                }
                console.log("ERROR: " + xhr + " - " + status);
            }

        })

        $('#codigoBarras').val("");
        $('#codigoBarras').focus();
    }
}

async function verficarCoinicidencias(body) {
    if (body.productos.length == 0) {
        Swal.fire({
            title: 'Sin coincidencias!',
            text: 'No se encontraron coincidencias para el codigo ingresado',
            timer: 2000,
            timerProgressBar: true,
            showConfirmButton: false
        });
        reproducirAudio();
        return;
    }

    if (body.productos.length > 1) {
        reproducirAudio();
        // Generamos el array de opciones formateado para el modal
        var opciones = new Array();
        body.productos.forEach(element => {
            opciones.push(`${element.descripcion} - ${element.codigoUnico}`);
        });

        // Mostramos el modal y esperamos la respuesta
        const { value: opcion } = await Swal.fire({
            title: 'Multiples coincidencias!',
            inputPlaceholder: 'Seleccione un elemento',
            input: 'select',
            inputOptions: opciones,
            allowOutsideClick: false,
            showCancelButton: true
        });

        if (opcion) { // Si eligio una opcion (no presiono cancelar), insertamos en tabla la opcion elegida
            insertarProducto(body.productos[opcion]);
        }
        return;
    }
    insertarProducto(body.productos[0]);

}

function insertarProducto(producto) {
    const codigo = producto.ean;
    const estadoTexto = $('#estado').val();
    estadoNumero = estadoTexto.split('-')[0];
    let cantidad = 1;

    if ($(`.${codigo}.${estadoNumero}`).length > 0) {
        cantidad = parseInt($(`.${codigo}.${estadoNumero} td:last-of-type`).text()) + 1;
        $(`.${codigo}.${estadoNumero}`).remove();
    }

    const parametros = [producto, estadoTexto, cantidad];

    agregarProductoEnTabla(`${codigo} ${estadoNumero}`, parametros);
    addLocalStorage(`GAC-${codigo} ${estadoNumero}`, parametros);
}

function agregarProductoEnTabla(clase, arrayValores) {

    $('.tabla-ingresos table tbody').append(
        `<tr class="${clase}">
            <td>${arrayValores[0].descripcion}</td>
            <td>${arrayValores[0].ean}</td>
            <td>${arrayValores[0].familia}</td>
            <td>${arrayValores[1]}</td>
            <td>${arrayValores[2]}</td>
        </tr>`
    );

}

function addLocalStorage(clave, arrayValores) {
    localStorage.setItem(clave, JSON.stringify(arrayValores));
}

function getLocalStorage(clave) {
    return JSON.parse(localStorage.getItem(clave));
}

function getAllLocalStorage() {
    let productos = new Array()
    let clave, elemento;


    for (let i = 0; i < localStorage.length; i++) {
        clave = localStorage.key(i);
        claveSplit = clave.split('-');

        console.log("Revisando clave:" + clave + " - " + claveSplit);
        if (claveSplit[0] !== "GAC")
            continue;

        elemento = (getLocalStorage(clave));
        console.log("Elemento obtenido:" + elemento);

        productos.push({
            codigo: elemento[0].codigoUnico,
            descripcion: elemento[0].descripcion,
            familia: elemento[0].familia,
            marca: elemento[0].marca,
            ean: elemento[0].ean,
            estado: elemento[1],
            cantidad: elemento[2],
            sucursal: 53,
        })

        console.log("Elemento pusheado: " + elemento[0].ean + "||" + elemento[1] + "||" + elemento[2]);
        //removeLocalStorage(clave);
    }


    return productos;
}

function removeLocalStorage(clave) {
    localStorage.removeItem(clave);
}


function verificarCsv(e, tipoStock) {
    console.log($('input'));
    const curFiles = $('#' + tipoStock)[0].files;

    if (curFiles.length > 0) {
        console.log(`Se cargo el archivo: ${curFiles[0].name} - ${returnFileSize(curFiles[0].size)}`);
    }
}

function enviarArchivoAJAX(e) {
    // Capturo el evento por defecto del navegador
    e.preventDefault();
    const idElemento = $(e.target).attr('id');

    //Obtengo el FormData del formulario. Lo hago con JS vanilla para evitar los append
    var formData = new FormData(document.getElementById(idElemento));
    formData.append("tipo", idElemento);

    console.log("ENVIANDO INFORMACION!");
    $.ajax({
        url: "http://localhost/MisProyectos/GAC---WEB/inc/funciones/upStock.php",
        type: "POST",
        dataType: "html",
        data: formData,
        cache: false,
        contentType: false,
        processData: false
    }).done(function(res) {
        $("#mensaje").html("Respuesta: " + res);
    });

}

function returnFileSize(number) {
    if (number < 1024) {
        return number + 'bytes';
    } else if (number >= 1024 && number < 1048576) {
        return (number / 1024).toFixed(1) + 'KB';
    } else if (number >= 1048576) {
        return (number / 1048576).toFixed(1) + 'MB';
    }
}

function reproducirAudio() {
    if (!audio.paused) {
        audio.pause();
        audio.currentTime = 0;
    }

    audio.play();
}

function loadDataStorage() {
    let element;
    for (let i = 0; i < localStorage.length; i++) {
        elemento = localStorage.key(i);
        splitElemento = elemento.split('-');

        if (splitElemento[0] == "GAC") {
            console.log(localStorage.getItem(elemento));
            agregarProductoEnTabla(splitElemento[1], JSON.parse(localStorage.getItem(elemento)));
        }
    }

}

function storageAvailable(type) {
    var storage;
    try {
        storage = window[type];
        var x = '__storage_test__';
        storage.setItem(x, x);
        storage.removeItem(x);
        return true;
    } catch (e) {
        return e instanceof DOMException && (
                // everything except Firefox
                e.code === 22 ||
                // Firefox
                e.code === 1014 ||
                // test name field too, because code might not be present
                // everything except Firefox
                e.name === 'QuotaExceededError' ||
                // Firefox
                e.name === 'NS_ERROR_DOM_QUOTA_REACHED') &&
            // acknowledge QuotaExceededError only if there's something already stored
            (storage && storage.length !== 0);
    }
}

function prueba(e) {
    const productosAuditados = getAllLocalStorage();
    // console.log(getAllLocalStorage());

    if (productosAuditados.length < 1) {
        Swal.fire({
            icon: 'error',
            title: 'Lista vacia!',
            text: 'La lista debe contener elementos para guardarla',
            timer: 2500,
            timerProgressBar: true,
            showConfirmButton: false
        });
        return;
    }
    const datos = {
        tipo: "stockAuditoria",
        productos: productosAuditados
    };

    console.log("ENVIANDO INFORMACION!");
    $.ajax({
        url: "http://localhost/MisProyectos/GAC---WEB/inc/funciones/upStock.php",
        data: datos,
        type: 'POST',
        // dataType: 'json',
        // success: function(json) {
        //     // console.log(json);
        //     if (json.resultado == "error")
        //         console.log("Error al obtener el resultado: " + json.body.descripcion);
        //     else
        //         console.log("RECIBIDO!");

        // },
        error: function(xhr, status) {
            if (xhr.status == 0) {
                alert('You are offline!!\n Please Check Your Network.');
            } else if (xhr.status == 404) {
                alert('Requested URL not found.');
            } else if (xhr.status == 500) {
                alert('Internel Server Error.');
            } else if (status == 'parsererror') {
                alert('Error.\nParsing JSON Request failed.');
            } else if (status == 'timeout') {
                alert('Request Time out.');
            } else {
                alert('Unknow Error.\n' + xhr.responseText);
            }
            console.log("ERROR: " + xhr + " - " + status);
        }
    }).done(function(res) {
        $("#mensaje").html("Respuesta: " + res);
    });

}
