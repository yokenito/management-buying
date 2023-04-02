<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Person;

class PeopleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $people = [
            '佐藤','鈴木','高橋','田中','伊藤',
            '渡辺','山本','中村','小林','加藤'
        ];
        $i = 1;

        foreach($people as $person){
            Person::create([
                'person_number' => 102300+$i,
                'person_name' => $person,
            ]);
            $i++;
        }
    }
}
