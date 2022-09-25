<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'description', 'name', 'sku', 'buy', 'sell', 'discount', 'new', 'out', 'stock', 'user_id', 'image',
    ];

    protected static function boot()
    {
        parent::boot();

        self::creating(function($model){
            $model->user_id = auth()->id();
        });
    }


    public function scopeSearch($query,$term)
    {
        $term = "%$term%";
        $query->where(function($query) use ($term)
        {
            $query->where('name','like',$term)
                    ->orWhere('sku','like',$term)
                    ->orWhereHas('user', function($query) use ($term){
                        $query->where('name','like',$term);
                    });
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
