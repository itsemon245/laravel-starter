<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-primary dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-primary-hover dark:hover:bg-white focus:bg-primary-active dark:focus:bg-white active:bg-primary-active dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-primary-active focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
