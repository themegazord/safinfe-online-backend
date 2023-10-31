<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class XMLEventos extends Model
{
    use HasFactory;

    protected $table = 'xml_eventos';

    protected $fillable = [
        'xml_id',
        'justificativa'
    ];

    public function xml(): BelongsTo {
        return $this->belongsTo(XML::class, 'xml_id', 'xml_id');
    }
}
