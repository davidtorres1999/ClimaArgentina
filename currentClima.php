<?php

include 'funciones.php';

$localidad = traerLocalidades();

$urlLocation = LatLon($_GET["localidadseleccionada"], $localidad, "localidades");

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

    <title>Clima</title>
</head>

<body>
    <main>
        <article class="background" id="titulo">
            <h2 class="title">Clima en la ciudad de <?php echo $_GET["localidadseleccionada"] ?></h2>
        </article>
        <section id="caract-clima" class="background size">
            <article>
                <figure>
                    <img src=<?php echo $urlLocation->current->weather_icons[0] ?> alt="IMAGEN DESCRIPTIVA">
                    <figcaption>
                        <?php echo $urlLocation->current->weather_descriptions[0] ?>
                    </figcaption>
                </figure>
            </article>
            <article id="descripcion">
                <ul>
                    <li><?php echo "Temperatura: " . $urlLocation->current->temperature . " °C" ?></li>
                    <li><?php echo "Precipitaciones: " . $urlLocation->current->precip . " mm" ?></li>
                    <li><?php echo "Velocidad del viento: " . $urlLocation->current->wind_speed . " Km/h con dirección " . $urlLocation->current->wind_dir ?></li>
                </ul>
            </article>
            <a href="index.php">
                <button id="volver">
                    SELECCIONAR OTRA CIUDAD
                </button>
            </a>
        </section>
    </main>
</body>
</html>