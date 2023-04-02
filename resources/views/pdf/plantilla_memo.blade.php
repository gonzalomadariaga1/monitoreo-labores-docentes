<!DOCTYPE html>
<html>

<head>
    <title>{{ $nombre_docente }} - MEMO</title>
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

        .p-titulo{
            font-size: 18px;
            text-align: center;
        }

        .p-cc{
            font-size: 8px;
        }

        p.primeralinea {
            text-indent: 40px;
            margin-block-start: 0;
            margin-block-end: 0;
        }

        .firmautp {
            text-align:center;
        }

        .rguachile{
            text-align: center;
        }

    </style>
</head>

<body>
    <div class="contenedor-imagenes">
        <img class="logoliceo" src="https://i.imgur.com/qyk9i8R.png">
        <img class="logorgua" src="https://i.imgur.com/uVmNbin.png">
    </div>




    
    <p class="p-titulo"> <b>MEMORÁNDUM</b> </p>

    <div class="correlativo">
        <p><b>N°: {{$correlativo}}</b> </p>

    </div>

    <p>Docente: <b> {{$nombre_docente}} </b> </p>

    <p>REF.: <b> {{$ref}}</b> </p>

    <p>FECHA.: <b> {{$fecha}} </b> </p>

    <p class="primeralinea">Según la RAE un memorando es un “Informe en que se recopilan hechos y razones que deben
        tenerse en cuenta en un determinado asunto”. Es decir, se refiere a algo que debe ser recordado y no es una
        amonestación.</p>

    <p class="primeralinea">Es de su conocimiento que la Superintendencia y la Agencia de Calidad de la Educación
        supervisan periódicamente el funcionamiento institucional, chequeando la documentación oficial, dejando
        constancia de las irregularidades en un ACTA DE INSPECCIÓN.</p>

    <p class="primeralinea">En consecuencia, solicito cautelar el cumplimiento de sus deberes profesionales evitando,
        por ejemplo, la(s) siguiente(s) faltas o irregularidades:</p>

        <ol>

         @foreach ($curses as $key => $data)
         <li>
         {{$key}} en 
           @foreach ($data as $key => $items)
           {{$key}}, curso(s): 
            @foreach ($items as $curse)
            {{$curse->nombre_curso}} <span>-</span>
            {{-- {{$curse->pluck('nombre_curso')->implode(', ')}} --}}
            @endforeach
           @endforeach
        </li>
         @endforeach
    </ol>
 
    <br><br><br><br>

    <div class="firmautp">
        <img src="https://i.imgur.com/A93zkr8.jpg" alt="" srcset="">
        

    </div>

    <div class="rguachile">
        <p> <b> RANCAGUA, CHILE </b></p>
    </div>


    
    <p class="p-cc" >CMM/cmm <br>
        Distribución: <br>
        -	Destinatario <br>
        -	Dirección <br>
        -	Archivo UTP <br>
        </p>

</body>

</html>