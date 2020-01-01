<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *s
     * @return void
     */
    public function run()
    {
        $this->call(RoleTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(FacultyTableSeeder::class);
        $this->call(SubjectTableSeeder::class);
        $this->call(ClassroomTableSeeder::class);
        $this->call(StudentTableSeeder::class);


    }
}
