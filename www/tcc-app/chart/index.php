<?php

$raiz = $_SERVER['DOCUMENT_ROOT'];
require_once $raiz . '/tcc-app/connect.php';
$saida_n = '';
$contem = 0;

if (!empty($_POST[2]) && isset($_POST[2])) {
    if (!empty($_POST[9]) && isset($_POST[9])) {
        $LON = $_POST[9];
        $LAT = $_POST[2];

        $stmt = $conn->prepare('SELECT ID, LAT, LON, ANUAL/1000 as ANUAL, round( SQRT(
            POW(69.1 * (LAT - (:lat)), 2) +
            POW(69.1 * ((:lon) - LON) * COS(LAT / 57.3), 2)),3) AS distance
        FROM solar HAVING distance < 5 ORDER BY distance
        LIMIT 1;');

        $stmt->execute([ 'lat' => $LAT['lat'], 'lon' => $LON['lon'] ]);
        $contem = 1;
    } 
} else {
    echo "No Data";
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="initial-scale=1.0">
    <title>TCC - Alberto Vitoriano</title>
    <link rel="stylesheet" href="../css/style2.css">
</head>
<body>
    
<?PHP if($contem == 1){ 
  while($val = $stmt->fetch()) { 
?>


<table class="demo">
	</thead>
	<tbody>
	<tr>
		<td>&nbsp;Endereço:</td>
		<td>&nbsp;<?php echo $_POST[1]['endereco'];?></td>
		<td>&nbsp;<?php 
    if($_POST[3]['metodo'] == 1){ 
      echo 'Potencia Instalada';
    }elseif ($_POST[3]['metodo'] == 2) {
      echo 'Consumo Mensal';
    }else{
      echo "N/A";
    }
    ?>:</td>
		<td>&nbsp;<?php echo $_POST[4]['dim'];?>kwh</td>
	</tr>
	<tr>
		<td>&nbsp;Padrão:</td>
		<td>&nbsp;<?php 
    if($_POST[5]['padrao'] == 1){ 
      echo 'Monofásico';
    }elseif ($_POST[5]['padrao'] == 2) {
      echo 'Bifásico';
    }elseif ($_POST[5]['padrao'] == 3) {
      echo 'Trifásico';
    }else{
      echo "N/A";
    }
    ?></td>
		<td>&nbsp;Grupo de Cliente:</td>
		<td>&nbsp;<?php 
    if($_POST[6]['grupo'] == 1){ 
      echo 'Grupo A';
    }elseif ($_POST[6]['grupo'] == 2) {
      echo 'Grupo B';
    }else{
      echo "N/A";
    }
    ?></td>
	</tr>
	<tr>
		<td>&nbsp;Tipo de Inversor escolhido:</td>
		<td>&nbsp;<?php 
    if($_POST[7]['tipo'] == 1){ 
      echo 'Inversor com Strings';
    }elseif ($_POST[7]['tipo'] == 2) {
      echo 'Micro-Inversor';
    }else{
      echo "N/A";
    }
    ?></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>Distancia de medição:</td>
		<td>&nbsp;<?php echo $val['distance']; ?>km</td>
    <td>ID: <?php echo $val['ID']; ?></td>
		<td>Média ao longo de um ano de horas de sol no dia:</td>
		<td>&nbsp;<?php echo $val['ANUAL']; ?>H</td>
	</tr>
	</tbody>
</table>
<?PHP 
if(array_key_exists('ID', $val)){
  $saida_n = $val['ID'];
}
} } ?>

<div id="container"></div>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
    Highcharts.chart('container', {
  chart: {
    type: 'column'
  },
  tooltip: {
                valueSuffix: 'kWh',
  },
  title: {
    text: 'Geração em KwH ao longo de um ano'
  },
  subtitle: {
        text: 'Fonte: labren.ccst.inpe.br'
  },
  xAxis: {
    categories: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez']
  },
  yAxis: {
        title: {
            text: 'Geração em kWh'
        }
  },
  credits: {
    enabled: false
  },
  series: [{
    name: 'Previsto',

    <?php if(!empty($saida_n)){
      $stmt2 = $conn->prepare('SELECT tt.JAN, tt.FEV, tt.MAR, tt.ABR, tt.MAI, tt.JUN, tt.JUL, tt.AGO, tt.`SET`, tt.`OUT`, tt.NOV, tt.DEZ FROM sundata.solar AS tt WHERE id = :id;');

      $stmt2->execute([ 'id' => $saida_n ]);
      $saida = $stmt2->fetchAll(PDO::FETCH_ASSOC);
      $saida_f = $saida[0];
      
      echo 'data: [';
      foreach($saida_f as $row  => $valor) {
        echo $valor  . ',';
      }
      echo ']';
    }else{
      echo 'data: [1293.75, 1298.25, 1253.25, 1093.5, 1167.75, 1176.75, 1226.25, 1325.25, 1361.25, 1417.5, 1426.5, 1336.5]';
    } ?> 
  },{
    name: 'Geração Real',
    data: [1035, 1038.6, 1002.6, 874.8, 934.2, 941.4, 981, 1060.2, 1089, 1134, 1141.2, 1069.2]
  }]
});
</script>
</body>
</html>