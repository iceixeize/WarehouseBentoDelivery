<?php
if (!function_exists('isSubdomain')) {

function isSubdomain($currentUrl = null) {
    $appDomain = env('APP_DOMAIN', 'bentodelivery.com');
    $currentUrl = $currentUrl ?? getDomain(); // Null coalescing operator
    if (mb_strpos($currentUrl, $appDomain, 0, 'UTF-8') !== false) {
        return true;
    }
    return false;
}

}

if (!function_exists('getSubdomain')) {

function getSubdomain() {
    if (isSubdomain()) {
        $appDomain = '.' . env('APP_DOMAIN', 'bentoweb.com');
        return str_replace($appDomain, '', getDomain());
    }

    return '';
}

if (!function_exists('getDomain')) {

    function getDomain() {
        $domain = parse_url(request()->root(), PHP_URL_HOST);
        if (strpos($domain, 'www.') !== false) {
            return str_replace('www.', '', $domain);
        }
        return $domain;
    }

}

}