<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\State;

class OneToManyController extends Controller
{
    /**
     * MÉTODO QUE RETORNA UM PAÍS E SEUS ESTADOS
     * 
     * 1:N = Um país possui muitos estados.
     * 
     * TABELAS:
     * País
     * Estado
     */
    public function oneToMany()
    {
        // O que foi enviado no form
        $keySearch = 'a';

        // Busca o(os) país(es) a partir do que foi enviado no form
        $countries = Country::where('name', 'LIKE', "%{$keySearch}%")
        // 'states' é MÉTODO de relacionamento que trás os estados do país. 
        ->with('states')
        ->get();
        
        foreach($countries as $country) {
            echo "<b>{$country->name}</b>";
        
            $states = $country->states;

            foreach ($states as $state) {
                echo "<br>{$state->initials} - {$state->name}";
            }
            
            echo '<hr>';
        }
    }
    
    /**
     * MÉTODO QUE RECUPERA O PAÍS A PARTIR DE UM ESTADO
     * 
     * N:1 = Muitos estados possuem um país.
     * 
     * TABELAS:
     * País
     * Estado
     */
    public function manyToOne()
    {
        $stateName = 'Pequin';
        // recupera o estado
        $state = State::where('name', $stateName)->get()->first();
        echo "<b>{$state->name}</b>";
        
        // a partir do estado, pesquisa o seu país.
        $country = $state->country;
        echo "<br>País: {$country->name}";
    }
    
    
    public function oneToManyTwo()
    {
        //$country = Country::where('name', 'Brasil')->get()->first();
        $keySearch = 'a';
        $countries = Country::where('name', 'LIKE', "%{$keySearch}%")->with('states')->get();
        
        foreach($countries as $country) {
            echo "<b>{$country->name}</b>";
        
            $states = $country->states;

            foreach ($states as $state) {
                echo "<br>{$state->initials} - {$state->name}:";
                
                foreach($state->cities as $city) {
                    echo " {$city->name}, ";
                }
            }
            
            echo '<hr>';
        }
    }
    
    
    public function oneToManyInsert()
    {
        $dataForm = [
            'name'      => 'Bahia',
            'initials'  => 'BA',
        ];
        
        $country = Country::find(1);
        
        $insertState = $country->states()->create($dataForm);      
        var_dump($insertState->name);;
    }
    
    public function oneToManyInsertTwo()
    {
        $dataForm = [
            'name'      => 'Bahia',
            'initials'  => 'BA',
            'country_id' => '1',
        ];
        
        $insertState = State::create($dataForm);      
        var_dump($insertState->name);;
    }
    
    public function hasManyThrough()
    {
        $country = Country::find(1);
        echo "<b>{$country->name}:</b> <br>";
        
        $cities = $country->cities;
        
        foreach ($cities as $city) {
            echo " {$city->name}, ";
        }
        echo "<br>Total Cidades: {$cities->count()}";
    }
}