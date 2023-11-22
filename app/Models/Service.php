<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name',
        'type', 
        'time',
        'price',
        'description',
        'deleted'
    ];

    protected $rules = [
        'name' => 'required|string',
        'type' => 'required|string',
        'time' => 'required|string',
        'price' => 'required|numeric',
        'description' => 'nullable|string',
    ];

    public function getRules() {
        return $this->rules;
    }

    public function setRules(string $field, string $rule ) {
        $this->rules[$field] = $rule;
        return $this->rules;
    }

}
