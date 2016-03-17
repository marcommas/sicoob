<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;

class Relatorio extends Model {

    protected $guarded = ['id'];
    static $rulesRelatorio = [
        //'dataInicial' => 'date|date_format:Y-m-d|before:dataFinal',
        //'dataFinal' => 'date|date_format:Y-m-d|after:dataInicial',
        'dataInicial' => 'date|date_format:Y-m-d',
        'dataFinal' => 'date|date_format:Y-m-d',
    ];

    static function total($id_usuario, $id_cronica, $dataInicial, $dataFinal) {

        return Relatorio::where(function ($query) use ($id_usuario, $id_cronica, $dataInicial, $dataFinal) {
                            if ($id_usuario <> 0) {
                                $query->where("id_usuario", '=', $id_usuario);
                            }
                            if ($id_cronica <> 0) {
                                $query->where("id_cronica", '=', $id_cronica);
                            }
                            if ($dataInicial <> "") {
                                $query->whereDate("created_at", '>=', $dataInicial);
                                $query->whereDate("created_at", '<=', $dataFinal);
                                //$query->whereBetween('created_at', [$dataInicial, $dataFinal]);
                            }
                        })
                        ->count();

    }
    


}
