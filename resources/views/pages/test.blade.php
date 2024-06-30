<?php
use function Laravel\Folio\name;
use function Livewire\Volt\{state, usesFileUploads};
use App\Models\Participant;

name('test');

usesFileUploads();

state(['files' => [], 'photos' => []]);

?>
<x-guest-layout>
    <x-slot name="title">
        Thrive Blog Competition 2024
    </x-slot>



    @volt
        <div>
            <!-- Dropzone 1 -->
            <livewire:dropzone wire:model="photos" :rules="['image', 'mimes:png,jpeg', 'max:10420']" :key="'dropzone-one'" :multiple="true" />

            <!-- Dropzone 2 -->
            <livewire:dropzone wire:model="files" :rules="['mimes:pdf,pptx,zip']" :multiple="true" :key="'dropzone-two'" />
        </div>
    @endvolt
</x-guest-layout>
