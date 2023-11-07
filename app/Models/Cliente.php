<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'contador_id',
        'cliente_nome',
        'cliente_cpf_cnpj',
        'cliente_email',
        'cliente_senha'
    ];

    protected $hidden = [
        'cliente_senha'
    ];

    public function contador(): BelongsTo {
        return $this->belongsTo(Contador::class, 'contador_id', 'contador_id');
    }

    public function dadosXML(): HasOne {
        return $this->hasOne(DadosXML::class, 'cliente_id', 'cliente_id');
    }
}
