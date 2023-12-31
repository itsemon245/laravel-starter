<button
    {{ $attributes->merge(['class' => 'flex gap-2 items-center justify-between w-max px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-rose-500 border border-transparent rounded-lg active:bg-rose-600 hover:bg-rose-700 focus:outline-none focus:shadow-outline-rose']) }}>
    {{ $slot ?? 'Primary Btn' }}
</button>
