<?php

use App\Models\Specialization;
use Illuminate\Support\Collection;

$specializations_db = Specialization::all()->pluck('name', 'id');

Collection::macro('normalize', fn ()=> $this->map(fn ($value)=>strtoupper(iconv("UTF-8", "ASCII//TRANSLIT", $value))));

$specializations_db->normalize();

