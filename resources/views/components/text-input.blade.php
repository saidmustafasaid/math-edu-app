@props(['disabled' => false])

<input @disabled($disabled)
       {{ $attributes->merge(['class' => 'w-full border border-slate-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 rounded-xl px-4 py-2.5 text-sm text-slate-900 bg-white placeholder-slate-400 transition duration-150 outline-none disabled:bg-slate-50 disabled:text-slate-500']) }}>
