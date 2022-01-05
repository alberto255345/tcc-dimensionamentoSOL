<?php

$raiz = $_SERVER['DOCUMENT_ROOT'];
require_once $raiz . '/tcc-app/connect.php';

$contem = 0;

if (!empty($_GET['lat']) && isset($_GET['lat'])) {
    if (!empty($_GET['lon']) && isset($_GET['lon'])) {
      if (!empty($_GET['dim']) && isset($_GET['dim'])) {
        $LON = $_GET['lon'];
        $LAT = $_GET['lat'];
        $DIM = $_GET['dim'];

        $stmt = $conn->prepare('SELECT ID, LAT, LON, ANUAL/1000 as ANUAL, round( SQRT(
            POW(69.1 * (LAT - (:lat)), 2) +
            POW(69.1 * ((:lon) - LON) * COS(LAT / 57.3), 2)),3) AS distance
        FROM solar HAVING distance < 5 ORDER BY distance
        LIMIT 1;');

        $stmt->execute([ 'lat' => $LAT, 'lon' => $LON ]);

        $contem = 1;
        
      }
    } 
} else {
    echo "No, mail is not set";
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
		<td>&nbsp;<?php echo $_GET['endereco'];?></td>
		<td>&nbsp;<?php 
    if($_GET['metodo'] == 1){ 
      echo 'Potencia Instalada';
    }elseif ($_GET['metodo'] == 2) {
      echo 'Consumo Mensal';
    }else{
      echo "N/A";
    }
    ?>:</td>
		<td>&nbsp;<?php echo $_GET['metodovalor'];?>kwh</td>
	</tr>
	<tr>
		<td>&nbsp;Padrão:</td>
		<td>&nbsp;<?php 
    if($_GET['padrao'] == 1){ 
      echo 'Monofásico';
    }elseif ($_GET['padrao'] == 2) {
      echo 'Bifásico';
    }elseif ($_GET['padrao'] == 3) {
      echo 'Trifásico';
    }else{
      echo "N/A";
    }
    ?></td>
		<td>&nbsp;Grupo de Cliente:</td>
		<td>&nbsp;<?php 
    if($_GET['grupo'] == 1){ 
      echo 'Grupo A';
    }elseif ($_GET['grupo'] == 2) {
      echo 'Grupo B';
    }else{
      echo "N/A";
    }
    ?></td>
	</tr>
	<tr>
		<td>&nbsp;Tipo de Inversor escolhido:</td>
		<td>&nbsp;<?php 
    if($_GET['tipo'] == 1){ 
      echo 'Inversor com Strings';
    }elseif ($_GET['tipo'] == 2) {
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
		<td>média ao longo de um ano de horas de sol no dia:</td>
		<td>&nbsp;<?php echo $val['ANUAL']; ?>H</td>
	</tr>
	</tbody>
</table>

<?PHP } } ?>

<div id="container"></div>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
    Highcharts.chart('container', {
  chart: {
    type: 'area'
  },
  title: {
    text: 'Geração em KwH ao longo de um ano'
  },
  xAxis: {
    categories: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez']
  },
  credits: {
    enabled: false
  },
  series: [{
    name: 'Previsto',
    data: [1293.75, 1298.25, 1253.25, 1093.5, 1167.75, 1176.75, 1226.25, 1325.25, 1361.25, 1417.5, 1426.5, 1336.5]
  },{
    name: 'Geração Real',
    data: [1035, 1038.6, 1002.6, 874.8, 934.2, 941.4, 981, 1060.2, 1089, 1134, 1141.2, 1069.2]
  }]
});
</script>
</body>
</html>