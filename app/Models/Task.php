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
        return $this
            ->where([
                'completed' => true,
                'user_id' => auth()->user()->id
            ])
            ->orderBy('updated_at', 'desc');
    }

    public function scopeUncompleted()
    {
        return $this
            ->where([
                'completed' => false,
                'user_id' => auth()->user()->id
            ])
            ->orderBy('updated_at', 'desc');
    }
}
