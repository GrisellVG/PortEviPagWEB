<?php
$nombre = $_POST ['nombre'];
$salario = $_POST ['sal'];
$ingreso = $_POST ['ingreso'];
$TipoNomina = $_POST['Tnomina'];
$faltas = $_POST['faltas'];
$faltam = $_POST['faltam'];
$faltap = $_POST['faltap'];
$retardo = $_POST['retardo'];
$faltastotal = $_POST['faltastotal'];
$dias = 365;
$tareas = $_POST['tareas'];
$horasex = $_POST['horasex'];
$fovisste =$_POST['fovisste'];

switch ($TipoNomina) {
  case '1':
    $salariolimpio = $salario * 7;
    $salariomensual = $salariolimpio *4;
    break;
  case '2':
    $salariolimpio = $salario * 15;
    $salariomensual = $salariolimpio*2;
    break;
  case '3':
    $salariolimpio = $salario * 30;
    $salariomensual = $salariolimpio*1;
    break;
}
switch ($faltas) {
    case '1':
      $faltassj = $faltastotal-$faltam-$faltap;
      $descuentosj = $faltassj * $salario;
      $diastotal = $dias-$faltastotal;
      $descuentodia =$salario * .5;
      $descuentopordias = $descuentodia * $faltap;
      $total = $salariolimpio - $descuentopordias - $descuentosj;
      break;
    case '2':
    $faltassj = $faltastotal-$faltam-$faltap;
    $descuentosj = $faltassj * $salario;
    $diastotal = $dias-$faltastotal;
    $descuentodia =$salario * .5;
    $descuentopordias = $descuentodia * $faltap;
    $total = $salariolimpio - $descuentopordias - $descuentosj;
      break;
  }
switch ($tareas) { /*Calculadora de bono de eficacia*/
  case '1':
    $Bono1 = $salariolimpio * .055;
    break;

    case '2':
      $Bono1 = 0;
      break;
    break;
}
if ($faltastotal == 0 and $retardo == 2 ) { //bono
   $Bono2 = $salariolimpio * .062;
} else {
  $Bono2 = 0;
}
  $aniostrabajados = 2019-$ingreso;
  $prima = .25;
if ($aniostrabajados == 0) {
  $diasvacas= 0;
} elseif ($aniostrabajados == 1) {
  $diasvacas=6;
} elseif ($aniostrabajados == 2) {
  $diasvacas=8;
}elseif ($aniostrabajados == 3) {
  $diasvacas=10;
}elseif ($aniostrabajados == 4) {
  $diasvacas=12;
}elseif ($aniostrabajados>=5 and $aniostrabajados<=9) {
  $diasvacas=14;
}elseif ($aniostrabajados>=10 and $aniostrabajados<=14) {
  $diasvacas=16;
}elseif ($aniostrabajados>=15 and $aniostrabajados<=19) {
  $diasvacas=18;
}elseif ($aniostrabajados>=20 and $aniostrabajados<=24) {
  $diasvacas=20;
}
$primavaca = $diasvacas*$salario*.25;
if ($diastotal==365) {
$aguinaldo = $salario*15;
}else {
  $aguinaldo="Lo siento no tienes aguinaldo";
}
$salarioxhra = $salario/8;
if ($horasex <=9) {   //Horas exra
  $bono3 = $salarioxhra*2*$horasex;
} elseif ($horasex>=10) {
  $he2 = $horasex-9;
  $bono3 = ($salarioxhra*3*$he2)+($salarioxhra*2*9);
  }

$final = $total + $Bono1 + $Bono2 + $bono3;
$ISR = $final*.16;
$SeguroCesantia = $final*.077;
$SeguroInvalidez = $final*.078;
$Servsocial = $final*.062;
$SeguroSalud = $final*.042;
if ($fovisste==1) {
  $Sfovisste = $final*.30;
}else {
  $Sfovisste= 0;
}
$Nsalariofinal = $final-$ISR-$SeguroSalud-$SeguroCesantia-$SeguroInvalidez-$Sfovisste;
 ?>
 <!DOCTYPE html>
 <html lang="es" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title></title>
   </head>
   <body>
     <p>Hola!: <?php echo $nombre?></p>
     <p>Su salario diario es de: $<?php echo $salario ?></p>
     <p>su salario sin descuentos es: $<?php echo $salariolimpio ?></p>
     <p>tienes: <?php echo $faltastotal ?> Faltas, <?php echo $faltassj ?> sin justificar</p>
     <p>la multa por las faltas justificadas: -$<?php echo $descuentopordias ?></p>
     <p>la multa por faltas sin justificar: -$<?php echo $descuentosj ?></p>
     <p>el bomo por eficacia: $<?php echo $Bono1 ?></p>
     <p>el bono por Asistencia: $<?php echo $Bono2 ?></p>
     <p>Tu Salario Final es: $<?php echo $final?></p>
     <p>Trabajaste: <?php echo $diastotal  ?> dias</p>

     <p> Vacaciones</p>
     <p>llevas <?php echo $aniostrabajados?> años Trabajados</p>
     <p>Tienes <?php echo $diasvacas?>dias de Vacaciones!</p>
     <p>tu prima vacacional es de: $<?php echo $primavaca ?></p>

     <p>Aguinaldo</p>
     <p>Tu aguinaldo es de: $<?php echo $aguinaldo ?></p>

     <p>Bono horas extra</p>
     <p>Tu Bono por horas extra es de <?php echo $bono3 ?></p>

     <p>Deducciones</p>
     <p>Pago del isr: -<?php echo $ISR ?></p>
     <p>pago de seguro de cesantia -<?php echo $SeguroCesantia ?></p>
     <p>Pago de invalidez: -<?php echo $SeguroInvalidez ?></p>
     <p>servicios sociales y culturales -<?php echo $Servsocial ?></p>
     <p>Pago de seguro de salud: -<?php echo $SeguroSalud ?></p>
     <p>fovisste: <?php echo $Sfovisste ?></p>

     <p>Nuevo salario final</p>
     <p><?php echo $Nsalariofinal ?></p>

   </body>
 </html>
