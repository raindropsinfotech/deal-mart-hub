<?php

namespace App\Helpers\General\Backend;

use Illuminate\Support\HtmlString;
use Illuminate\Contracts\Routing\UrlGenerator;
use Spatie\Permission\Models\Role;

/**
* Class HtmlHelper.
*/

class BackendGeneralHelper
{
    /**
     * Get Roles expects SuperAdmin
     * @param       $url
     * @param array $attributes
     * @param null  $secure
     *
     * @return mixed
     */

    public function UserRoles()
    {
        $getRoles = Role::where("id",'!=', 1)->orderBy('name', 'asc')->get();

        return $getRoles;
    }
}
