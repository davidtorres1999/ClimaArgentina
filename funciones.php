
<?php

    //Listar todas las provincias de la Republica Argentina.

    $endpointprovincias = file_get_contents('https://apis.datos.gob.ar/georef/api/provincias?');

    $provincias = json_decode($endpointprovincias, true);

    //Listar los departamentos dentro de cada provincia donde $idPcia es el id de la provincia

    function apiDepartamentos($idPcia)
    {
        $endpointdepartamentos = file_get_contents('https://apis.datos.gob.ar/georef/api/departamentos?provincia=' . $idPcia . '&max=50');

        return $endpointdepartamentos;
    }

    //Devuelve el clima actual de la ubicación geografica seleccionada.

    function apiClima($cityLat, $cityLon)
    {

        $apiKey = "fb5f520e55cf22d2a90a71f99724a301";

        $endpointclima = file_get_contents("http://api.weatherstack.com/current?access_key=" . $apiKey . "&query=$cityLat,$cityLon");

        return $endpointclima;
    }
    
    //lista las localidades dentro del departamento seleccionado por su id.

    function apiLocaidades($departamento)
    {

        $endpoint = file_get_contents("https://apis.datos.gob.ar/georef/api/localidades?departamento=" . $departamento . "&max=1000");

        $localidadesDpto = json_decode($endpoint, true);

        return $localidadesDpto;
    }

    //lista la localidad determinada por el $idLoc

    function seleccionarLocalidad($idLoc){

        $endpoint = "https://apis.datos.gob.ar/georef/api/localidades?id=". $idLoc;

        $localidadSeleccionada = json_decode($endpoint);

        return $localidadSeleccionada;

    }

    //Accede a todas las localidades de ARG.

    function traerLocalidades()
    {
        $endpoint = file_get_contents("https://apis.datos.gob.ar/georef/api/localidades?max=4200");

        $localidadesLista = json_decode($endpoint, true);

        return $localidadesLista;
    }

    //Accede a todos los departamentos de ARG

    function traerDepartamentos()
    {
        $endpoint = file_get_contents("https://apis.datos.gob.ar/georef/api/departamentos?max=530");

        $listaTotal = json_decode($endpoint, true);

        return $listaTotal;
    }



    function selectId($ciudad, $provincias)
    {

        foreach ($provincias['provincias'] as $key => $provincia) {
            if ($provincia["nombre"] === $ciudad) {
                $provinciaSeleccionada = $provincia['id'];
            }
        }

        $departamentos = json_decode(apiDepartamentos($provinciaSeleccionada), true);

        return $departamentos;
    }

    /* $nombre es equivalente al nombre de la localidad, departamento o provincia a la que se hace referencia.
        $georafica recibe los datos de endpoint para traer localidades, departamentos o provincias.
        $index recibe un string que indica el nombre del index 'provincias' 'departamentos' 'localidades'*/

    function LatLon($nombre, $geografica, $index)
    {

        foreach ($geografica[$index] as $llave => $ubicacion) {
            if ($ubicacion["nombre"] === $nombre) {
                $datoseleccionado = $ubicacion["centroide"];
            }
        }

        $Lat = $datoseleccionado['lat'];
        $Lon = $datoseleccionado['lon'];

        $urlClima = json_decode(apiClima($Lat, $Lon));

        return $urlClima;
    }

    /* lista las localidades de acuerdo a su departamento */

    function generarLocalidades($departamentoNombre)
    {

        $departamentos = traerDepartamentos();

        foreach ($departamentos["departamentos"] as $llave => $departamento) {
            if ($departamento["nombre"] === $departamentoNombre) {
                $id = $departamento["id"];
            }
        }

        $localidades = apiLocaidades($id);

        return $localidades;
    }

?>