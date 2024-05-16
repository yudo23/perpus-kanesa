<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\FormatDates;

class Contact extends Model
{
    use HasFactory,SoftDeletes,FormatDates;
    protected $table = "contacts";
    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
    ];
}
