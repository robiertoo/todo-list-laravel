<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'description', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeCompleted()
    {
        return auth()->user()
            ->tasks
            ->where('completed', true)
            ->sortByDesc('updated_at');
    }

    public function scopeUncompleted()
    {
        return auth()->user()
            ->tasks
            ->where('completed', false);
    }
}
