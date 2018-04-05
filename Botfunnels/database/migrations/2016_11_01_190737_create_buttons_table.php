<?php

use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateButtonsTable extends Migration
{
    /**
     * The name of the database connection to use.
     *
     * @var string
     */
    //protected $connection = 'mongodb';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mongodb')->create('buttons', function(Blueprint $collection)
        {
            $collection->index('type');
            $collection->index('title');
            $collection->index('payload');
            $collection->index('link');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mongodb')->table('buttons', function (Blueprint $collection)
        {
            $collection->dropIndex();
            $collection->drop();
        });
    }
}
