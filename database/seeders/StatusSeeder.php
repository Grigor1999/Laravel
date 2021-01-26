<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Status;
class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            ['id' => 6, 'status' =>'Email + Wiedervorlage'],
            ['id' => 7, 'status' =>'Brief + Wiedervorlage'],
            ['id' => 10, 'status' =>'Wiedervorlage'],
            ['id' => 11, 'status' =>'neu'],
            ['id' => 12, 'status' =>'nicht erreicht'],
            ['id' => 20, 'status' =>'Shooting vereinbart'],
            ['id' => 21, 'status' =>'Shooting abgesagt'],
            ['id' => 22, 'status' =>'Shooting bestätigt'],
            ['id' => 23, 'status' =>'Shooting zurückgewiesen'],
            ['id' => 25, 'status' =>'Objektaufnahme ja'],
            ['id' => 26, 'status' =>'Objektaufnahme offen'],
            ['id' => 27, 'status' =>'Objektaufnahme nein'],
            ['id' => 8, 'status' =>'Termin verschieben'],
            ['id' => 9, 'status' =>'Termin absagen'],
            ['id' => 90, 'status' =>'kein Interesse'],
            ['id' => 91, 'status' =>'Blacklist'],
            ['id' => 92, 'status' =>'kein Interesse (älter 2 Mt.)'],
            ['id' => 95, 'status' =>'Termin abgesagt']
        ];
        foreach($statuses as $item){
            Status::create($item);
        }
    }
}
