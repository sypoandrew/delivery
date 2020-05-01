<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSypoBondedWarehouseAddress extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sypo_bonded_warehouse_address', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('first')->nullable();
            $table->string('last')->nullable();
            $table->string('line1')->nullable();
            $table->string('line2')->nullable();
            $table->string('city')->nullable();
            $table->string('county')->nullable();
            $table->string('postcode')->nullable();
            $table->char('country_code', 2)->nullable();
            $table->string('model')->nullable()->default('BOND-15');
            $table->boolean('is_tbc')->default(false);
            $table->timestamps();
            
            $table->index('country_code');
			$table->foreign('country_code')->references('code')->on('countries');
        });

        \DB::table('sypo_bonded_warehouse_address')->insert(array('name' => 'Store with VinQuinn)', 'country_code' =>'GB', 'model' => '', 'created_at' => \Carbon\Carbon::now()));
        \DB::table('sypo_bonded_warehouse_address')->insert(array('name' => 'LCB Tilbury', 'first' => 'LCB', 'last' => 'Tilbury', 'line1' => '29-30 Berths', 'line2' => 'Tilbury Freeport', 'city' => 'Tilbury', 'county' => 'Essex', 'postcode' => 'RM18 7EH', 'country_code' =>'GB', 'model' => 'BOND-10', 'created_at' => \Carbon\Carbon::now()));
        \DB::table('sypo_bonded_warehouse_address')->insert(array('name' => 'LCB Vinotheque', 'first' => 'LCB', 'last' => 'Vinotheque', 'line1' => 'Derby Road', 'line2' => '', 'city' => 'Burton-Upon-Trent', 'county' => 'Staffordshire', 'postcode' => 'DE14 1RY', 'country_code' =>'GB', 'model' => 'BOND-10', 'created_at' => \Carbon\Carbon::now()));
        \DB::table('sypo_bonded_warehouse_address')->insert(array('name' => 'LCB Dinton Woods', 'first' => 'LCB', 'last' => 'Dinton Woods', 'line1' => 'Catherine Ford Lane', 'line2' => '', 'city' => 'Salisbury', 'county' => 'Wiltshire', 'postcode' => 'SP3 5HB', 'country_code' =>'GB', 'model' => 'BOND-10', 'created_at' => \Carbon\Carbon::now()));
        \DB::table('sypo_bonded_warehouse_address')->insert(array('name' => 'Cert Octavian', 'first' => 'Cert', 'last' => 'Octavian', 'line1' => 'Eastlays Warehouse', 'line2' => 'Gastard', 'city' => 'Corsham', 'county' => 'Wiltshire', 'postcode' => 'SN13 9PP', 'country_code' =>'GB', 'created_at' => \Carbon\Carbon::now()));
        \DB::table('sypo_bonded_warehouse_address')->insert(array('name' => 'EHD Sunbury', 'first' => 'EHD', 'last' => 'Sunbury', 'line1' => 'EHD London No.1 Bond Limited, Unit E Dolphin Estate', 'line2' => 'Windmill Road', 'city' => 'Sunbury On Thames', 'county' => 'Middlesex', 'postcode' => 'TW16 7HE', 'country_code' =>'GB', 'created_at' => \Carbon\Carbon::now()));
        \DB::table('sypo_bonded_warehouse_address')->insert(array('name' => 'EHD Chilmark', 'first' => 'EHD', 'last' => 'Chilmark', 'line1' => 'EHD London No.1 Bond Ltd', 'line2' => 'Fonthill Estate Vaults, Ladydown', 'city' => 'Chilmark', 'county' => 'Salisbury', 'postcode' => 'SP3 5FA', 'country_code' =>'GB', 'created_at' => \Carbon\Carbon::now()));
        \DB::table('sypo_bonded_warehouse_address')->insert(array('name' => 'Seabrook Exports', 'first' => 'Seabrook', 'last' => 'Exports', 'line1' => 'Welbeck Wharf, Unit 17', 'line2' => '8 River Road', 'city' => 'Barking', 'county' => 'Essex', 'postcode' => 'IG11 0JE', 'country_code' =>'GB', 'created_at' => \Carbon\Carbon::now()));
        \DB::table('sypo_bonded_warehouse_address')->insert(array('name' => 'Berry Bros. & Rudd', 'first' => 'Berry', 'last' => 'Bros. & Rudd', 'line1' => 'Basingstoke No. 6 Bond', 'line2' => '', 'city' => 'Hamilton Close', 'county' => '', 'postcode' => 'RG21 6YB', 'country_code' =>'GB', 'created_at' => \Carbon\Carbon::now()));
        \DB::table('sypo_bonded_warehouse_address')->insert(array('name' => 'Seckford Wines', 'first' => 'Seckford', 'last' => 'Wines', 'line1' => 'Dock Lane', 'line2' => '', 'city' => 'Melton', 'county' => 'Suffolk', 'postcode' => 'IP12 1PE', 'country_code' =>'GB', 'created_at' => \Carbon\Carbon::now()));
        \DB::table('sypo_bonded_warehouse_address')->insert(array('name' => 'Other bonded warehouse', 'model' => '', 'is_tbc' => true, 'created_at' => \Carbon\Carbon::now()));

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sypo_bonded_warehouse_address');
    }
}
