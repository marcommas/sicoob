<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;

class Cronica extends Model
{
    protected $guarded = ['id'];


    static $rules = [
        'cronica' => 'required|max:100',
        'posicao' => 'required',
        'caminho_arquivo' => 'max:500',
    ];
    
    public function getCreatedAtAttribute($created_at){
        return \Carbon\Carbon::parse($created_at)->format('d/m/Y H:i:s');
    }
}
