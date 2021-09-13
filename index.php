<?php include 'funciones.php';

$direccion =$_SERVER['REQUEST_URI'];

$optionSelect;
$name;
$federacion;
$action = "index.php";

$provinciaUrl = strpos($direccion, 'ClimaArgentina/');
$departamentosUrl = stripos($direccion, '?ciudad=');
$localidadesUrl = stripos($direccion, '?departamentoseleccionado=');

if($provinciaUrl !== false){
    $name="ciudad";
    $federacion = "provincia";
    $optionSelect = $provincias['provincias'];
}

if($departamentosUrl !== false){
    $name = "departamentoseleccionado";
    $federacion = "departamento";
    $departamentos=selectId($_GET['ciudad'], $provincias);
    $optionSelect = $departamentos['departamentos'];
}

if($localidadesUrl !== false){
    $action = "currentClima.php";
    $name = "localidadseleccionada";
    $federacion = "localidad";
    $localidades = generarLocalidades($_GET['departamentoseleccionado']);
    $optionSelect = $localidades['localidades'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Hojas de estilo -->
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/stylesClima.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">

    <title>Clima en Argentina</title>
</head>

<body>
    <main>
        <article id="titulo" class="background">
            <h1 class="title">CLIMA EN LAS CIUDADES ARGENTINAS</h1>
        </article>
        <section id="seleccionar" class="background size">
            <img id="sol" src="img/sol.png" alt="">
            <form action=<?php echo $action ?> method="get">
                <p>
                    seleccione <?php echo $federacion ?>
                </p>
                <select id="combo-box" name=<?php echo $name ?> class="box">
                    <?php
                        $i = 0;
                        foreach ($optionSelect as $key => $value) {
                            $nombres[$i] = $value["nombre"];
                            $i++;                            
                        }

                        sort($nombres);

                        for($c=0; $c < count($nombres) ; $c++){
                            echo '<option>' . $nombres[$c] . '</option>';
                        }
                    ?>
                </select>
                <input id="submit-btn" type="submit" class="btn">                
            </form>
        </section>
    </main>
</body>
</html>