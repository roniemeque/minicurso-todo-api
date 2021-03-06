<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'descricao', 'completa', 'user_id', 'arquivada', 'prioridade'
    ];

    public function tasks(){
        return $this->belongsTo('App\User');
    }
}
