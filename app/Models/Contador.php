<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Contador extends Model
{
    use HasFactory;

    protected $table = "contadores";

    protected $fillable = [
        'user_id',
        'contador_nome',
        'contador_email',
        'contador_senha'
    ];

    protected $hidden = ['contador_senha'];


    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function cliente(): HasMany {
        return $this->hasMany(Cliente::class, 'contador_id', 'contador_id');
    }
}
