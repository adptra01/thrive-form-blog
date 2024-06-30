@props(['on'])

<div x-data="{ shown: false, timeout: null }" x-init="@this.on('{{ $on }}', () => {
    clearTimeout(timeout);
    shown = true;
    timeout = setTimeout(() => { shown = false }, 2000);
})" x-show.transition.out.opacity.duration.1500ms="shown"
    x-transition:leave.opacity.duration.1500ms style="display: none;" {{ $attributes->merge(['class' => 'mx-3']) }}>

    {{ $slot->isEmpty() ? 'Proses berhasil' : $slot }}

</div>

@push('styles')
    <style>
        .alert-fixed {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1050;
            width: auto;
        }
    </style>
@endpush
