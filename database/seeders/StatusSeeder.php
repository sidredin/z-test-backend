<?php
declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    private array $statuses = [
        ['id' => 1, 'title' => 'Открыто',],
        ['id' => 2, 'title' => 'Закрыто',],
        ['id' => 3, 'title' => 'Отменено',],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->statuses as $status) {

            $current_timestamp = date('Y-m-d H:i:s');

            DB::table('statuses')->insert([
                'id' => $status['id'],
                'title' => $status['title'],
            ]);
        }
    }
}
