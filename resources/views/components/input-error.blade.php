@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'text-[11px] font-bold uppercase tracking-wider text-rose-600 dark:text-rose-400 space-y-1 mt-2 flex flex-col']) }}>
        @foreach ((array) $messages as $message)
            <li class="flex items-center gap-1.5 animate-pulse">
                <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" /></svg>
                {{ $message }}
            </li>
        @endforeach
    </ul>
@endif
