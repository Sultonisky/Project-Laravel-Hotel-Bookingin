<?php

if (!function_exists('hotelImage')) {
    function aboutImage($filename)
    {
        return asset('frontend/images/about/' . $filename);
    }
}

if (!function_exists('facilityImage')) {
    function facilityImage($filename)
    {
        return asset('frontend/images/facilities/' . $filename);
    }
}

if (!function_exists('galleryImage')) {
    function galleryImage($filename)
    {
        return asset('frontend/images/gallery/' . $filename);
    }
}
