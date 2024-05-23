<?php

namespace App\Helpers;

class Sidebar {
    public static function items() {
        return [
            'Dashboard' => [
                'route' => route('dashboard'),
                'isActive' => request()->routeIs('dashboard'),
                'submenu' => false,
                'hidden' => false,
                'icon' => 'ki-outline ki-home-2',
            ],
            'Subscribers' => [
                'route' => route('subscriber.index'),
                'isActive' => request()->routeIs('subscriber.*') || request()->routeIs('group.*'),
                'submenu' => false,
                'hidden' => false,
                'icon' => 'ki-outline ki-profile-user',
            ],
            'Server' => [
                'route' => route('server.index'),
                'isActive' => request()->routeIs('server.*'),
                'submenu' => false,
                'hidden' => false,
                'icon' => 'ki-outline ki-technology-4',
            ],
            'Setting' => [
                'route' => route('setting.index'),
                'isActive' => request()->routeIs('setting.*'),
                'submenu' => false,
                'hidden' => false,
                'icon' => 'ki-outline ki-setting',
            ],
        ];
    }
}