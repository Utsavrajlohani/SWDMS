@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'alert alert-success font-bold text-sm']) }}>
        <div class="flex items-center gap-2">
            <span class="text-lg">✅</span>
            {{ $status }}
        </div>
    </div>
@endif
