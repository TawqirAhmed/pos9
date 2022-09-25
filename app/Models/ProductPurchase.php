<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPurchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_id', 'products', 'total', 'paid', 'due', 'referance', 'purchase_date', 'user_id',
    ];

    protected static function boot()
    {
        parent::boot();

        self::creating(function($model){
            $model->user_id = auth()->id();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function scopeSearch($query,$term)
    {
        $term = "%$term%";
        $query->where(function($query) use ($term)
        {
            $query->where('referance','like',$term)
                    ->orWhereHas('user', function($query) use ($term){
                        $query->where('name','like',$term);
                    })
                    ->orWhereHas('supplier', function($query) use ($term){
                        $query->where('name','like',$term)
                                ->orWhere('code','like',$term);
                    });
        });
    }
}
