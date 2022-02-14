<?php

namespace App\Models;

use App\Models\User;
use App\Models\Variation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Cart extends Model
{
    use HasFactory;

    public static function booted()
    {
        static::creating( function ($model) {
            $model->uuid = (string) Str::uuid();
        } );
    }

    public function user()
    {
        return $this->belongsTo( User::class );
    }

    public function variations()
    {
        return $this->belongsToMany( Variation::class )->withPivot('quantity');
    }
}
