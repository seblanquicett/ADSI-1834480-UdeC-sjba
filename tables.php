<?php
include_once('sesiones.php');

include_once('conexion.php');
?>
<?php
try { 


$sql="SELECT region_sjba.region,
genero_sjba.genero,
estadocivil_sjba.estadocivil,
nivelacademicomama_sjba.nivelacademico_mama,
nivelacademicopapa_sjba.nivelacademico_papa,
tipodevivienda_sjba.tipodevivienda,
tipodeinstitucion_sjba.tipodeinstitucion,
tiempo_de_graduado_sjba.tiempo_de_graduado,
calificatucarrera_sjba.calificatucarrera,
encuesta_sjba.identificacion,encuesta_sjba.nombre,encuesta_sjba.apellido,encuesta_sjba.email,
encuesta_sjba.telefono,encuesta_sjba.direccion,encuesta_sjba.nacimiento,encuesta_sjba.actividaddelpapa,
encuesta_sjba.actividaddelamama,encuesta_sjba.carrera,encuesta_sjba.id_ingresoeconomico,encuesta_sjba.asignaturas_matriculadas 
FROM encuesta_sjba 
INNER JOIN region_sjba ON encuesta_sjba.id_region = region_sjba.id
INNER JOIN genero_sjba ON encuesta_sjba.id_genero = genero_sjba.id
INNER JOIN estadocivil_sjba ON encuesta_sjba.id_estadocivil = estadocivil_sjba.id
INNER JOIN nivelacademicomama_sjba ON encuesta_sjba.id_nivelacademicoMama = nivelacademicomama_sjba.id
INNER JOIN nivelacademicopapa_sjba ON encuesta_sjba.id_nivelacademicoPapa = nivelacademicopapa_sjba.id
INNER JOIN tipodevivienda_sjba ON encuesta_sjba.id_tipodevivienda = tipodevivienda_sjba.id
INNER JOIN tipodeinstitucion_sjba ON encuesta_sjba.tipodeinstitucion = tipodeinstitucion_sjba.id
INNER JOIN tiempo_de_graduado_sjba ON encuesta_sjba.tiempo_de_graduado = tiempo_de_graduado_sjba.id
INNER JOIN calificatucarrera_sjba ON encuesta_sjba.calificatucarrera = calificatucarrera_sjba.id
WHERE identificacion = ?";

$stm=$conn->prepare($sql);
$stm->execute(array($_SESSION['identificacion']));

} catch (Exception $e){
  echo'connected failed:'.$e->getMessage(); 
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Portal UDC</title>

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body >

  <?php
include_once("headerynav.php");
?>





        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800"> Bienvenido  <?=$_SESSION['nombre']?></h1>
          <p class="mb-4">Los datos ingresados en la encuesta se encuentran registrados acá.
  Si necesita actualizar algun dato presione el botón con cuyo nombre.</p>


 

<a href="editar.php" class="btn btn-outline-secondary" style="margin: 0.5em;"> Actualizar </a>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Tus Datos</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead  style="background-color:#244ec9; ">

                    <tr>
                      <th  style="color: white">Datos</th>
                     
                      <th  style="color: white">Registros</th>                    
                    </tr>
                    
                  </thead>

                  <tbody>
                  <?php
 

 $rows=$stm->fetchAll(PDO::FETCH_OBJ);
 foreach($rows as $row){
  $row->identificacion; 
  $row->nombre;
  $row->apellido;
  $row->email;
  $row->telefono;
  $row->direccion;
  $row->actividaddelpapa;
  $row->actividaddelamama;
  $row->estadocivil;
  $row->genero;
  $row->nacimiento;
  $row->nivelacademico_papa;
  $row->nivelacademico_mama;
  $row->tipodeinstitucion;
  $row->tipodevivienda;
  $row->region;
  $row->carrera;
  $row->tiempo_de_graduado;
  $row->id_ingresoeconomico;
  $row->calificatucarrera;
  $row->asignaturas_matriculadas;

  echo "<tr>
      <th >Identificación</th>
    <td>$row->identificacion </td>
    </tr>

    <tr>
      <th >Nombre</th>
      <td>$row->nombre</td> 
    </tr>

    <tr>
      <th >Apellido</th>
      <td>$row->apellido</td>  
    </tr>

    <tr>
      <th >Correo</th>
      <td>$row->email</td>  
    </tr>

    <tr>
      <th >Teléfono</th>
      <td>$row->telefono </td>  
    </tr>

    <tr>
      <th >Dirección</th>
      <td>$row->direccion</td>    
    </tr>

    <tr>
      <th >Fecha de Nacimiento</th>
      <td>$row->nacimiento </td>
    </tr>

    <tr>
      <th >Actividad Económica del Papá</th>
      <td> $row->actividaddelpapa </td>    
    </tr>

    <tr>
      <th scope='row'>Actividad Económica de la Mamá</th>
      <td>$row->actividaddelamama </td>    
    </tr>

    <tr>
      <th scope='row'>Estado Civil</th>
      <td> $row->estadocivil</td>   
    </tr>

     <tr>
      <th scope='row'>Género</th>
      <td>$row->genero </td>   
    </tr>

     <tr>
      <th scope='row'>Nivel acádemico del Papá</th>
      <td>$row->nivelacademico_papa </td>  
    </tr>

     <tr>
      <th scope='row'>Nivel acádemico de la Mamá</th>
      <td> $row->nivelacademico_mama </td>  
    </tr>

     <tr>
      <th scope='row'>Tipo de Institución</th>
      <td>$row->tipodeinstitucion </td>   
    </tr>

    <tr>
      <th scope='row'>Tipo de Vivienda</th>
      <td>$row->tipodevivienda</td>   
    </tr>

    <tr>
      <th >Zona de Residencia</th>
      <td>$row->region</td>   
    </tr>

    <tr>
      <th >Carrera</th>
      <td>$row->carrera</td>   
    </tr>

    <tr>
      <th >Año de graduado de Bachiller</th>
      <td>$row->tiempo_de_graduado</td>   
    </tr>

    <tr>
      <th >Ingreso Económico</th>
      <td>$row->id_ingresoeconomico</td>   
    </tr>

    <tr>
      <th >Calificación de la Carrera</th>
      <td>$row->calificatucarrera</td>   
    </tr>

    <tr>
      <th >Asignaturas Matriculadas</th>
      <td>$row->asignaturas_matriculadas</td>   
    </tr> 

   

  </tbody>
</table> "; } ?>
              </div>
            </div>
          </div>
          
        </div>
      

      
        

    
 



</body>

</html>
