<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PermissionsDemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * run [php artisan migrate:fresh --seed --seeder=PermissionsDemoSeeder]
     * @return void
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'product list']);
        Permission::create(['name' => 'product view']);
        Permission::create(['name' => 'product write']);
        Permission::create(['name' => 'product edit']);
        Permission::create(['name' => 'product delete']);

        Permission::create(['name' => 'super admin']);
        Permission::create(['name' => 'user admin']);
        Permission::create(['name' => 'menu admin']);
        Permission::create(['name' => 'hotel admin']);
        Permission::create(['name' => 'glamping admin']);
        Permission::create(['name' => 'tour admin']);
        Permission::create(['name' => 'image admin']);
        Permission::create(['name' => 'product admin']);
        Permission::create(['name' => 'all product admin']);

        // create roles and assign existing permissions
        $productRoleStep1 = Role::create(['name' => 'step1']);
        $productRoleStep1->givePermissionTo('product list');

        $productRoleStep2 = Role::create(['name' => 'step2']);
        $productRoleStep2->givePermissionTo('product view');

        $productRoleStep3 = Role::create(['name' => 'step3']);
        $productRoleStep3->givePermissionTo('product write');

        $productRoleStep4 = Role::create(['name' => 'step4']);
        $productRoleStep4->givePermissionTo('product edit');

        $productRoleStep5 = Role::create(['name' => 'step5']);
        $productRoleStep5->givePermissionTo('product delete');

        $superAdminRole = Role::create(['name' => 'super-admin']);
        $userAdminRole = Role::create(['name' => 'user-admin']);
        $productAdminRole = Role::create(['name' => 'product-admin']);
        // gets all permissions via Gate::before rule; see AuthServiceProvider

        // create super admin users START
        $password=Str::random(8);
        $user = User::create([
            'name' => '트래블메이커',
            'email' => 'travelmaker@naver.com',
            'password'=>Hash::make($password),
            'password_tmp'=>$password
        ]);
        $user->assignRole($superAdminRole);
        // create super admin users END
    }
}
