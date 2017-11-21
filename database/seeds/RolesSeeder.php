<?php

use Illuminate\Database\Seeder;
use App\Role;
use Carbon\Carbon as Carbon;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::insert (['id'=>1, 'name'=>'Registered only', 'creator'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
    	Role::insert (['id'=>2, 'name'=>'Active user', 'creator'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        Role::insert (['id'=>3, 'name'=>'Contributor', 'creator'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        Role::insert (['id'=>4, 'name'=>'Moderator', 'creator'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        Role::insert (['id'=>6, 'name'=>'Editor', 'creator'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        Role::insert (['id'=>7, 'name'=>'Editor in chief', 'creator'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        Role::insert (['id'=>8, 'name'=>'Administrator', 'creator'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        Role::insert (['id'=>9, 'name'=>'Super administrator', 'creator'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
    }
}
