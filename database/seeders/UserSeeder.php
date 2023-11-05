<?php

namespace Database\Seeders;

use App\Enum\UserTypeEnum;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use UserType;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /* Create example Admin */
        User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('12345678'),
            'user_type' => UserTypeEnum::ADMIN,
        ]);

        /* Create example Customer */
        User::create([
            'name' => 'Customer',
            'email' => 'customer@test.com',
            'password' => Hash::make('12345678'),
            'user_type' => UserTypeEnum::CUSTOMER,
            'telephone' => '55 51 12345 56789',
            'street_address' => 'Someplace somewhere',
            'country' => 'Canada',
            'city' => 'Edmonton',
            'postal_code' => 'XXX XXX',
        ]);
    }
}
