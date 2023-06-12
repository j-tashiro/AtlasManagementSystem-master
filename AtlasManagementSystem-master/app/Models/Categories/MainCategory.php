<?php

namespace App\Models\Categories;

use Illuminate\Database\Eloquent\Model;

class MainCategory extends Model
{
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $fillable = [
        'main_category'
    ];

    // 2023.06.12
    // ->hasMany 一(main_categoriesテーブル)対多(sub_categoriesテーブル)
    public function subCategories(){
        return $this->hasMany(SubCategory::class);
    }

}