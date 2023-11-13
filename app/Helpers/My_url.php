<?php

// untuk route role dinamis
if (!function_exists('route_role')) {
    function route_role($name, $parameters = [], $absolute = true)
    {
        $parameters['role'] = session()->get('roles');

        return route($name, $parameters, $absolute);
    }
}

// untuk akses assets admin
if (!function_exists('asset_admin')) {
    function asset_admin($path)
    {
        return asset("assets/admin/{$path}");
    }
}

// untuk akses upload file
if (!function_exists('asset_upload')) {
    function asset_upload($path)
    {
        return asset("uploads/{$path}");
    }
}

// untuk lokasi upload file
if (!function_exists('upload_path')) {
    function upload_path($path)
    {
        return public_path("uploads/{$path}");
    }
}