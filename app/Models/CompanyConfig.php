<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyConfig extends Model
{
    use HasFactory;
    protected $table = 'company_configs';
    protected $fillable = ['id', 'company_id', 'key', 'value'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
