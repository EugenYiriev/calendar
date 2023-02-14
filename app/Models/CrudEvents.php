<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrudEvents extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'event_name', 
        'event_start', 
        'event_start_time', 
        'event_end_time',
        'event_end'
    ];    
}
