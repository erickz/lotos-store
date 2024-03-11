<?php
namespace Database\Seeders;

class PricingPermissionsSeeder extends BasePermissionsExtension
{
    function __construct()
    {
        $this->module = 'pricing';

        $this->permissionsToRole = [
            'administrator' => ['read']
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
