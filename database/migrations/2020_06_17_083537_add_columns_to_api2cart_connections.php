<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToApi2cartConnections extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('api2cart_connections', function (Blueprint $table) {
            $table->string('location_id')
                ->after('id')
                ->default('0');
            $table->string('type')
                ->default('')
                ->after('location_id');
            $table->string('url')
                ->default('')
                ->after('type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('api2cart_connections', function (Blueprint $table) {
            $table->dropColumn('location_id');
            $table->dropColumn('url');
            $table->dropColumn('type');
        });
    }
}
