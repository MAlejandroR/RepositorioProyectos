<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Specialization extends Model
{
    /** @use HasFactory<\Database\Factories\SpecializationsFactory> */
    use HasFactory;
    protected $fillable=["name", "families_id"];

    //la familia de una especialidad
    public function family() :BelongsTo{
     return    $this->belongsTo(Family::class,"families_id");
    }

    public function users():hasMany{
       return $this->hasMany("App\Models\User");
    }
}
