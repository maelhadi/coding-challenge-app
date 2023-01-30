<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'parent_id'];

    public function parent(): ?BelongsTo
    {
        return $this->belongsTo(self::class);
    }

    public function children(): ?HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function products(): ?BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}
