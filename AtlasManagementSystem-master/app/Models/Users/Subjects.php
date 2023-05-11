<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;

use App\Models\Users\User;

class Subjects extends Model
{
    const UPDATED_AT = null;


    protected $fillable = [
        'subject'
    ];

    // 2023.05.11 リレーション
    // Subjects.php=subjectsテーブル 関係するモデル(テーブル)のidを第三引数に記載
    // 第三引数 subject_id
    // 第四引数は連結させる相手のモデル(テーブル)のidを第四引数に記載
    // 第四引数 user_id
    public function users(){
        return $this->belongsToMany(User::class, 'subject_users', 'subject_id', 'user_id');
    }
}