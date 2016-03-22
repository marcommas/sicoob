<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;

class Cronica extends Model
{
    protected $guarded = ['id'];


    static $rules = [
        'cronica' => 'required|max:100',
        'posicao' => 'required|integer|between:1,1000|unique:cronicas',
        //'caminho_arquivo' => 'image|mimes:jpeg,jpg,png,pdf',
        'caminho_arquivo' => 'required|mimes:pdf|max:5000',
    ];
       
    public function getCreatedAtAttribute($created_at){
        return \Carbon\Carbon::parse($created_at)->format('d/m/Y H:i:s');
    }
    
    
    static function cronicaAtual($id_cronica) {
 
        return Cronica::where(function ($query) use ($id_cronica){
            $query->where('id', '=', $id_cronica);
        })->get();  

    }
    
    
    static function idProximaCronica($posicaoCronica) {
        
        //Pega o maior id ativo que tem na sequencia de cronicas
        $maxPosicaoCronica = Cronica::where('ativo', 1)->max('posicao');

        return Cronica::where(function ($query) use ($posicaoCronica, $maxPosicaoCronica){
            $query->where('ativo', '=', 1);

            if ($maxPosicaoCronica <> $posicaoCronica) {
                 $query->where('posicao', '>', $posicaoCronica);
            }

        })->orderBy('posicao','asc')->first(['id']);
    }
    
    
}
