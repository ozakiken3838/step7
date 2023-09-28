<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'price',
        'stock',
        'company_id',
        'comment',
        'img_path',
    ];

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public static function createProduct($data)
    {
            $product = self::create([
                'product_name' => $data['product_name'],
                'company_id' => $data['company_id'],
                'price' => $data['price'],
                'stock' => $data['stock'],
                'comment' => $data['comment'],
            ]);

            if (isset($data['img_path'])) {
                $image = $data['img_path'];
                $filename = Str::random(20) . '.' . $image->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('products', $image, $filename);
                $product->img_path = '/storage/products/' . $filename;
                $product->save();
            }

            return $product;
    }

    public function updateProduct($data)
    {
            $this->product_name = $data['product_name'];
            $this->company_id = $data['company_id'];
            $this->price = $data['price'];
            $this->stock = $data['stock'];
            $this->comment = $data['comment'];
            $this->save();

            if (isset($data['img_path'])) {
                $image = $data['img_path'];
                $filename = Str::random(20) . '.' . $image->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('products', $image, $filename);
                $this->img_path = '/storage/products/' . $filename;
                $this->save();
            }

            return $this;
    }
}
