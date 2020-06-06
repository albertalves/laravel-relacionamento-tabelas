<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Location;
use App\Models\State;

class Country extends Model
{
    protected $fillable = ['name'];
    
    /**
     * 1-1
     * Retorna altitude e longitude que se encontra na tabela location
     */
    public function location()
    {
        // verifico o qual país pertencente a esta localização
        // não passo chave nenhuma pois a nomenclatura delas atende ao padrão do laravel
        return $this->hasOne(Location::class); //country_id, id
    

        // supondo que o nome das chaves não estejam no padrão do laravel
        // nesse caso é obrigatório o uso das chaves das tabelas relacionadas como paramêmetro 

        //return $this->hasOne(Location::class, 'country_id', 'id_country');
    }
    
    /**
     * 
     * Método que retorna os estados de um país
     * NOMENCLATURA PADRÃO: Sempre no plural
     */
    public function states()
    {
        return $this->hasMany(State::class);


        // CHAVE ESTRANGEIRA DE STATE, CHAVE PRIMÁRIA DE COUNTRY
        //return $this->hasMany(State::class, 'country_id', 'id');
    }
    
    public function cities()
    {
        return $this->hasManyThrough(City::class, State::class);
    }
    
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}