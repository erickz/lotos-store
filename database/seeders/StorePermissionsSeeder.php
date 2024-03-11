<?php
namespace Database\Seeders;

class StorePermissionsSeeder extends BasePermissionsExtension
{
    function __construct()
    {
        $this->module = 'store';

        $this->permissionsToRole = [];
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
