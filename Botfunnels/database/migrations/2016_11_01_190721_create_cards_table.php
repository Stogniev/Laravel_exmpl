<?php

use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardsTable extends Migration
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
        Schema::connection('mongodb')->create('cards', function(Blueprint $collection)
        {
            $collection->index('type');
            $collection->index('position');
            $collection->index('text');
            $collection->index('title');
            $collection->index('description');
            $collection->index('url');

            $collection->collection('buttons');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mongodb')->table('cards', function (Blueprint $collection)
        {
            $collection->dropIndex();
            $collection->drop();
        });
    }
}
