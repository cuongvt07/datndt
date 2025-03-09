<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name_user' => 'Hiep',
                'email' => 'Nguyenhiep21222@example.com',
                'password' => bcrypt('123'),
                'role_id' => 1,  // Vai trò admin
            ],
            [
                'name_user' => 'duc',
                'email' => 'duclv@example.com',
                'password' => bcrypt('123'),
                'role_id' => 2,  // Vai trò nhân viên
            ],
            [
                'name_user' => 'KaKa',
                'email' => 'KaKa@example.com',
                'password' => bcrypt('12345678'),
                'role_id' => 3,  // Vai trò khách hàng
            ],
        ]);
    }
}
