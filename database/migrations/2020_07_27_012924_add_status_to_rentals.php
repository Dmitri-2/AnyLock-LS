<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToRentals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('locker_rentals', function (Blueprint $table) {
            $table->enum('status', ['pending', 'active', 'checked-out', 'abandoned', 'cancelled'])->after('end_date')->default('pending');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('locker_rentals', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
