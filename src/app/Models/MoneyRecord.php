<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MoneyRecord extends Model
{
    protected $fillable = [
        // 記録の種類
        'type',
        // 金額
        'amount',
        // 記録した日付
        'record_date',
        // メモ
        'note',
        // 受け取ったかどうか
        'is_received',
    ];
}
