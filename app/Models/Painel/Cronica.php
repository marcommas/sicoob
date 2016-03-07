<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;

class Cronica extends Model
{
    protected $guarded = ['id'];


    static $rules = [
        'cronica' => 'required|max:100',
        'posicao' => 'required|numeric',
        //'caminho_arquivo' => 'image|mimes:jpeg,jpg,png,pdf',
        //'caminho_arquivo' => 'required|',
    ];
    
    public function getCreatedAtAttribute($created_at){
        return \Carbon\Carbon::parse($created_at)->format('d/m/Y H:i:s');
    }
}
