<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Document</title>

    <style>
        @page {
            margin: 100px 25px 140px 25px;
        }

        body {
            margin-top: 160px;
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
            bottom: -120px;
            left: 0px;
            right: 0px;
            height: 80px;

            /** Extra personal styles **/
            background-color: white;
            color: black;
            text-align: center;
            border-top: 2px solid black;
            border-bottom: 2px solid black;
            padding-top: 25px;
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

        .pagenum:before {
            /*content: counter(page);*/
            content: counter(page, decimal);
        }


    </style>
</head>
<body>

    <header class="centrar-texto">
        <table style="margin-bottom: 10px">
            <tbody>
                <tr style="vertical-align: text-top;">
                    <td style="width: 35%">
                        <img src="{{ public_path('images/logo.png') }}" alt="" style="margin-bottom: 10px;">
                        <p>CM TechGo - Camacua</p>
                        <p>Camacua 46</p>
                        <p>CABA - C1406DOB</p>
                    </td>
                    <td>
                        <div class="centrar-texto">
                            <span class="tipo-documento">R</span>
                        </div>
                        <div class="centrar-texto" style="margin-top: 5px">
                            <p>Pagina <span class="pagenum"></span></p>
                        </div>
                    </td>
                    <td  style="width: 35%; text-align: center">
                        <p class="negrita remito-nro" style="margin-bottom: 10px;">REMITO Nro.<br>{{ $shipment->name }}</p>
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
                        <p>Destinatario: <span class="negrita ">{{ $shipment->shipto }}</span></p>
                        <p>Fecha de preparacion: <span class="negrita">{{ $shipment->updated_at }}</span></p>
                        {{--                <p class="detalle-compania">Domicilio: <span class="negrita">901-176912-8</span></p>--}}
                        {{--                <p class="detalle-compania">Localidad: <span class="negrita">04/09/2012</span></p>--}}
                        {{--                <p class="detalle-compania">Provincia: <span class="negrita">04/09/2012</span></p>--}}
                        {{--                <p class="detalle-compania">Localidad: <span class="negrita">04/09/2012</span></p>--}}
                    </td>
                    <td style="width: 30%">
                        <p>Remito interno: <span class="negrita">{{ $shipment->nro_interno }}</span></p>
                        <p>Cantidad de productos: <span class="negrita">{{ count($shipment->repairs) }}</span></p>
                    </td>
                </tr>
            </tbody>
        </table>


        <table style="border-bottom: 2px solid black">
            <thead>
                <tr>
                    <th style="width: 5%;">#</th>
                    <th style="width: 15%;">Articulo</th>
                    <th style="width: 35%;text-align: left">Descripcion</th>
                    <th style="width: 30%;text-align: left">Nro. Serie</th>
                    <th class="centrar-texto" style="width: 15%;text-align: left">Estado Salida</th>
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
                        <p style="margin: 0;" class="detalle-compania centrar-texto">DESPOSITO RECEPCION</p>
                    </td>
                </tr>
            </tbody>

        </table>
    </footer>

    <main class="centrar-texto">
        <table class="tabla-productos">
            <tbody>
{{--                @php( $repairs = $this->shipment->repairs()->orderBy('is_repair')->get() )--}}
{{--                @for($i=0; $i < count($repairs); $i++ )--}}
                @foreach($shipment->repairs as $repair)
                    <tr>
                        <th style="width: 5%;">{{ $repair->id }}</th>
                        <td class="centrar-texto" style="width: 15%;">{{ $repair->product->id }}</td>
                        <td style="width: 35%;">{{ $repair->product->descripcion }}</td>
                        <td style="width: 30%;">{{ $repair->nro_serie }}</td>
                        <td class="centrar-texto" style="width: 15%;">@if( $repair->is_repair ) REPARADO @else IRREPARABLE @endif</td>
                    </tr>
                @endforeach
{{--                <tr>--}}
{{--                    <th style="width: 5%;">1</th>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                    <td style="width: 35%;">asd</td>--}}
{{--                    <td style="width: 30%;">asd</td>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <th style="width: 5%;">2</th>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                    <td style="width: 35%;">asd</td>--}}
{{--                    <td style="width: 30%;">asd</td>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <th style="width: 5%;">1</th>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                    <td style="width: 35%;">asd</td>--}}
{{--                    <td style="width: 30%;">asd</td>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <th style="width: 5%;">1</th>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                    <td style="width: 35%;">asd</td>--}}
{{--                    <td style="width: 30%;">asd</td>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <th style="width: 5%;">1</th>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                    <td style="width: 35%;">asd</td>--}}
{{--                    <td style="width: 30%;">asd</td>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <th style="width: 5%;">1</th>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                    <td style="width: 35%;">asd</td>--}}
{{--                    <td style="width: 30%;">asd</td>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <th style="width: 5%;">1</th>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                    <td style="width: 35%;">asd</td>--}}
{{--                    <td style="width: 30%;">asd</td>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <th style="width: 5%;">1</th>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                    <td style="width: 35%;">asd</td>--}}
{{--                    <td style="width: 30%;">asd</td>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <th style="width: 5%;">1</th>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                    <td style="width: 35%;">asd</td>--}}
{{--                    <td style="width: 30%;">asd</td>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <th style="width: 5%;">1</th>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                    <td style="width: 35%;">asd</td>--}}
{{--                    <td style="width: 30%;">asd</td>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <th style="width: 5%;">1</th>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                    <td style="width: 35%;">asd</td>--}}
{{--                    <td style="width: 30%;">asd</td>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <th style="width: 5%;">1</th>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                    <td style="width: 35%;">asd</td>--}}
{{--                    <td style="width: 30%;">asd</td>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <th style="width: 5%;">1</th>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                    <td style="width: 35%;">asd</td>--}}
{{--                    <td style="width: 30%;">asd</td>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <th style="width: 5%;">1</th>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                    <td style="width: 35%;">asd</td>--}}
{{--                    <td style="width: 30%;">asd</td>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <th style="width: 5%;">1</th>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                    <td style="width: 35%;">asd</td>--}}
{{--                    <td style="width: 30%;">asd</td>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <th style="width: 5%;">1</th>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                    <td style="width: 35%;">asd</td>--}}
{{--                    <td style="width: 30%;">asd</td>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <th style="width: 5%;">1</th>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                    <td style="width: 35%;">asd</td>--}}
{{--                    <td style="width: 30%;">asd</td>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <th style="width: 5%;">15</th>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                    <td style="width: 35%;">asd</td>--}}
{{--                    <td style="width: 30%;">asd</td>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <th style="width: 5%;">1</th>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                    <td style="width: 35%;">asd</td>--}}
{{--                    <td style="width: 30%;">asd</td>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <th style="width: 5%;">1</th>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                    <td style="width: 35%;">asd</td>--}}
{{--                    <td style="width: 30%;">asd</td>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <th style="width: 5%;">1</th>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                    <td style="width: 35%;">asd</td>--}}
{{--                    <td style="width: 30%;">asd</td>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <th style="width: 5%;">1</th>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                    <td style="width: 35%;">asd</td>--}}
{{--                    <td style="width: 30%;">asd</td>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <th style="width: 5%;">1</th>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                    <td style="width: 35%;">asd</td>--}}
{{--                    <td style="width: 30%;">asd</td>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <th style="width: 5%;">1</th>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                    <td style="width: 35%;">asd</td>--}}
{{--                    <td style="width: 30%;">asd</td>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <th style="width: 5%;">1</th>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                    <td style="width: 35%;">asd</td>--}}
{{--                    <td style="width: 30%;">asd</td>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                </tr><tr>--}}
{{--                    <th style="width: 5%;">1</th>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                    <td style="width: 35%;">asd</td>--}}
{{--                    <td style="width: 30%;">asd</td>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <th style="width: 5%;">1</th>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                    <td style="width: 35%;">asd</td>--}}
{{--                    <td style="width: 30%;">asd</td>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <th style="width: 5%;">1</th>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                    <td style="width: 35%;">asd</td>--}}
{{--                    <td style="width: 30%;">asd</td>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <th style="width: 5%;">1</th>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                    <td style="width: 35%;">asd</td>--}}
{{--                    <td style="width: 30%;">asd</td>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <th style="width: 5%;">1</th>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                    <td style="width: 35%;">asd</td>--}}
{{--                    <td style="width: 30%;">asd</td>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <th style="width: 5%;">1</th>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                    <td style="width: 35%;">asd</td>--}}
{{--                    <td style="width: 30%;">asd</td>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                </tr><tr>--}}
{{--                    <th style="width: 5%;">1</th>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                    <td style="width: 35%;">asd</td>--}}
{{--                    <td style="width: 30%;">asd</td>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <th style="width: 5%;">1</th>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                    <td style="width: 35%;">asd</td>--}}
{{--                    <td style="width: 30%;">asd</td>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <th style="width: 5%;">1</th>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                    <td style="width: 35%;">asd</td>--}}
{{--                    <td style="width: 30%;">asd</td>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <th style="width: 5%;">1</th>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                    <td style="width: 35%;">asd</td>--}}
{{--                    <td style="width: 30%;">asd</td>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <th style="width: 5%;">1</th>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                    <td style="width: 35%;">asd</td>--}}
{{--                    <td style="width: 30%;">asd</td>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <th style="width: 5%;">1</th>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                    <td style="width: 35%;">asd</td>--}}
{{--                    <td style="width: 30%;">asd</td>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <th style="width: 5%;">50</th>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                    <td style="width: 35%;">asd</td>--}}
{{--                    <td style="width: 30%;">asd</td>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <th style="width: 5%;">51</th>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                    <td style="width: 35%;">asd</td>--}}
{{--                    <td style="width: 30%;">asd</td>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <th style="width: 5%;">52</th>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                    <td style="width: 35%;">asd</td>--}}
{{--                    <td style="width: 30%;">asd</td>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <th style="width: 5%;">53</th>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                    <td style="width: 35%;">asd</td>--}}
{{--                    <td style="width: 30%;">asd</td>--}}
{{--                    <td class="centrar-texto" style="width: 15%;">asd</td>--}}
{{--                </tr>--}}


            </tbody>
        </table>
    </main>

</body>
</html>
