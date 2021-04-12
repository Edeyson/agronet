<?php
use Illuminate\Support\Collection;
namespace App\Models;

class UserBasic
{
    
    protected $roles = array();
   
    public function addRole($role)
    {        
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