<?php
declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenders', function (Blueprint $table) {
            $table->string('id')->unique(); // в качестве id решил использовать колонку "Номер" из test_task_data.csv
            $table->bigInteger('external_code');
            $table->foreignId('status_id')->nullable()->constrained()->onDelete('set null');
            $table->string('name');
            $table->timestamp('date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tenders');
    }
};
