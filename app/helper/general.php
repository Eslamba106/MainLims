<?php 

use App\Models\Folder;
use App\Models\Tenant;

if (!function_exists("uploadImage")) {
    function uploadImage($request, $folder_name, $name): mixed
    {
        if (!$request->hasFile($name)) {
            return 0;
        } else {
            $file = $request->file($name);
            $path = $file->store($folder_name, [
                'disk' => 'public',
            ]);
            return $path;
        }
    }
}
if (!function_exists("getAdminPanelUrl")) {
    function getAdminPanelUrl($url = null, $withFirstSlash = true)
    {
        return ($withFirstSlash ? '/' : '') . 'admin' . ($url ?? '');
        // return ($withFirstSlash ? '/' : '') . 'admin' . ($url ?? '');
    }

}

if (!function_exists('clean_html')) {
    function clean_html($text = null)
    {
        if ($text) {
            $text = strip_tags($text, '<h1><h2><h3><h4><h5><h6><p><br><ul><li><hr><a><abbr><address><b><blockquote><center><cite><code><del><i><ins><strong><sub><sup><time><u><img><iframe><link><nav><ol><table><caption><th><tr><td><thead><tbody><tfoot><col><colgroup><div><span>');

            $text = str_replace('javascript:', '', $text);
        }
        return $text;
    }
}

if (!function_exists('clean_html')) {
    function clean_html($text = null)
    {
        if ($text) {
            $text = strip_tags($text, '<h1><h2><h3><h4><h5><h6><p><br><ul><li><hr><a><abbr><address><b><blockquote><center><cite><code><del><i><ins><strong><sub><sup><time><u><img><iframe><link><nav><ol><table><caption><th><tr><td><thead><tbody><tfoot><col><colgroup><div><span>');

            $text = str_replace('javascript:', '', $text);
        }
        return $text;
    }
}
if (!function_exists('selected')) {
    function selected($selected, $current = true, $echo = true)
    {
        return __checked_selected_helper($selected, $current, $echo, 'selected');
    }
}

if (!function_exists('__checked_selected_helper')) {
    function __checked_selected_helper($helper, $current, $echo, $type)
    {
        if ((string) $helper === (string) $current)
            $result = " $type='$type'";
        else
            $result = '';

        if ($echo)
            echo $result;

        return $result;
    }
}
if (! function_exists('main_path')) {
    function main_path()
    {
        return 'public/';
        // return 'assets/';
    }
}

if (!function_exists('company_id')) {
    function company_id()
    { 
        $lastCompany = Tenant::orderBy('id', 'desc')->first(); 
        if ($lastCompany && $lastCompany->tenant_id) { 
            return $lastCompany->tenant_id + 1;
        } 
        return 1;
    }
}