<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $superAdminRole = Role::where('name', '=', 'super-admin')->first();
        $AdminRole = Role::create(['name' => 'admin']);
        // gets all permissions via Gate::before rule; see AuthServiceProvider

        // create super admin users START
        $password = Str::random(8);
        $user = User::create([
            'name' => '김병주',
            'email' => 'djmd4109@naver.com',
            'password' => \Illuminate\Support\Facades\Hash::make($password),
            'password_tmp' => $password
        ]);
        $user->assignRole($superAdminRole);
        $password = Str::random(8);
        $user = User::create([
            'name' => '정승재',
            'email' => 'wetraveleveryday@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make($password),
            'password_tmp' => $password
        ]);
        $user->assignRole($superAdminRole);

        $password = Str::random(8);
        $user = User::create([
            'name' => '노한결',
            'email' => 'zuiderzee@naver.com',
            'password' => \Illuminate\Support\Facades\Hash::make($password),
            'password_tmp' => $password
        ]);
        $user->assignRole($superAdminRole);

        $password = Str::random(8);
        $user = User::create([
            'name' => '박단예',
            'email' => 'danyep@naver.com',
            'password' => \Illuminate\Support\Facades\Hash::make($password),
            'password_tmp' => $password
        ]);
        $user->assignRole($superAdminRole);

        $password = Str::random(8);
        $user = User::create([
            'name' => '김나영',
            'email' => 'kimnayeong4735@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make($password),
            'password_tmp' => $password
        ]);
        $user->assignRole($superAdminRole);

        $password = Str::random(8);
        $user = User::create([
            'name' => '전서영',
            'email' => 'stellayoung7575@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make($password),
            'password_tmp' => $password
        ]);
        $user->assignRole($superAdminRole);

        $password = Str::random(8);
        $user = User::create([
            'name' => '임승빈',
            'email' => 'lsb2247@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make($password),
            'password_tmp' => $password
        ]);
        $user->assignRole($AdminRole);
        $password = Str::random(8);
        $user = User::create([
            'name' => '김희지',
            'email' => 'gmlwlcjwo@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make($password),
            'password_tmp' => $password
        ]);
        $user->assignRole($AdminRole);

    }
}
