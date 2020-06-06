<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Location;

class OneToOneController extends Controller
{
    /**
     *  1:1 = RETORNA UMA ALTITUDE E LONGETUDE DE UM PAÍS PELO NOME OU ID DO PAÍS
     * 
     * TABELAS:
     * País         = Nome
     * Localização  = Altitude e longitude
     */
    public function oneToOne()
    {
        // filtrando pelo nome
        //$country = Country::where('name', 'China')->get()->first();

        // filtrando pelo id
        $country = Country::find(1);
        echo $country->name;
        
        // chamando a função location como propriedade
        $location = $country->location; 

        // chamando a função location como método, dessa forma pode-se aplicar algum filtro
        //$location = $country->location()->where()->get()->first();
        echo "<hr>Latitude: {$location->latitude}<br>";
        echo "Longitude: {$location->longitude}<br>";
    }





    /**
     * RETORNA PAÍS ATRAVÉS DA ALTITUDE E LONGETUDE
     * 
     * TABELAS:
     * País         = Nome
     * Localização  = Altitude e longitude
     */
    public function oneToOneInverse()
    {
        $latitude = 111;
        $longitude = 111;
        
        $location = Location::where('latitude', $latitude)
                                ->where('longitude', $longitude)
                                ->get()
                                ->first();
        
        $country = $location->country()->get()->first();
        echo $country->name;
    }




    /**
     * 
     */
    public function oneToOneInsert()
    {
        $dataForm = [
            'name' => 'França',
            'latitude' => '43',
            'longitude' => '34',
        ];
        
        // criando o país
        $country = Country::create($dataForm);

        // recuperando um país específico
        // $country = Country::where('name', 'França')->get()->first();
        


        // isso é um resumo para o código comentado a baixo
        $location = $country->location()->create($dataForm);
        var_dump($location);
        /*
        $location = new Location;
        $location->latitude = $dataForm['latitude'];
        $location->longitude = $dataForm['longitude'];
        $location->country_id = $country->id;
        $saveLocation = $location->save();
         * 
         */
    }
}