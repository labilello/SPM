$(document).ready(function() {
    $('.botones').children().on('click', funcionesBotones);

});


function funcionesBotones(e) {
    const id = $(e.target).attr('id');

    switch (id) {
        case "btn-1":
            break;
        case "btn-2":
            console.log("BOTON 2");
            break;
        case "btn-3":
            console.log("BOTON 3");
            break;

        default:
            break;
    }


}