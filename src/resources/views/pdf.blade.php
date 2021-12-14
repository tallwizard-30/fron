<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Factura</title>

    <style type="text/css">
        * {
            font-family: Verdana, Arial, sans-serif;
        }

        table { 
            font-size: x-small;
        }

        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }

        .gray {
            background-color: lightgray
        }

        tr:nth-child(even) {
            background-color: #E7E7E7;
        }
    </style>

</head>

<body>

    <table width="100%">
        <tr>
            <td valign="top">
                <img src="{{ $imgLogo }}" alt="" width="200" />
            </td>
            <td align="right">
                <h3> {{$provider['providerName']}}</h3>
                <pre>
                Documento: {{$provider['providerDocument']}}
                Direcci&oacute;n: {{$provider['providerAddress']}}
                Telefono: {{$provider['providerPhone']}}
                Email: {{$provider['providerEmail']}}
            </pre>
            </td>
        </tr>

    </table>
    <br />
    <table width="100%">
        <thead style="background-color: red; color:white;">
            <tr>
                <th>C&oacute;digo</th>
                <th>Descripci&oacute;n</th>
                <th>Cliente</th>
                <th>Fecha de vencimiento</th>
                <th>Forma de pago</th>
                <th>Metodo de pago</th>
                <th>Instituci&oacute;n</th>
                <th>Dependencia</th>
                <th>Fecha</th>
                <th>Cuenta bancaria</th>
                <th>Estado</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php
             $fmt = new NumberFormatter('es_CO', NumberFormatter::CURRENCY);
             foreach ($data as $key => $value) {
                echo '<tr>';
                echo '<td align="left">'.$value['prefix'].'</td>';
                echo '<td align="left">' . $value['description'] . '</td>';
                echo '<td align="left">' . $value['client'] . '</td>';
                echo '<td align="left">' . $value['expirationDate'] . '</td>';
                echo '<td align="left">' . $value['wayPay'] . '</td>';
                echo '<td align="left">' . $value['payMethod'] . '</td>';
                echo '<td align="left">' . $value['institution'] . '</td>';
                echo '<td align="left">' . $value['dependence'] . '</td>';
                echo '<td align="left">' . $value['date'] . '</td>';
                echo '<td align="left">' . $value['bankAccount'] . '</td>';
                 
				if($value['status'] == 1){
				 	$status = 'Pendiente';
				}else if($value['status'] == 2){
					$status = 'Aceptado';
				}else{
					$status ='Error';
				}
				echo '<td align="left">' . $status . '</td>';
                echo '<td align="right"> ' . $fmt->formatCurrency($value['total'], "COP") . '</td>';
                echo '</tr>';
              }
            ?>
        </tbody>
    </table>
    <script type="text/php">
        if ( isset($pdf) ) {
            $pdf->page_script('
                $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                $pdf->text(370, 580, "Pagina $PAGE_NUM de $PAGE_COUNT", $font, 10);
            ');
        }
        </script>

</body>

</html>
