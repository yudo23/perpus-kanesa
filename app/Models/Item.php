<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class Item extends Model
{
    use HasFactory, Loggable;
    protected $table = "item";
    protected $guarded = [];

    public function biblio()
    {
        return $this->belongsTo(Biblio::class, 'biblio_id','biblio_id');
    }
}
