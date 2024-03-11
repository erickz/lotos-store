<?php

namespace App\Models\Traits;

trait UserTrait
{
    public function getNameWithUppercase()
    {
        return ucfirst($this->name);
    }

    public function isActive()
    {
        return $this->active;
    }

    public function getActive()
    {
        return $this->isActive() ? 'Active' : 'Inactive';
    }

    /**
     * Retrieve the bootstrap class for the labels according the user's status
     */
    public function getLabelStatus()
    {
        return $this->isActive() ? 'label-success' : 'label-danger';
    }
}