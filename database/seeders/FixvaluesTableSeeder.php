<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Fixvalue;

class FixvaluesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contents = [
            '自社名' => 'サンプル会社株式会社','自社郵便番号' => '464-0000',
            '自社住所' =>'東京都千種区鏡池通3-10 クレストビル3F',
            '自社電話番号' => '090-6300-5002'
        ];

        foreach($contents as $key => $value){
            Fixvalue::create([
                'content' => $key,
                'fixvalue' => $value,
            ]);
        }
    }
}
