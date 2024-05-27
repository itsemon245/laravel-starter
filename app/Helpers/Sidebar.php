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
                'icon' => 'o-home',//
            ],
        ];
    }
}