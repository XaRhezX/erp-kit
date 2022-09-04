<?php

use App\Models\Location;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Rap2hpoutre\FastExcel\FastExcel;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->foreignId('id')->unique()->constrained('location_sub_districts');
            $table->string('name');
            $table->integer('created_at')->nullable();
            $table->foreignUuid('created_by')->nullable()->contrained('users');
            $table->integer('updated_at')->nullable();
            $table->foreignUuid('updated_by')->nullable()->contrained('users');
            $table->integer('deleted_at')->nullable();
            $table->foreignUuid('deleted_by')->nullable()->contrained('users');
        });

        //Insert Data
        $path = database_path('csv/zip_codes.csv');
        $data = (new FastExcel())->import($path);
        $data->map(function (array $row) {
            return Arr::only($row, ["id", "name"]);
        })->chunk(1000)->each(function (Collection $chunk) {
            Location::upsert(
                json_decode(json_encode($chunk), true),
                ['id'],
                [
                    'created_at' => now()->timestamp,
                    'updated_at' => now()->timestamp,
                ]
            );
        });

        Artisan::call('make:permission', [
            'name' => 'location'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('locations');
    }
};