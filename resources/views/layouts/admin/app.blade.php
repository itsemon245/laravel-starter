<x-layouts.app>

    @section('header')
    @endsection
    @section('aside')
        {{-- NAVBAR mobile only --}}
        <x-mary-nav sticky class="lg:hidden">
            <x-slot:brand>
                <div class="ml-5 pt-5">{{ config('app.name') }}</div>
            </x-slot:brand>
            <x-slot:actions>
                <label for="main-drawer" class="lg:hidden mr-3">
                    <x-mary-icon name="o-bars-3" class="cursor-pointer" />
                </label>
            </x-slot:actions>
        </x-mary-nav>
    @endsection
    {{-- MAIN --}}
    <x-mary-main full-width>
        {{-- SIDEBAR --}}
        <x-slot:sidebar drawer="main-drawer" collapsible class="bg-base-100 lg:bg-inherit">

            {{-- BRAND --}}
            <div class="ml-5 pt-5">{{ config('app.name') }}</div>

            {{-- MENU --}}
            <x-mary-menu activate-by-route>

                {{-- User --}}
                @if ($user = auth()->user())
                    <x-mary-menu-separator />

                    <x-mary-list-item :item="$user" value="name" sub-value="email" no-separator no-hover
                        class="-mx-2 !-my-2 rounded">
                        <x-slot:actions>
                            <x-mary-button icon="o-power" class="btn-circle btn-ghost btn-xs" tooltip-left="logoff"
                                no-wire-navigate link="/logout" />
                        </x-slot:actions>
                    </x-mary-list-item>

                    <x-mary-menu-separator />
                @endif

                @foreach (sidebar() as $title => $menu)
                    @if ($menu['submenu'])
                        <x-mary-menu-sub title="{{ $title }}" icon="{{ $menu['icon'] }}">
                            @foreach ($menu['submenu'] as $subTitle => $sub)
                                <x-mary-menu-item title="{{ $subTitle }}" icon="{{ $sub['icon'] }}"
                                    link="{{ $sub['route'] }}" />
                            @endforeach
                        </x-mary-menu-sub>
                    @else
                        <x-mary-menu-item title="{{ $title }}" icon="{{ $menu['icon'] }}"
                            link="{{ $menu['route'] }}" />
                    @endif
                @endforeach
            </x-mary-menu>
        </x-slot:sidebar>

        {{-- The `$slot` goes here --}}
        <x-slot:content>
            @yield('content')
        </x-slot:content>
    </x-mary-main>

    @section('footer')
    @endsection
</x-layouts.app>
