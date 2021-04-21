<?php
use Illuminate\Support\Collection;
namespace App\Models;

class PublicUser
{

    protected $roles = array();

    public function addRole($role)
    {
        if($role)
            array_push($this->roles,$role);
    }

    public function addRoles($roles)
    {
        foreach($roles as $role)
            array_push($this->roles,$role);
    }

    public function roleOf($roleName)
    {
        foreach($this->roles as $role)
        {
            if($role->hasType($roleName))
                return $role;
        }
        return null;
    }

}
