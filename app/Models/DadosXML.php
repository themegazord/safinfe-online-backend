<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DadosXML extends Model
{
    use HasFactory;

    protected $table = 'dados_xml';
    protected $fillable = [
        'xml_id',
        'cliente_id',
        'status',
        'serie',
        'numeronf',
        'dh_emissao',
        'chave',
    ];

    public function cliente(): BelongsTo {
        return $this->belongsTo(Cliente::class ,'cliente_id', 'cliente_id');
    }

    public function xml(): BelongsTo {
        return $this->belongsTo(XML::class, 'xml_id', 'xml_id');
    }
}
