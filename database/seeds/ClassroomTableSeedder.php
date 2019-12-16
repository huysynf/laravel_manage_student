<?php

use Illuminate\Database\Seeder;

class ClassroomTableSeedder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Classroom::class, 50)->create();
    }
}
