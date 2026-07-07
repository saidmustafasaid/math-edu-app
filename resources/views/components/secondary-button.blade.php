<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center px-5 py-2.5 bg-white border-2 border-slate-300 rounded-full font-semibold text-sm text-slate-700 hover:bg-slate-50 hover:border-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition duration-150 cursor-pointer']) }}>
    {{ $slot }}
</button>
