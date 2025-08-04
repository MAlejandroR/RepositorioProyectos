<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Family extends Model
{
    /** @use HasFactory<\Database\Factories\FamilyFactory> */
    use HasFactory;
    protected $fillable = ["name","color","dapartament_name"];

    public function cycles():HasMany{
         return $this->hasMany(Cycle::class);
    }
    public function specializations():HasMany{
        return $this->hasMany(Specialization::class);
    }
}
