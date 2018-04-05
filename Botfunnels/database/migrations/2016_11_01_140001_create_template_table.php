<?php

use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemplateTable extends Migration
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
        Schema::connection('mongodb')->create('templates', function(Blueprint $collection)
        {
            $collection->index('id_page');

            $collection->collection('blocks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mongodb')->table('templates', function (Blueprint $collection)
        {
            $collection->dropIndex();
            $collection->drop();
        });
    }
}
