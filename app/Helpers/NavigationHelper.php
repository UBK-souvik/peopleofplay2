<?php

if (!function_exists('getValue')) {
    function getValue($array, $key, $default = null)
    {
        if ($key instanceof \Closure) {
            return $key($array, $default);
        }

        if (is_array($key)) {
            $lastKey = array_pop($key);
            foreach ($key as $keyPart) {
                $array = getValue($array, $keyPart);
            }
            $key = $lastKey;
        }

        if (is_array($array) && (isset($array[$key]) || array_key_exists($key, $array))) {
            return $array[$key];
        }

        if (($pos = strrpos($key, '.')) !== false) {
            $array = getValue($array, substr($key, 0, $pos), $default);
            $key = substr($key, $pos + 1);
        }

        if (is_object($array)) {
            // this is expected to fail if the property does not exist, or __get() is not implemented
            // it is not reliably possible to check whether a property is accessible beforehand
            return $array->$key;
        } elseif (is_array($array)) {
            return (isset($array[$key]) || array_key_exists($key, $array)) ? $array[$key] : $default;
        } else {
            return $default;
        }
    }
}

if (!function_exists('map')) {
    function map($array, $from, $to, $group = null)
    {
        $result = [];
        foreach ($array as $element) {
            $key = getValue($element, $from);
            $value = getValue($element, $to);
            if ($group !== null) {
                $result[getValue($element, $group)][$key] = $value;
            } else {
                $result[$key] = $value;
            }
        }

        return $result;
    }
}

if (!function_exists('getGroupNavigations')) {
    function getGroupNavigations($locale = 'en')
    {
        $output = array();
        $navigationResponse = \App\Models\NavigationMaster::where('status', '=', 1)
            ->where('show_in_permission', '=', 1)
            ->latest()
            ->get();
        if ($navigationResponse->isNotEmpty()) {
            foreach ($navigationResponse as $value) {
                $output[$value->parent_id][$value->id] = $locale == 'en' ? $value->en_name : $value->name;
            }
        }

        return $output;
    }
}

if (!function_exists('getUserPermission')) {
    function getUserPermission($user_id = null, $parent = false, $role_id = 1, $guard_name = false)
    {
        $permissionArray = $childNavigationParentArray = array();
        //Fetch user permission
        $userPermissions = \App\Models\UserPermission::where('user_id', '=', $user_id)->get();
        if ($userPermissions->isNotEmpty()) {
            $permissionUserArray = map($userPermissions, 'id', 'navigation_id');
            if (!empty($permissionUserArray)) {
                $permissionArray = array_merge($permissionArray, $permissionUserArray);
            }
        } elseif ($role_id) {
            $rolePermissions = \App\Models\RolePermission::where('role_id', '=', $role_id)->get();
            if ($rolePermissions->isNotEmpty()) {
                $permissionArray = map($rolePermissions, 'id', 'navigation_id');
            }
        }

        if (!empty($permissionArray)) {
            $childNavigations = \App\Models\NavigationMaster::where('child_permission', '=', 1)
                ->whereIn('id', $permissionArray)
                ->get();
            if ($childNavigations->isNotEmpty()) {
                $childNavigationParentArray = map($childNavigations, 'navigation_id', 'navigation_id');
            }

            if (!empty($childNavigationParentArray)) {
                $childNavigations = \App\Models\NavigationMaster::whereIn('parent_id', $childNavigationParentArray)
                    ->get();
                if ($childNavigations->isNotEmpty()) {
                    $childFunctionArray = map($childNavigations, 'navigation_id', 'navigation_id');
                }

                if (!empty($childFunctionArray)) {
                    $permissionArray = array_unique(array_merge($childFunctionArray, $permissionArray));
                }
            }
        }

        if ($parent && !empty($permissionArray)) {
            $parentNavigations = \App\Models\NavigationMaster::where('show_in_menu', '=', 1)
                ->whereIn('id', $permissionArray)
                ->get();
            if ($parentNavigations->isNotEmpty()) {
                $parentNavigationsArray = array_unique(map($parentNavigations, 'navigation_id', 'parent_id'));
                $permissionArray = array_unique(array_merge($parentNavigationsArray, $permissionArray));
            }
        }
        if ($guard_name == 'admin') {
            array_push($permissionArray, 1);
        }

        return $permissionArray;
    }
}

if (!function_exists('getRolePermission')) {
    function getRolePermission($role_id = null, $parent = false)
    {
        $permissionArray = $childFunctionParentArray = array();
        if (!empty($role_id)) {
            $rolePermissions = \App\Models\RolePermission::where('role_id', '=', $role_id)->get();
            if (!empty($rolePermissions->isNotEmpty())) {
                $permissionArray = map($rolePermissions, 'id', 'navigation_id');
            }
        }

        if (!empty($permissionArray)) {
            $childFunctions = \App\Models\NavigationMaster::where('child_permission', '=', 1)
                ->whereIn('id', $permissionArray)->get();

            if (!empty($childFunctions->isNotEmpty())) {
                $childFunctionParentArray = map($childFunctions, 'navigation_id', 'navigation_id');
            }

            if (!empty($childFunctionParentArray)) {
                $childFunctions = \App\Models\NavigationMaster::whereIn('parent_id', $childFunctionParentArray)->get();

                if ($childFunctions->isNotEmpty()) {
                    $childFunctionArray = map($childFunctions, 'navigation_id', 'navigation_id');
                }

                if (!empty($childFunctionArray)) {
                    $permissionArray = array_unique(array_merge($childFunctionArray, $permissionArray));
                }
            }
        }

        if ($parent && !empty($permissionArray)) {
            $parentNavigations = \App\Models\NavigationMaster::where('show_in_menu', '=', 1)
                ->whereIn('id', $permissionArray)
                ->get();
            if ($parentNavigations->isNotEmpty()) {
                $parentNavigationsArray = array_unique(map($parentNavigations, 'navigation_id', 'parent_id'));
                $permissionArray = array_unique(array_merge($parentNavigationsArray, $permissionArray));
            }
        }
        array_push($permissionArray, 1);

        return $permissionArray;
    }
}

if (!function_exists('userMenuList')) {
    function userMenuList($guard = 'admin')
    {
        $userMenuList = array();
        $guardData = \Auth::guard($guard)->user();
        $role_id = $guardData->role_id;

        $logged_in_id = \Auth::guard($guard)->id();
        $userPermissions = getUserPermission($logged_in_id, true, $role_id, $guard);
        if (count($userPermissions)) {
            $perArr = \App\Models\NavigationMaster::select('*')
                ->where('status', '=', 1)
                ->whereIn('id', $userPermissions)
                ->orderBy('display_order', 'asc')
                // ->where('show_in_menu', '=', 1)
                ->get();
        } else {
            $perArr = null;
        }

        if ($perArr != null && $perArr->isNotEmpty()) {
            foreach ($perArr as $record) {
                $userMenuList[$record->parent_id][$record->id]['id'] = $record->id;
                $userMenuList[$record->parent_id][$record->id]['name'] = $record->name;
                $userMenuList[$record->parent_id][$record->id]['en_name'] = $record->en_name;
                $userMenuList[$record->parent_id][$record->id]['icon'] = $record->icon;
                if (!empty($record->action_path)) {
                    $userMenuList[$record->parent_id][$record->id]['action_path'] = $record->action_path;
                }
                $userMenuList[$record->parent_id][$record->id]['show_in_menu'] = $record->show_in_menu;
            }
        }

        if (\Session::exists('userMenuList')) {
            \Session::remove('userMenuList');
        }

        \Session::put('userMenuList', $userMenuList);
        \Session::save();
        // return $userMenuList;
    }
}

if (!function_exists('userHasAccess')) {
    function userHasAccess($actionPath = null, $excludeArray = array(), $guard = 'admin')
    {
        $userMenuList = \Session::get('userMenuList');
        $logged_in_id = \Auth::guard($guard)->id();

        if (empty($logged_in_id) || empty($userMenuList)) {
            return redirect()->route("{$guard}.login")->with(['fail' => adminTransLang('session_expired')]);
        }

        $actionPathDefault = \Request::path();
        if (!empty($excludeArray)) {
            if (in_array($actionPathDefault, $excludeArray)) {
                return true;
            }
        }

        if (!empty($actionPath)) {
            $actionPathDefault = $actionPath;
        }

        if (empty($userMenuList)) {
            return false;
        }

        $navigationListArray = array();
        if (!empty($userMenuList)) {
            foreach ($userMenuList as $functionData) {
                foreach ($functionData as $userFunction) {
                    if (!empty($userFunction['action_path'])) {
                        $navigationListArray[$userFunction['id']] = $userFunction['action_path'];
                    }
                }
            }

            if (in_array($actionPathDefault, $navigationListArray)) {
                if (empty($actionPath)) {
                    return true;
                } else {
                    return true;
                }
            } else {
                return false;
            }
        }
    }
}