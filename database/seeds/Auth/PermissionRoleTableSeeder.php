<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

/**
 * Class PermissionRoleTableSeeder.
 */
class PermissionRoleTableSeeder extends Seeder
{
    use DisableForeignKeys;

    /**
     * Run the database seed.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys();

        // Create Roles
        $admin      = Role::create(['name' => config('access.users.admin_role')]);
        $executive  = Role::create(['name' => 'executive']);
        $user       = Role::create(['name' => config('access.users.default_role')]);

        // Create Permissions
        Permission::create(['name' => 'view backend']);
        // Create Permission For Inventory Module
        Permission::create(['name' => 'view inventory']);
        Permission::create(['name' => 'create item']);
        Permission::create(['name' => 'store item']);
        Permission::create(['name' => 'edit item']);
        Permission::create(['name' => 'update item']);
        Permission::create(['name' => 'delete item']);
        Permission::create(['name' => 'restore item']);
        Permission::create(['name' => 'force delete item']);
        // Create Permission For Inventory Module
        Permission::create(['name' => 'view sizes']);
        Permission::create(['name' => 'store size']);
        Permission::create(['name' => 'update size']);
        Permission::create(['name' => 'delete size']);
        Permission::create(['name' => 'restore size']);
        Permission::create(['name' => 'force delete size']);

        // ALWAYS GIVE ADMIN ROLE ALL PERMISSIONS
        $admin->givePermissionTo('view backend');
        // Give all Permission for Inventory to Admin
        $admin->givePermissionTo('view inventory');
        $admin->givePermissionTo('create item');
        $admin->givePermissionTo('store item');
        $admin->givePermissionTo('edit item');
        $admin->givePermissionTo('update item');
        $admin->givePermissionTo('delete item');
        $admin->givePermissionTo('restore item');
        $admin->givePermissionTo('force delete item');
        // Give all Permission for Size to Admin
        $admin->givePermissionTo('view sizes');
        $admin->givePermissionTo('store size');
        $admin->givePermissionTo('update size');
        $admin->givePermissionTo('delete size');
        $admin->givePermissionTo('restore size');
        $admin->givePermissionTo('force delete size');

        // Assign Permissions to other Roles
        $executive->givePermissionTo('view backend');

        $this->enableForeignKeys();
    }
}
