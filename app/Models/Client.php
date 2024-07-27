<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     
     protected $fillable = [
        'name',
        'email',
        'phone_number',
        'physical_address',
        'contact_person_name',    // Add this line
        'contact_person_phone',   // Add this line
        'contact_person_position', // Add this line
        'contact_person_email',   // Add this line
    ];




}
