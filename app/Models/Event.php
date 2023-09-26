<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $table = 'events';
    protected $keyType = 'string';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'company_id', 'name', 'date', 'start_hour', 'place_open_hour', 'description', 
    'description_append', 'image', 'event_map_image', 'category_id', 'category_name', 'group_id', 'group_name',
    'place_id', 'place_name', 'place_address', 'organizer_id', 'organizer_name', 'organizer_logo',
    'fl_show_payment_methods', 'fl_show_organizer', 'fl_show_classification', 'fl_featured', 'classification_text', 'uri', 'meta_title', 'meta_description'];

    public function getStartHourAttribute($value)
    {
        return Carbon::createFromFormat('H:i:s', $value)->format('H:i');
    }

    public function getPlaceOpenHourAttribute($value)
    {
        return Carbon::createFromFormat('H:i:s', $value)->format('H:i');
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}