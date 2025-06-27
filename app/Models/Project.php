<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Scout\Searchable;

class Project extends Model
{
    use HasFactory, Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'titulo',
        'autor',
        'correo_autor',
        'familia_profesional',
        'ciclo_formativo',
        'resumen',
        'curso_academico',
        'palabras_clave',
        'area_tematica',
        'enlace_recursos',
        'comentarios_profesor',
        'enrollment_id',
        'teacher_id',
        'enrollment_user_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'enrollment_id' => 'integer',
        'teacher_id' => 'integer',
        'enrollment_user_id' => 'integer',
    ];

    /**
     * Get the enrollment user related to the projects.
     */
    public function enrollmentUser(): BelongsTo
    {
        return $this->belongsTo(EnrollmentUser::class);
    }

    /**
     * Get the enrollment related to the projects.
     */
    public function enrollment(): BelongsTo
    {
        return $this->belongsTo(Enrollment::class);
    }

    /**
     * Get the teacher (user) related to the projects.
     */
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
