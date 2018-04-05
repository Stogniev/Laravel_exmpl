<?php

use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlocksTable extends Migration
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
        Schema::connection('mongodb')->create('blocks', function(Blueprint $collection)
        {
            $collection->index('slug');
            $collection->index('name');
            $collection->index('type');
            $collection->index('group');

            $collection->collection('cards');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mongodb')->table('blocks', function (Blueprint $collection)
        {
            $collection->dropIndex();
            $collection->drop();
        });
    }
}
