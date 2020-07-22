<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class CheckController extends Controller
{
    public function api(){
        $url = storage_path('app/public/prueba/1.py');
        // $url = "https://www.aqpdevs.com/backup/alumnos/1.py";
        //call api
        $json = file_get_contents($url);
        $json = json_decode($json);
        //$lat = $json->results[0]->geometry->location->lat;
        //$lng = $json->results[0]->geometry->location->lng;
        //echo "Latitude: " . $lat . ", Longitude: " . $lng;
        //echo $json->results[0]->productos->codigo;
        echo var_dump($json);
    }
}
?>