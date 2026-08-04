<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Solution extends Model
{
    protected $fillable = ['problem_id', 'title', 'steps', 'notes'];

    public function problem(): BelongsTo
    {
        return $this->belongsTo(Problem::class);
    }

    /**
     * Return the steps text as a clean array of lines, ready for <ol><li>.
     * Handles both real newlines and literal "\r\n" / "\n" text that may
     * have been saved from older input sources, and strips any manual
     * numbering (e.g. "1. ") already present in the text.
     */
    public function getStepsListAttribute(): array
    {
        $raw = $this->steps ?? '';
        $raw = str_replace(['\\r\\n', '\\n', '\\r'], "\n", $raw);

        $lines = preg_split('/\r\n|\r|\n/', trim($raw));
        $lines = array_filter($lines, fn ($line) => trim($line) !== '');

        return array_values(array_map(
            fn ($line) => preg_replace('/^\d+\.\s*/', '', trim($line)),
            $lines
        ));
    }
}
