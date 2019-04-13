<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Model\Icon::updateOrCreate(
            ['icon_src'=>'fa fa-th-large','icon_type' => '1'],
            ['icon_size'=> 100, 'icon_order' => '1']
        );
    }
}
