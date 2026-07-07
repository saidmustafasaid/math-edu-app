<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-6 py-2.5 bg-indigo-600 border border-transparent rounded-full font-semibold text-sm text-white hover:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition duration-150 cursor-pointer']) }}>
    {{ $slot }}
</button>
