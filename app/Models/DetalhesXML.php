<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetalhesXML extends Model
{
    use HasFactory;

    protected $table = 'detalhes_xml';

    protected $fillable = [
        'xml_id',
        'ide',
        'emit',
        'dest',
        'retirada',
        'entrega',
        'autXML',
        'det',
        'total',
        'transp',
        'cobr',
        'pag',
        'infIntermed',
        'infAdic',
        'exporta',
        'compra',
        'cana',
    ];

    public function xml(): BelongsTo {
        return $this->belongsTo(XML::class, 'xml_id', 'xml_id');
    }
}
