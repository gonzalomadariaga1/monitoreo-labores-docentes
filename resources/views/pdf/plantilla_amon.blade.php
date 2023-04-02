<!DOCTYPE html>
<html>

<head>
    <title>{{ $nombre_docente }} - AMONESTACION</title>
    <style>
        ol li span:last-child {
            display: none !important
        }

        body {
            font-family: Calibri, Candara, Segoe, Segoe UI, Optima, Arial, sans-serif;
        }

        .contenedor-imagenes {

            padding-bottom: 80px;
        }

        .logoliceo {
            float: left;
            width: 40%;


        }

        .logorgua {
            float: right;
            width: 15%;

        }

        .correlativo {
            text-align: right
        }

        p {
            font-size: 14px;
        }

        .p-titulo {
            font-size: 18px;
            text-align: center;
        }

        .p-cc {
            font-size: 8px;
        }

        p.primeralinea {
            text-indent: 40px;
            margin-block-start: 0;
            margin-block-end: 0;
        }

        .firmautp {
            float: left;
            margin-left:50px;
        }

        .firmadirector {
            float: right;
            margin-right:50px;
        }

        .rguachile {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="contenedor-imagenes">
        <img class="logoliceo" src="https://i.imgur.com/qyk9i8R.png">
        <img class="logorgua" src="https://i.imgur.com/uVmNbin.png">
    </div>





    <p class="p-titulo"> <b> <u> CARTA DE AMONESTACIÓN A DOCENTE </u> </b> </p>

    <div class="correlativo">
        <p><b>N°: {{ $correlativo }}</b> </p>

    </div>

    <p>DE: <b> <i> Cesar Madariaga Miranda, Jefe Unidad Técnico Pedagógica. </i> </b> </p>

    <p>PARA: <b> {{ $nombre_docente }}</b> </p>

    <p>FECHA.: <b> {{ $fecha }} </b> </p>

    <p class="primeralinea">Teniendo en consideración la Ley 19.070 (Estatuto Docente), Artículo 6°, letra b); el
        Reglamento Interno de Orden, Higiene y Seguridad (Cormun), Artículo 15, numeral 13 y 14 y el Manual de Roles y
        Funciones del Liceo, Apartado Docentes, Docencia de Aula: numerales 2, 3, 12 y 15.</p>

    <p class="primeralinea">Las siguientes faltas se sancionan con amonestación escrita:</p>



    <ol>

        @foreach ($curses as $key => $data)
            <li>
                {{ $key }} en
                @foreach ($data as $key => $items)
                    {{ $key }}, curso(s):
                    @foreach ($items as $curse)
                        {{ $curse->nombre_curso }} <span>-</span>
                        {{-- {{$curse->pluck('nombre_curso')->implode(', ')}} --}}
                    @endforeach
                @endforeach
            </li>
        @endforeach
    </ol>

    <br><br><br><br>
    <br><br><br><br>


    <img class="firmautp" src="https://i.imgur.com/A93zkr8.jpg alt="" srcset="">



    <img class="firmadirector"src="https://i.imgur.com/yETgMOx.jpg" alt="" srcset="">


    <br><br><br><br>
    <br><br><br><br>


    <div class="rguachile">
        <p> <b> RANCAGUA, CHILE </b></p>
    </div>



    <p class="p-cc">CMM/cmm <br>
        Distribución: <br>
        - Destinatario <br>
        - Dirección <br>
        - Archivo UTP <br>
    </p>

</body>

</html>
