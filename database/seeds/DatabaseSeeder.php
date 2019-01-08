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
        DB::table('admins')->insert(array(
            array(
            'name' => 'Jane Doe',
            'email' => 'jane@doe.com',
            'password' => bcrypt('admin')
            ),
        ));

        DB::table('roles')->insert(array(
            array(
            'name' => 'buyer',
            ),
            array(
            'name' => 'seller',
            ),
            array(
            'name' => 'Admin'
            ),
        ));

        DB::table('counties')->insert(array(
            array(
            'name' => 'Migori',
            ),
            array(
            'name' => 'Homabay',
            ),
        ));

        DB::table('locations')->insert(array(
            array(
            'name' => 'North',
            'county_id' => '01'
            ),
            array(
            'name' => 'South',
            'county_id' => '01'
            ),
            array(
            'name' => 'East',
            'county_id' => '01'
            ),
            array(
            'name' => 'West',
            'county_id' => '01'
            ),
            array(
            'name' => 'North',
            'county_id' => '02'
            ),
            array(
            'name' => 'South',
            'county_id' => '02'
            ),
            array(
            'name' => 'East',
            'county_id' => '02'
            ),
            array(
            'name' => 'West',
            'county_id' => '02'
            ),
        ));
    }
}
