<?php
namespace Database\Seeders;

class CustomersPermissionsSeeder extends BasePermissionsExtension
{
    function __construct()
    {
        $this->module = 'customers';

        $this->permissionsToRole = [
            'administrator' => ['create', 'read', 'update', 'delete', 'add_credit', 'remove_credit']
            ,'site_manager' => ['create', 'read']
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
