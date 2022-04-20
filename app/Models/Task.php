<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'description', 'user_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeCompleted(): Collection
    {
        return $this
            ->where([
                'completed' => true,
                'user_id' => auth()->id()
            ])
            ->orderBy('updated_at', 'desc');
    }

    public function scopeUncompleted(): Collection
    {
        return $this
            ->where([
                'completed' => false,
                'user_id' => auth()->id()
            ])
            ->orderBy('updated_at', 'desc');
    }
}
