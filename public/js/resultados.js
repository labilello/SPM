$(document).ready(function() {

    $.ajax({
        url: "./inc/funciones/stockResultado.php",
        type: "GET",
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
    }).done(function(res) {
        $("#tablaResultados").html(res);
        $('.tabla-resultados tbody tr').on('click', mostrarDetallesCodigo);
    });
})

// ======================= RESULTADO =========================
async function mostrarDetallesCodigo(e) {

    const idFila = $(e.target).parent().attr('id');
    const descripcion = $('#' + idFila + ' .descripcion').text();
    const familia = $('#' + idFila + ' .familia').text();
    const totalVirtual = $('#' + idFila + ' .totalVirtual').text();
    const totalFisico = $('#' + idFila + ' .totalFisico').text();
    const estadoAuditoria = $('#' + idFila + ' .estadoAuditoria').text();

    const estados = $('#' + idFila + ' .hidden');

    const html =
        "<section class='detalle-resultado'>" +
        "<div class='header'>" +
        "<p class='sin-margenes left-texto'><span>Codigos:</span></p>" +
        "<p class='sin-margenes left-texto'><span>Familia:</span>" + familia + "</p>" +
        "</div>" +
        "<table class='stock wdt-100'>" +
        "<thead>" +
        "<tr>" +
        "<th>Estado</th>" +
        "<th>Virtuales</th>" +
        "<th>Fisicos</th>" +
        "</tr>" +
        "</thead>" +
        "<tbody>" +
        "</tbody>" +
        "</table>" +
        "</section>";

    $('#preModal').html(html);

    $(estados).each(function(index) {
        $('.detalle-resultado .stock tbody').append("<tr>" +
            "<th class='left-texto'>" + estados[index].children[0].innerText + "</th>" +
            "<th class='centrar-texto'><input type='number' name='' class='virtuales1' min='0' value='" + estados[index].children[1].innerText + "'></th>" +
            "<th class='centrar-texto'><input type='number' name='' class='fisicos1' min='0' value='" + estados[index].children[2].innerText + "'></th>" +
            "</tr>"
        )
    });

    //const { value: formValues } = await 
    Swal.fire({
        title: descripcion,
        html: $('#preModal').html(),

        // '<input id="swal-input1" class="swal2-input">' +
        //     '<input id="swal-input2" class="swal2-input">',
        focusConfirm: false,
        // preConfirm: () => {
        //     return [
        //         document.getElementById('swal-input1').value,
        //         document.getElementById('swal-input2').value
        //     ]
        // }
    })

    // if (formValues) {
    //     Swal.fire(JSON.stringify(formValues))
    // }
}

function prueba(e) {
    console.log(e.target.value);
    $('.tabla-resultados tbody tr').hide();
    $('.tabla-resultados tbody tr.' + e.target.value).show();
}

function prueba2(e) {
    console.log(e.target.value);

    $('.tabla-resultados tbody tr').hide();
    $('.tabla-resultados tbody tr td.' + e.target.value).parent().show();
}

function prueba3(e) {
    $('#filtroEstado').val("");
    $('#filtroFamilia').val("");
    $('.tabla-resultados tbody tr').show();

}