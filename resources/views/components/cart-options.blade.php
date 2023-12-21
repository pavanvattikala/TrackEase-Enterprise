<div {{ $attributes->merge(['class' => 'btn col-md-3 mb-3 border p-3 d-flex flex-column justify-content-center align-items-center rounded bg-secondary']) }}>
    <small class="text-muted mb-2">{{ $shortcut }}</small>
    <h4 class="mb-0"><i class="{{ $icon }}"></i> <br />{{ $name }}</h4>
</div>
