<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;

class Cronica extends Model
{
    protected $guarded = ['id'];


    static $rules = [
        'cronica' => 'required|max:100',
        'posicao' => 'required|integer|unique:cronicas',
        //'caminho_arquivo' => 'image|mimes:jpeg,jpg,png,pdf',
        'caminho_arquivo' => 'required|mimes:pdf|max:5000',
    ];
    
    static $rulesUpdate = [
        'cronica' => 'required|max:100',
        'posicao' => 'required|integer',
        //'caminho_arquivo' => 'image|mimes:jpeg,jpg,png,pdf',
        'caminho_arquivo' => 'mimes:pdf|max:5000',
    ];
    
    public function getCreatedAtAttribute($created_at){
        return \Carbon\Carbon::parse($created_at)->format('d/m/Y H:i:s');
    }
}
