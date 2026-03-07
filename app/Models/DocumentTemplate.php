<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentTemplate extends Model
{
    protected $fillable = ['name', 'content'];

    public function getContentWithHeaderAttribute(): string
    {
        $headerHtml = view('documents.partials.header')->render();
        return $headerHtml . (string) ($this->content ?? '');
    }
}
