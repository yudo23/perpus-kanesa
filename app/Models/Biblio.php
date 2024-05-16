<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class Biblio extends Model
{
    use HasFactory, Loggable;
    protected $table = "biblio";
    protected $primaryKey = 'biblio_id';
    public $timestamps = false;
    protected $guarded = [];

    public function items()
    {
        return $this->hasMany(Item::class, 'biblio_id','biblio_id');
    }

    public function publisher()
    {
        return $this->belongsTo(Publisher::class, 'publisher_id','publisher_id');
    }
}
