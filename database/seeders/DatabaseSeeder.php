<?php

//namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

       $thedate = date("Y-m-d H:i:s");

        // DB::table('roles')->insert([
        //     ['created_at' => $thedate, 'id'=> 0, 'name' => 'superadmin', 'displayname' => 'Super Administrator', 'description' => 'Highest power!'],
        //     ['created_at' => $thedate, 'id'=> 1, 'name' => 'admin', 'displayname' => 'Administrator', 'description' => 'High power.'],
        //     ['created_at' => $thedate, 'id'=> 2, 'name' => 'dealer', 'displayname' => 'Dealer', 'description' => 'Deals cars.'],
        //     ['created_at' => $thedate, 'id'=> 3, 'name' => 'tuner', 'displayname' => 'Professional Tuner', 'description' => 'Tunes cars.'],
        //     ['created_at' => $thedate, 'id'=> 4, 'name' => 'tester', 'displayname' => 'Tester/Developer', 'description' => 'Tests this fine app and everything around it.'],
        //     ['created_at' => $thedate, 'id'=> 5, 'name' => 'tech', 'displayname' => 'Technician', 'description' => 'A car technician.'],
        //     ['created_at' => $thedate, 'id'=> 6, 'name' => 'consumer', 'displayname' => 'Consumer', 'description' => 'Car owner.']
        // ]);

       $pass =  '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm'; //secret

    //    DB::table('users')->insert([
    //         ['created_at' => $thedate, 'address' => 'techvägen', 'phonenumber' => '21323233', 'first_name' => 'User', 'avatar' => 'avatar-s-1.jpg', 'last_name' => 'Doe', 'role_id' => 6, 'email' => 'user@kenntoft.se', 'password' => $pass, 'company_id' => 1, 'status' => 'active','remember_token' => Str::random(10)],
    //         ['created_at' => $thedate, 'address' => 'techvägen', 'phonenumber' => '21323233', 'first_name' => 'Tech', 'avatar' => 'avatar-s-2.jpg', 'last_name' => 'Doe', 'role_id' => 5, 'email' => 'tech@kenntoft.se', 'password' => $pass, 'company_id' => 2, 'status' => 'active','remember_token' => Str::random(10)],
    //         ['created_at' => $thedate, 'address' => 'techvägen', 'phonenumber' => '21323233', 'first_name' => 'Tester', 'avatar' => 'avatar-s-3.jpg', 'last_name' => 'Doe', 'role_id' => 4, 'email' => 'tester@kenntoft.se', 'password' => $pass, 'company_id' => 3, 'status' => 'active','remember_token' => Str::random(10)],
    //         ['created_at' => $thedate, 'address' => 'techvägen', 'phonenumber' => '21323233', 'first_name' => 'Tuner', 'avatar' => 'avatar-s-4.jpg', 'last_name' => 'Doe', 'role_id' => 3, 'email' => 'tuner@kenntoft.se', 'password' => $pass, 'company_id' => 3, 'status' => 'active','remember_token' => Str::random(10)],
    //         ['created_at' => $thedate, 'address' => 'techvägen', 'phonenumber' => '21323233', 'first_name' => 'Dealer', 'avatar' => 'avatar-s-12.jpg', 'last_name' => 'Doe', 'role_id' => 2, 'email' => 'dealer@kenntoft.se', 'password' => $pass, 'company_id' => 3, 'status' => 'active','remember_token' => Str::random(10)],
    //         ['created_at' => $thedate, 'address' => 'techvägen', 'phonenumber' => '21323233', 'first_name' => 'Admin',  'avatar' => 'avatar-s-7.jpg', 'last_name' => 'Doe', 'role_id' => 1, 'email' => 'admin@kenntoft.se', 'password' => $pass, 'company_id' => 3, 'status' => 'active','remember_token' => Str::random(10)],
    //         ['created_at' => $thedate, 'address' => 'techvägen', 'phonenumber' => '21323233', 'first_name' => 'Superadmin',  'avatar' => 'avatar-s-9.jpg', 'last_name' => 'Doe','role_id' => 0, 'email' => 'superadmin@kenntoft.se', 'password' => $pass, 'company_id' => 3, 'status' => 'active','remember_token' => Str::random(10)]
    //     ]);

        // DB::table('companies')->insert([
        //     ['created_at' => $thedate, 'name' => 'Ferrari Estepona', 'logo' => 'default', 'type' => 'Vendor', 'phone' => 2332236, 'email' => 'test@kenntoft.se', 'website' => 'www.test.se', 'country' => 'Spain', 'billing_adress' => 'testroad 2', 'reputation' => '5', 'credits' => 15, 'num_employees' => 6],
        //     ['created_at' => $thedate, 'name' => 'Ferrari Marbella', 'logo' => 'default', 'type' => 'Vendor', 'phone' => 266662236, 'email' => 'test2@kenntoft.se', 'website' => 'www.test2.se', 'country' => 'Spain', 'billing_adress' => 'testroad 4', 'reputation' => 3, 'credits' => 30, 'num_employees' => 16],
        //     ['created_at' => $thedate, 'name' => 'Porche Malaga', 'logo' => 'default',    'type' => 'Vendor', 'phone' => 55544236, 'email' => 'tes3t@kenntoft.se', 'website' => 'www.test3.se', 'country' => 'Spain', 'billing_adress' => 'testroad 5', 'reputation' => 2.5, 'credits' => 55, 'num_employees' => 180],
        //     ['created_at' => $thedate, 'name' => 'Bosses Bilservice', 'logo' => 'default', 'type' => 'Vendor', 'phone' => 322344236, 'email' => 'tes4t@kenntoft.se', 'website' => 'https://www.test5.se', 'country' => 'Sweden', 'billing_adress' => 'Vasagatan 33', 'reputation' => 4, 'credits' => 100, 'num_employees' => 50],
        //     ['created_at' => $thedate, 'name' => 'Great Cars.Inc', 'logo' => 'greatcars.jpg', 'type' => 'Vendor', 'phone' => 54544236, 'email' => 'tes6t@kenntoft.se', 'website' => 'https://www.test7.se', 'country' => 'Sweden', 'billing_adress' => 'Vasagatan 44', 'reputation' => 2.9, 'credits' => 200, 'num_employees' => 10]
           
        // ]);

        // DB::table('cars')->insert([
        //     ['created_at' => $thedate, 'name' => 'Super Car1', 'color' => 'red', 'chassinumber' => 'hh2332236', 'year' => 2020, 'user_id' => 3, 'company_id' => 3, 'model_id' => 3],
        //     ['created_at' => $thedate, 'name' => 'Super Car2', 'color' => 'blue', 'chassinumber' => 'h32232336', 'year' => 2014, 'user_id' => 2, 'company_id' => 0, 'model_id' => 2],
        //     ['created_at' => $thedate, 'name' => 'Super Car3', 'color' => 'violet', 'chassinumber' => '545432236', 'year' => 2010, 'user_id' => 4,  'company_id' => 0,'model_id' => 1],
        //     ['created_at' => $thedate, 'name' => 'Super Car4', 'color' => 'red', 'chassinumber' => '544554236', 'year' => 2010, 'user_id' => 5, 'company_id' => 3, 'model_id' => 3],
        //     ['created_at' => $thedate, 'name' => 'Best Car', 'color' => 'white', 'chassinumber' => '676873', 'year' => 2017, 'user_id' => 0, 'company_id' => 2, 'model_id' => 1],
        //     ['created_at' => $thedate, 'name' => 'Best Car3', 'color' => 'white', 'chassinumber' => 'yyy76873', 'year' => 2012, 'user_id' => 0, 'company_id' => 3, 'model_id' => 2],
        //     ['created_at' => $thedate, 'name' => 'Best Car4', 'color' => 'white', 'chassinumber' => '6uuuu73', 'year' => 2013, 'user_id' => 0, 'company_id' => 1, 'model_id' => 1],
        //     ['created_at' => $thedate, 'name' => 'Best Car44', 'color' => 'black', 'chassinumber' => '66yyy76873', 'year' => 2011, 'user_id' => 0, 'company_id' => 3, 'model_id' => 2],
        //     ['created_at' => $thedate, 'name' => 'Best Car55', 'color' => 'green', 'chassinumber' => '7776uuuu73', 'year' => 2018, 'user_id' => 0, 'company_id' => 3, 'model_id' => 1]
               
        // ]);

        // DB::table('car_models')->insert([
        //     ['name' => 'Ferrari 360', 'brand' => 'Ferrari', 'doors' => 2],
        //     ['name' => 'Ferrari 488', 'brand' => 'Ferrari', 'doors' => 2],
        //     ['name' => 'Ferrari 360', 'brand' => 'Ferrari', 'doors' => 2],
        //     ['name' => 'McLaren 720s', 'brand' => 'McLaren', 'doors' => 2],
        //     ['name' => 'McLaren 570s', 'brand' => 'McLaren', 'doors' => 2],
        //     ['name' => 'Porsche 911', 'brand' => 'Porsche', 'doors' => 2],
        //     ['name' => 'Porsche Carrera', 'brand' => 'Porsche', 'doors' => 2]
        // ]);


        // DB::table('e_c_u_s')->insert([
        //     ['checksum' => 'dadsdasdsa', 'filesize' => 233323, 'car_id' => 2],
        //     ['checksum' => 'da433434dsdasdsa', 'filesize' => 24343323, 'car_id' => 1],
        //     ['checksum' => '12121222', 'filesize' => 323323, 'car_id' => 3],
        //     ['checksum' => 'da23dsa', 'filesize' => 233323, 'car_id' => 2],
        //     ['checksum' => 'd4334sa', 'filesize' => 223323, 'car_id' => 1],
        //     ['checksum' => '656dsa', 'filesize' => 323, 'car_id' => 4],
        //     ['checksum' => '3434a', 'filesize' => 4443, 'car_id' => 5],
        //     ['checksum' => '433443a', 'filesize' => 44423, 'car_id' => 6]

        // ]);


        DB::table('news')->insert([
            ['created_at' => $thedate, 'title' => 'Good News everyone!', 'text' => '<b>We did it, the page is up</b>', 'post_date' => '2021-03-01', 'user_id' => 2], 
            ['created_at' => $thedate, 'title' => 'Good News everyone!', 'text' => 'Tomorrow youll be making a delivery to Ebola 9, the virus planet.', 'post_date' => '2021-03-01', 'user_id' => 2], 
            ['created_at' => $thedate, 'title' => 'Good News everyone!', 'text' => 'Today youll be delivering a crate of subpoenas to Sicily 8, the Mob Planet!', 'post_date' => '2021-03-02', 'user_id' => 4], 
            ['created_at' => $thedate, 'title' => 'Good News everyone!', 'text' => 'Good news. Theres a report on TV with some very bad news.', 'post_date' => '2021-03-04', 'user_id' => 5], 
            ['created_at' => $thedate, 'title' => 'Good News everyone!', 'text' => 'Good news everyone! Im sending you on an extremely controversial mission!', 'post_date' => '2021-03-05', 'user_id' => 3], 
           
        ]);

        
    }
}
