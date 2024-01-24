<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{
    use HasFactory, SoftDeletes, HasTranslations;

    protected $fillable = [
        'title',
        'slug',
        'handle',
        'price',
        'attachment',
        'category_id'
    ];

    protected array $translatable = [
        'title',
        'handle'
    ];

    protected $cast = [
        'title' => 'array',
        'handle' => 'array',
        'price' => 'double',
        'slug' => 'string',
        'attachment' => 'string',
        'category' => 'number',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->slug = Str::slug($model->title);
        });
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
