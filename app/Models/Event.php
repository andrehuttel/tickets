<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $table = 'events';
    protected $fillable = ['id', 'company_id', 'name', 'date', 'start_hour', 'place_open_hour', 'description', 
    'description_append', 'image', 'event_map_image', 'category_id', 'category_name', 'group_id', 'group_name',
    'place_id', 'place_name', 'place_address', 'organizer_id', 'organizer_name', 'organizer_logo',
    'fl_show_payment_methods', 'fl_show_organizer', 'fl_show_classification', 'fl_featured', 'classification_text'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}