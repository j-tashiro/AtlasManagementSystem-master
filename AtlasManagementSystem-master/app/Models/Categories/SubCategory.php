<?php

namespace App\Models\Categories;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $fillable = [
        'main_category_id',
        'sub_category',
    ];

    // 2023.06.12
    // ->belongsTo 多(sub_categoriesテーブル)対一(main_categoriesテーブル)
    public function mainCategory(){
        return $this->belongsTo(MainCategory::class);
    }

    // 2023.06.12
    // \App\Models\Posts\Post::class,はどのディレクトリを参照してるかを細かく決めてる
    public function posts(){
        return $this->belongsToMany(\App\Models\Posts\Post::class, 'post_sub_categories', 'sub_category_id', 'post_id');
    }
}