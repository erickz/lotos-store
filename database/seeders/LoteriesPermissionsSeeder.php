<?php
namespace Database\Seeders;

class LoteriesPermissionsSeeder extends BasePermissionsExtension
{
    function __construct()
    {
        $this->module = 'loteries';

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
