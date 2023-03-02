<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gun extends Model
{
    protected $guarded=[];

    public function scopeSearch($query, $terms) {
        collect(explode(" ", $terms))->filter()
        ->each(function ($term) use ($query) {
            $term = '%' . $term . '%';

            $query->where('model', 'like', $term)
            ->orWhere('type', 'like', $term)
            ->orWhere('caliber', 'like', $term)
            ->orWhere('country', 'like', $term);
        });
    }

    use HasFactory;
}
