<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  protected $fillable = ['name', 'description', 'price', 'user_id', 'brand_id', 'category_id'];

	public function colors()
	{
		return $this->belongsToMany(Color::class)->withTimestamps();
	}

	public function category()
	{
		return $this->belongsTo(Category::class);
	}

	public function brand()
	{
		return $this->belongsTo(Brand::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
