<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tender extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'external_code',
        'status_id',
        'name',
        'date',
    ];

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }
}
