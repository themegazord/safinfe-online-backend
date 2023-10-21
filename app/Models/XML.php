<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class XML extends Model
{
    use HasFactory;

    protected $table = "xml";

    protected $fillable = [
        'xml',
    ];

    public function dadosXML(): HasOne {
        return $this->hasOne(DadosXML::class, 'xml_id', 'xml_id');
    }

    public function detalhesXML(): HasOne {
        return $this->hasOne(DetalhesXML::class, 'xml_id', 'xml_id');
    }
}
