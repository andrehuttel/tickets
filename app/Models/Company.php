<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    
    use HasFactory;
    protected $table = 'company';
    protected $keyType = 'string';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'name', 'cnpj', 'host'];

    public function configs()
    {
        return $this->hasMany(CompanyConfig::class, 'company_id', 'id')->where('company_id', $this->id);
    }

    public function events()
    {
        return $this->hasMany(Event::class, 'company_id', 'id')->where('company_id', $this->id);
    }

    public function banners()
    {
        return $this->hasMany(Banner::class, 'company_id', 'id')->where('company_id', $this->id);
    }
}
