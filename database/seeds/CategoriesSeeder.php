<?php

use Illuminate\Database\Seeder;
use App\Category;
use Carbon\Carbon as Carbon;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::insert (['id'=>1, 'name'=>'Linux distributions in general', 'sortid'=>'10', 'active'=>1, 'creator'=>1, 'created_at'=>Carbon::now()]);
        Category::insert (['id'=>2, 'name'=>'Debian', 'sortid'=>'11', 'active'=>1, 'creator'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        Category::insert (['id'=>3, 'name'=>'RedHat', 'sortid'=>'12', 'active'=>1, 'creator'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        Category::insert (['id'=>4, 'name'=>'Ubuntu', 'sortid'=>'13', 'active'=>1, 'creator'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);

        Category::insert (['id'=>5, 'name'=>'Development in general', 'sortid'=>'30', 'active'=>1, 'creator'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        Category::insert (['id'=>6, 'name'=>'OOP development', 'sortid'=>'31', 'active'=>1, 'creator'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        Category::insert (['id'=>7, 'name'=>'JAVA programming language', 'sortid'=>'32', 'active'=>1, 'creator'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        Category::insert (['id'=>8, 'name'=>'PHP programming language', 'sortid'=>'33', 'active'=>1, 'creator'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);

        Category::insert (['id'=>9, 'name'=>'Android', 'sortid'=>'200', 'active'=>1, 'creator'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);

        Category::insert (['id'=>10, 'name'=>'Neural networks', 'sortid'=>'221', 'active'=>1, 'creator'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        Category::insert (['id'=>11, 'name'=>'Machine Learning', 'sortid'=>'222', 'active'=>1, 'creator'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        Category::insert (['id'=>12, 'name'=>'AI', 'sortid'=>'223', 'active'=>1, 'creator'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);

        Category::insert (['id'=>13, 'name'=>'Hardware', 'sortid'=>'240', 'active'=>1, 'creator'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        Category::insert (['id'=>14, 'name'=>'Security', 'sortid'=>'190', 'active'=>1, 'creator'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
    }
}
