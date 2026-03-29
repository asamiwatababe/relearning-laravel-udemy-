<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Chore;

class ChoreSeeder extends Seeder
{
    public function run(): void
    {
        $chores = [
            ['category' => 'お部屋・身の回り', 'name' => 'リビングを片づける', 'points' => 1],
            ['category' => 'お部屋・身の回り', 'name' => '学校の準備をする', 'points' => 1],
            ['category' => 'お部屋・身の回り', 'name' => '本を棚に戻す', 'points' => 1],
            ['category' => 'お部屋・身の回り', 'name' => '布団を整える', 'points' => 1],
            ['category' => 'お部屋・身の回り', 'name' => '靴をそろえる', 'points' => 1],

            ['category' => '洗濯', 'name' => '洗濯後、洗濯かごに入れる', 'points' => 1],
            ['category' => '洗濯', 'name' => '洗濯ばさみに干す', 'points' => 1],
            ['category' => '洗濯', 'name' => '洗濯物をたたむ、しまう', 'points' => 1],

            ['category' => '食事の準備・片づけ', 'name' => 'テーブルをふく', 'points' => 1],
            ['category' => '食事の準備・片づけ', 'name' => '食器を並べる', 'points' => 1],
            ['category' => '食事の準備・片づけ', 'name' => '食器を片付ける', 'points' => 1],
            ['category' => '食事の準備・片づけ', 'name' => '料理を運ぶ', 'points' => 1],
            ['category' => '食事の準備・片づけ', 'name' => '食器洗いを手伝う', 'points' => 1],

            ['category' => '料理のお手伝い', 'name' => '料理のお手伝い', 'points' => 1],

            ['category' => '掃除', 'name' => '一階の雑巾がけをする', 'points' => 1],
            ['category' => '掃除', 'name' => 'トイレ掃除を手伝う', 'points' => 1],
            ['category' => '掃除', 'name' => 'お風呂掃除を手伝う', 'points' => 1],
            ['category' => '掃除', 'name' => '階段掃除を手伝う', 'points' => 1],
            ['category' => '掃除', 'name' => 'キッチン掃除を手伝う', 'points' => 1],
            ['category' => '掃除', 'name' => '掃除機をかける', 'points' => 1],

            ['category' => 'お世話・その他', 'name' => '買い物袋を運ぶ', 'points' => 1],
            ['category' => 'お世話・その他', 'name' => 'マッサージ', 'points' => 1],
        ];

        foreach ($chores as $chore) {
            Chore::firstOrCreate(
                ['name' => $chore['name']],
                $chore
            );
        }
    }
}
