<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'naziv',
        'opis'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function photos(){
        return $this->hasMany(Photo::class);
    }

    // public static function searchNaziv($term=''){
    //     return self::where('naziv','LIKE',"%$term%");
    // }

    // public static function searchOpis($opis=''){
    //     return self::where('opis','LIKE',"%$opis%");
    // }
}
