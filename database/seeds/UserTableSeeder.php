<?php
use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        User::create(array(
    	'name'=>'admin2',
        'email'=>'admin2@gmail.com',
        'rol'=>'1',
        'password' => Hash::make('admin2'),
    ));

    User::create(array(
      'name'=>'estudiante',
        'email'=>'estudiante@gmail.com',
        'rol'=>'0',
        'password' => Hash::make('estudiante'),
     ));
    }

}