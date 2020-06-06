<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $fillable = ['name', 'initials', 'country_id'];


    /**
     * RETORNA O PAÍS DE UM ESTADO
     */
    public function country()
    {
        return $this->belongsTo(Country::class);

        // 1 - Chave estrangeira da classe ATUAL = STATE
        // 2 - Chave primária da classe passada no construtor = PAÍS
        //return $this->belongsTo(Country::class, 'country_id', 'id');
    }
    
    /**
     * RETORNA AS CIDADES DE UM ESTADO
     */
    public function cities()
    {
        return $this->hasMany(City::class);
    }
    
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}