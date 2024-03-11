<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Permission;
use App\Models\Role;

/**
 * This class is not meant to be se used as a seeder but as an extension
 * Class BasePermissionsSeeder
 */
class BasePermissionsExtension extends Seeder
{
    protected $module = '';
    protected $permissionsToRole = [];

    public function managePermissions()
    {
        if (! $this->permissionsToRole){
            $permissionsToCreate = collect(config('laratrust_seeder.permissions_map'));

            return $this->createPermissions($permissionsToCreate);
        }

        $totalPermissionsCreated = [];

        foreach($this->permissionsToRole as $permissions){
            $permissionsCreated = $this->createPermissions($permissions);

            $totalPermissionsCreated = array_merge($totalPermissionsCreated, $permissionsCreated);
        }

        return $totalPermissionsCreated;
    }

    /**
     * Create the permissions of the given module according the map structure of
     * permissions in the config file `laratrust_seeder`
     * @return array
     */
    public function createPermissions($permissionsToCreate = null)
    {
        $permissionsCreated = [];

        foreach($permissionsToCreate as $userType => $permission){
            $this->command->info('Creating Permission to ' . $permission . ' for ' . $this->module);

            $permissionCreated = Permission::firstOrCreate([
                'name' => $permission . '-' . strtolower($this->module)
                ,'display_name' => ucfirst($permission) . ' ' . ucfirst($this->module)
                ,'description' => ucfirst($permission) . ' ' . ucfirst($this->module)
            ]);

            $permissionsCreated[$permissionCreated->name] = $permissionCreated;
        }

        return $permissionsCreated;
    }

    /**
     * Super administrator is the global user of the plataform and therefore It must
     * to possess permisssion to access every module created.
     */
    public function attachPermissionsToSuperAdministrator($permissionsCreated = [])
    {
        $this->command->info('Attaching crud permissions to super admins');
        $superAdmin = Role::where(['name' => 'super_administrator'])->first();

        foreach($permissionsCreated as $permission){
            $superAdmin->permissions()->attach($permission->id);
        }
    }

    /**
     * Attach the permissions to the selected roles
     *
     * @param array $permissionsCreated
     */
    public function attachPermissionsToRoles($permissionsCreated = [])
    {
        $this->command->info('Attaching crud permissions to admins');

        foreach($this->permissionsToRole as $roleName => $permissions){
            if (! $permissions){
                continue;
            }

            foreach($permissions as $permission){
                $permissionName = $permission . '-' . $this->module;

                $role = Role::where('name', $roleName)->first();

                $role->permissions()->attach($permissionsCreated[$permissionName]->id);
                $this->command->info('Attaching permission ' . $permissionName . ' to ' . $role->name);
            }
        }
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function createAndAttachPermissionsToRoles()
    {
        $permissionsCreated = $this->managePermissions();

        $this->attachPermissionsToSuperAdministrator($permissionsCreated);
        $this->attachPermissionsToRoles($permissionsCreated);
    }
}
