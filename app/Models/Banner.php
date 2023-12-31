<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    protected $table = 'banners';
    protected $keyType = 'string';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'company_id', 'image', 'title', 'subtitle', 'link'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
