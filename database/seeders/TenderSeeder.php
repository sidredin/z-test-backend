<?php
declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Status;
use App\Models\Tender;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $row = 0;
        if (($handle = fopen(__DIR__ . "/test_task_data.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000)) !== FALSE) {
                $row++;
                if ($row == 1) continue;
                echo "Row $row has been processed\n";

                $status = Status::where(['title' => $data[2]])->first();
                $date = Carbon::createFromFormat('d.m.Y H:i:s', $data[4]);

                Tender::create([
                    'external_code' => $data[0],
                    'id' => $data[1],
                    'status_id' => $status?->id,
                    'name' => $data[3],
                    'date' => $date,
                ]);
            }
            fclose($handle);
            echo "\n";
            echo "The tenders seeding completed.\n";
        }
    }
}
