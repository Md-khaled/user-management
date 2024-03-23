<?php
use Sowren\SvgAvatarGenerator\Facades\Svg;
use Sowren\SvgAvatarGenerator\Enums\FontWeight;
if (!function_exists('getProfilePhotoUrl')) {
    function getProfilePhotoUrl()
    {
        $user = Auth::user();
        $name = $user->name;
        $url = $user->images?->url;
        if (!is_null($url)) {
            return url('storage/' . $url);
        }
        return \Svg::for($name)
            ->toUrl();
    }
}
