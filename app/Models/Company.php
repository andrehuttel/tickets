<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    
    use HasFactory;
    protected $table = 'company';
    protected $fillable = ['id', 'name', 'cnpj', 'host'];

    public function configs()
    {
        return $this->hasMany(CompanyConfig::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function banners()
    {
        return $this->hasMany(Banner::class);
    }
}
