<?php
namespace Database\Seeders;

class BoloesPermissionsSeeder extends BasePermissionsExtension
{
    function __construct()
    {
        $this->module = 'boloes';

        $this->permissionsToRole = [
            'administrator' => ['create', 'read', 'update', 'delete']
            ,'site_manager' => ['create', 'read', 'update']
        ];
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createAndAttachPermissionsToRoles();
    }
}
