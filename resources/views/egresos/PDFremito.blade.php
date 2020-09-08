<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Document</title>

    <style>
        @page {
            margin: 100px 25px;
        }

        body {
            margin-top: 145px;
            font: -webkit-small-control;
        }

        header {
            position: fixed;
            top: -80px;
            left: 0px;
            right: 0px;


            /** Extra personal styles **/
            background-color: white;
            color: black;
        }

        /** Define the footer rules **/
        footer {
            position: fixed;
            bottom: -90px;
            left: 0px;
            right: 0px;
            height: 80px;

            /** Extra personal styles **/
            background-color: white;
            color: black;
            text-align: center;
            border-top: 2px solid black;
            border-bottom: 2px solid black;
            padding-top: 10px;
        }

        .centrar-texto {
            text-align: center;
        }

        .negrita {
            font-weight: bold;
        }

        .remito-nro {
            font-size: 25px;
        }

        .detalle-compania {
            font-size: 12px;
        }

        .tipo-documento {
            padding: 25px 10px;
            border: 3px solid black;
            font-size: 30px;
            font-weight: bold;
        }

        table th, table td, table td * {
            vertical-align: top;
        }
        table tbody tr td p {
            margin: 0;
        }

        table {
            width: 100%;
        }

        .tabla-productos {
            font-size: 12px;
        }


    </style>
</head>
<body>
    <header class="centrar-texto">
        <table style="margin-bottom: 10px">
            <tbody>
                <tr style="vertical-align: text-top;">
                    <td style="width: 35%">
                        <img src="src/img/logo.png" alt="" style="margin-bottom: 10px;">
                        <p>Compuservice</p>
                        <p>Av. Rivadavia 6732</p>
                        <p>Capital Federal - C.P. 1406</p>
                    </td>
                    <td>
                        <div class="centrar-texto">
                            <span class="tipo-documento">R</span>
                        </div>
                    </td>
                    <td  style="width: 35%; text-align: center">
                        <p class="negrita remito-nro" style="margin-bottom: 10px;">REMITO<br>N. 0001-000001</p>
                        <p class="detalle-compania">C.U.I.T.: <span class="negrita ">30-68211572-2</span></p>
                        <p class="detalle-compania">I.B.C.M.: <span class="negrita">901-176912-8</span></p>
                        <p class="detalle-compania">INICIO DE ACTIVIDADES: <span class="negrita">04/09/2012</span></p>
                    </td>
                </tr>
            </tbody>
        </table>

        <table style="padding-bottom: 10px; padding-top: 10px; border-top: 2px solid black; border-bottom: 2px solid black;">
            <tbody>
                <tr>
                    <td style="width: 70%">
                        <p>Destinatario: <span class="negrita ">Copple</span></p>
                        {{--                <p class="detalle-compania">Domicilio: <span class="negrita">901-176912-8</span></p>--}}
                        {{--                <p class="detalle-compania">Localidad: <span class="negrita">04/09/2012</span></p>--}}
                        {{--                <p class="detalle-compania">Provincia: <span class="negrita">04/09/2012</span></p>--}}
                        {{--                <p class="detalle-compania">Localidad: <span class="negrita">04/09/2012</span></p>--}}
                    </td>
                    <td style="width: 30%">
                        <p>Fecha: <span class="negrita">04/09/2012</span></p>
                        <p>Remito interno: <span class="negrita">04/09/2012</span></p>
                    </td>
                </tr>
            </tbody>
        </table>


        <table style="border-bottom: 2px solid black">
            <thead>
                <tr>
                    <th style="width: 20%;">ARTICULO</th>
                    <th style="width: 50%;text-align: left">DESCRIPCION</th>
                    <th style="width: 30%;text-align: left">NRO. SERIE</th>
                </tr>
            </thead>
        </table>
    </header>

    <footer>
        <table cellspacing="5px">
            <tbody>
                <tr>
                    <td>
                        <p style="margin: 0;" class="detalle-compania">FIRMA:</p>
                        <p style="margin: 0;" class="detalle-compania">ACLARACION:</p>
                        <hr>
                        <p style="margin: 0;" class="detalle-compania centrar-texto">DESPOSITO DESPACHO</p>
                    </td>
                    <td>
                        <p style="margin: 0;" class="detalle-compania">FIRMA:</p>
                        <p style="margin: 0;" class="detalle-compania">ACLARACION:</p>
                        <hr>
                        <p style="margin: 0;" class="detalle-compania centrar-texto">TRASPORTE MERCADERIA</p>
                    </td>
                    <td>
                        <p style="margin: 0;" class="detalle-compania">FIRMA:</p>
                        <p style="margin: 0;" class="detalle-compania">ACLARACION:</p>
                        <hr>
                        <p style="margin: 0;" class="detalle-compania centrar-texto">DESPOSITO DESPACHO</p>
                    </td>
                </tr>
            </tbody>

        </table>
    </footer>

    <main class="centrar-texto">
        <table class="tabla-productos">
            <tbody>
                <tr>
                    <td class="centrar-texto" style="width: 20%;">234473</td>
                    <td style="width: 50%;">NINTENDO SWITCH GREY</td>
                    <td style="width: 30%;">XQW70026943155</td>
                </tr>
                <tr>
                    <td class="centrar-texto" style="width: 20%;">234473</td>
                    <td style="width: 50%;">NINTENDO SWITCH GREY</td>
                    <td style="width: 30%;">XQW70026943155</td>
                </tr>
                <tr>
                    <td class="centrar-texto" style="width: 20%;">234473</td>
                    <td style="width: 50%;">NINTENDO SWITCH GREY</td>
                    <td style="width: 30%;">XQW70026943155</td>
                </tr>
                <tr>
                    <td class="centrar-texto" style="width: 20%;">234473</td>
                    <td style="width: 50%;">NINTENDO SWITCH GREY</td>
                    <td style="width: 30%;">XQW70026943155</td>
                </tr>
                <tr>
                    <td class="centrar-texto" style="width: 20%;">234473</td>
                    <td style="width: 50%;">NINTENDO SWITCH GREY</td>
                    <td style="width: 30%;">XQW70026943155</td>
                </tr>
                <tr>
                    <td class="centrar-texto" style="width: 20%;">234473</td>
                    <td style="width: 50%;">NINTENDO SWITCH GREY</td>
                    <td style="width: 30%;">XQW70026943155</td>
                </tr>
                <tr>
                    <td class="centrar-texto" style="width: 20%;">234473</td>
                    <td style="width: 50%;">NINTENDO SWITCH GREY</td>
                    <td style="width: 30%;">XQW70026943155</td>
                </tr>
                <tr>
                    <td class="centrar-texto" style="width: 20%;">234473</td>
                    <td style="width: 50%;">NINTENDO SWITCH GREY</td>
                    <td style="width: 30%;">XQW70026943155</td>
                </tr>
                <tr>
                    <td class="centrar-texto" style="width: 20%;">234473</td>
                    <td style="width: 50%;">NINTENDO SWITCH GREY</td>
                    <td style="width: 30%;">XQW70026943155</td>
                </tr>
                <tr>
                    <td class="centrar-texto" style="width: 20%;">234473</td>
                    <td style="width: 50%;">NINTENDO SWITCH GREY</td>
                    <td style="width: 30%;">XQW70026943155</td>
                </tr>
                <tr>
                    <td class="centrar-texto" style="width: 20%;">234473</td>
                    <td style="width: 50%;">NINTENDO SWITCH GREY</td>
                    <td style="width: 30%;">XQW70026943155</td>
                </tr>
                <tr>
                    <td class="centrar-texto" style="width: 20%;">234473</td>
                    <td style="width: 50%;">NINTENDO SWITCH GREY</td>
                    <td style="width: 30%;">XQW70026943155</td>
                </tr>
                <tr>
                    <td class="centrar-texto" style="width: 20%;">234473</td>
                    <td style="width: 50%;">NINTENDO SWITCH GREY</td>
                    <td style="width: 30%;">XQW70026943155</td>
                </tr>
                <tr>
                    <td class="centrar-texto" style="width: 20%;">234473</td>
                    <td style="width: 50%;">NINTENDO SWITCH GREY</td>
                    <td style="width: 30%;">XQW70026943155</td>
                </tr>
                <tr>
                    <td class="centrar-texto" style="width: 20%;">234473</td>
                    <td style="width: 50%;">NINTENDO SWITCH GREY</td>
                    <td style="width: 30%;">XQW70026943155</td>
                </tr>
                <tr>
                    <td class="centrar-texto" style="width: 20%;">234473</td>
                    <td style="width: 50%;">NINTENDO SWITCH GREY</td>
                    <td style="width: 30%;">XQW70026943155</td>
                </tr>
                <tr>
                    <td class="centrar-texto" style="width: 20%;">234473</td>
                    <td style="width: 50%;">NINTENDO SWITCH GREY</td>
                    <td style="width: 30%;">XQW70026943155</td>
                </tr>
                <tr>
                    <td class="centrar-texto" style="width: 20%;">234473</td>
                    <td style="width: 50%;">NINTENDO SWITCH GREY</td>
                    <td style="width: 30%;">XQW70026943155</td>
                </tr>
                <tr>
                    <td class="centrar-texto" style="width: 20%;">234473</td>
                    <td style="width: 50%;">NINTENDO SWITCH GREY</td>
                    <td style="width: 30%;">XQW70026943155</td>
                </tr>
                <tr>
                    <td class="centrar-texto" style="width: 20%;">234473</td>
                    <td style="width: 50%;">NINTENDO SWITCH GREY</td>
                    <td style="width: 30%;">XQW70026943155</td>
                </tr>
                <tr>
                    <td class="centrar-texto" style="width: 20%;">234473</td>
                    <td style="width: 50%;">NINTENDO SWITCH GREY</td>
                    <td style="width: 30%;">XQW70026943155</td>
                </tr>
                <tr>
                    <td class="centrar-texto" style="width: 20%;">234473</td>
                    <td style="width: 50%;">NINTENDO SWITCH GREY</td>
                    <td style="width: 30%;">XQW70026943155</td>
                </tr>
                <tr>
                    <td class="centrar-texto" style="width: 20%;">234473</td>
                    <td style="width: 50%;">NINTENDO SWITCH GREY</td>
                    <td style="width: 30%;">XQW70026943155</td>
                </tr>
                <tr>
                    <td class="centrar-texto" style="width: 20%;">234473</td>
                    <td style="width: 50%;">NINTENDO SWITCH GREY</td>
                    <td style="width: 30%;">XQW70026943155</td>
                </tr>
                <tr>
                    <td class="centrar-texto" style="width: 20%;">234473</td>
                    <td style="width: 50%;">NINTENDO SWITCH GREY</td>
                    <td style="width: 30%;">XQW70026943155</td>
                </tr>
                <tr>
                    <td class="centrar-texto" style="width: 20%;">234473</td>
                    <td style="width: 50%;">NINTENDO SWITCH GREY</td>
                    <td style="width: 30%;">XQW70026943155</td>
                </tr>
                <tr>
                    <td class="centrar-texto" style="width: 20%;">234473</td>
                    <td style="width: 50%;">NINTENDO SWITCH GREY</td>
                    <td style="width: 30%;">XQW70026943155</td>
                </tr>
                <tr>
                    <td class="centrar-texto" style="width: 20%;">234473</td>
                    <td style="width: 50%;">NINTENDO SWITCH GREY</td>
                    <td style="width: 30%;">XQW70026943155</td>
                </tr>
                <tr>
                    <td class="centrar-texto" style="width: 20%;">234473</td>
                    <td style="width: 50%;">NINTENDO SWITCH GREY</td>
                    <td style="width: 30%;">XQW70026943155</td>
                </tr>
                <tr>
                    <td class="centrar-texto" style="width: 20%;">234473</td>
                    <td style="width: 50%;">NINTENDO SWITCH GREY</td>
                    <td style="width: 30%;">XQW70026943155</td>
                </tr>
                <tr>
                    <td class="centrar-texto" style="width: 20%;">234473</td>
                    <td style="width: 50%;">NINTENDO SWITCH GREY</td>
                    <td style="width: 30%;">XQW70026943155</td>
                </tr>
                <tr>
                    <td class="centrar-texto" style="width: 20%;">234473</td>
                    <td style="width: 50%;">NINTENDO SWITCH GREY</td>
                    <td style="width: 30%;">XQW70026943155</td>
                </tr>
                <tr>
                    <td class="centrar-texto" style="width: 20%;">234473</td>
                    <td style="width: 50%;">NINTENDO SWITCH GREY</td>
                    <td style="width: 30%;">XQW70026943155</td>
                </tr>
                <tr>
                    <td class="centrar-texto" style="width: 20%;">234473</td>
                    <td style="width: 50%;">NINTENDO SWITCH GREY</td>
                    <td style="width: 30%;">XQW70026943155</td>
                </tr>
                <tr>
                    <td class="centrar-texto" style="width: 20%;">234473</td>
                    <td style="width: 50%;">NINTENDO SWITCH GREY</td>
                    <td style="width: 30%;">XQW70026943155</td>
                </tr>
                <tr>
                    <td class="centrar-texto" style="width: 20%;">234473</td>
                    <td style="width: 50%;">NINTENDO SWITCH GREY</td>
                    <td style="width: 30%;">XQW70026943155</td>
                </tr>
                <tr>
                    <td class="centrar-texto" style="width: 20%;">234473</td>
                    <td style="width: 50%;">NINTENDO SWITCH GREY</td>
                    <td style="width: 30%;">XQW70026943155</td>
                </tr>
                <tr>
                    <td class="centrar-texto" style="width: 20%;">234473</td>
                    <td style="width: 50%;">NINTENDO SWITCH GREY</td>
                    <td style="width: 30%;">XQW70026943155</td>
                </tr>
                <tr>
                    <td class="centrar-texto" style="width: 20%;">234473</td>
                    <td style="width: 50%;">NINTENDO SWITCH GREY</td>
                    <td style="width: 30%;">XQW70026943155</td>
                </tr>
                <tr>
                    <td class="centrar-texto" style="width: 20%;">234473</td>
                    <td style="width: 50%;">NINTENDO SWITCH GREY</td>
                    <td style="width: 30%;">XQW70026943155</td>
                </tr>
                <tr>
                    <td class="centrar-texto" style="width: 20%;">234473</td>
                    <td style="width: 50%;">NINTENDO SWITCH GREY</td>
                    <td style="width: 30%;">XQW70026943155</td>
                </tr>
                <tr>
                    <td class="centrar-texto" style="width: 20%;">234473</td>
                    <td style="width: 50%;">NINTENDO SWITCH GREY</td>
                    <td style="width: 30%;">XQW70026943155</td>
                </tr>
                <tr>
                    <td class="centrar-texto" style="width: 20%;">234473</td>
                    <td style="width: 50%;">NINTENDO SWITCH GREY</td>
                    <td style="width: 30%;">XQW70026943155</td>
                </tr>
                <tr>
                    <td class="centrar-texto" style="width: 20%;">234473</td>
                    <td style="width: 50%;">NINTENDO SWITCH GREY</td>
                    <td style="width: 30%;">XQW70026943155</td>
                </tr>
                <tr>
                    <td class="centrar-texto" style="width: 20%;">234473</td>
                    <td style="width: 50%;">NINTENDO SWITCH GREY</td>
                    <td style="width: 30%;">XQW70026943155</td>
                </tr>
                <tr>
                    <td class="centrar-texto" style="width: 20%;">234473</td>
                    <td style="width: 50%;">NINTENDO SWITCH GREY</td>
                    <td style="width: 30%;">XQW70026943155</td>
                </tr>
                <tr>
                    <td class="centrar-texto" style="width: 20%;">234473</td>
                    <td style="width: 50%;">NINTENDO SWITCH GREY</td>
                    <td style="width: 30%;">XQW70026943155</td>
                </tr>
                <tr>
                    <td class="centrar-texto" style="width: 20%;">234473</td>
                    <td style="width: 50%;">NINTENDO SWITCH GREY</td>
                    <td style="width: 30%;">XQW70026943155</td>
                </tr>
                <tr>
                    <td class="centrar-texto" style="width: 20%;">234473</td>
                    <td style="width: 50%;">NINTENDO SWITCH GREY</td>
                    <td style="width: 30%;">XQW70026943155</td>
                </tr>
                <tr>
                    <td class="centrar-texto" style="width: 20%;">234473</td>
                    <td style="width: 50%;">NINTENDO SWITCH GREY</td>
                    <td style="width: 30%;">XQW70026943155</td>
                </tr>
                <tr>
                    <td class="centrar-texto" style="width: 20%;">234473</td>
                    <td style="width: 50%;">NINTENDO SWITCH GREY</td>
                    <td style="width: 30%;">XQW70026943155</td>
                </tr>
                <tr>
                    <td class="centrar-texto" style="width: 20%;">234473</td>
                    <td style="width: 50%;">NINTENDO SWITCH GREY</td>
                    <td style="width: 30%;">XQW70026943155</td>
                </tr>
                <tr>
                    <td class="centrar-texto" style="width: 20%;">234473</td>
                    <td style="width: 50%;">NINTENDO SWITCH GREY</td>
                    <td style="width: 30%;">XQW70026943155</td>
                </tr>
                <tr>
                    <td class="centrar-texto" style="width: 20%;">234473</td>
                    <td style="width: 50%;">NINTENDO SWITCH GREY</td>
                    <td style="width: 30%;">XQW70026943155</td>
                </tr>
                <tr>
                    <td class="centrar-texto" style="width: 20%;">234473</td>
                    <td style="width: 50%;">NINTENDO SWITCH GREY</td>
                    <td style="width: 30%;">XQW70026943155</td>
                </tr>
                <tr>
                    <td class="centrar-texto" style="width: 20%;">234473</td>
                    <td style="width: 50%;">NINTENDO SWITCH GREY</td>
                    <td style="width: 30%;">XQW70026943155</td>
                </tr>
            </tbody>
        </table>
    </main>

</body>
</html>
