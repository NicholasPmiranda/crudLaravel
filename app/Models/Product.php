<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'valor',
        'loja_id',
        'active',
    ];


    public function Store()
    {
        return $this->belongsTo(Store::class);
    }


    public function getValorAttribute($value)
    {
        return 'R$' . $value . ',00';
    }
}
