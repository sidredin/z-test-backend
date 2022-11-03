<?php
declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Status;
use App\Models\Tender;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
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
                echo "Row $row has been processed\n";

                $row++;
                if ($row == 1) continue;

                $status = Status::where(['title' => $data[2]])->first();
                $updated_at = Carbon::createFromFormat('d.m.Y H:i:s', $data[4]);

                Tender::create([
                    'external_code' => $data[0],
                    'id' => $data[1],
                    'status_id' => $status?->id,
                    'title' => $data[3],
                    'updated_at' => $updated_at,
                ]);
            }
            fclose($handle);
            echo "\n";
            echo "The tenders seeding completed.\n";
            echo "$row rows has been processed\n\n";
        }
    }
}
