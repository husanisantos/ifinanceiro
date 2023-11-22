<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'placa',
        'marca',
        'modelo', 
        'versao',
        'ano',
        'quilometragem',
        'deleted'
    ];

    protected $rules = [
        'placa' => 'required|string',
        'marca' => 'required|string',
        'modelo'=> 'required|string',
        'versao'=> 'nullable|string',
        'ano'   => 'required|string',
        'quilometragem' => 'nullable|string'
    ];

    public function getRules() {
        return $this->rules;
    }

    public function setRules(string $field, string $rule ) {
        $this->rules[$field] = $rule;
        return $this->rules;
    }
}
