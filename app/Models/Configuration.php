<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    use HasFactory;

    protected $fillable = [
        'vat', 'company_name', 'address_line_1', 'address_line_2', 'phone', 'logo', 'logo_sm', 'favicon',
    ];

    
}
