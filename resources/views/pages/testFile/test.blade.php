<?php
use function Laravel\Folio\name;
use function Livewire\Volt\{state, usesFileUploads};
use App\Models\Participant;

name('test');

usesFileUploads();

state([
    'follows' => [],
    'prevfollows',
    'document' => null,
    'prevDocument' => null,
]);

$updatingFollows = function ($value) {
    $this->prevfollows = $this->follows;
};

$updatedFollows = function ($value) {
    $this->follows = array_merge($this->prevfollows, $value);
};

$removeItem = function ($key) {
    if (isset($this->follows[$key])) {
        $file = $this->follows[$key];
        $file->delete();
        unset($this->follows[$key]);
    }

    $this->follows = array_values($this->follows);
};

$updatingDocument = function () {
    $this->prevDocument = $this->document;
};

$updatedDocument = function () {
    // Hapus file sebelumnya jika ada
    if ($this->prevDocument) {
        $this->prevDocument->delete();
        $this->prevDocument = null;
    }
};

?>
<x-guest-layout>
    <x-slot name="title">
        Thrive Blog Competition 2024
    </x-slot>
    <style>
        #dropZone {
            border: 2px dashed #bbb;
            border-radius: 5px;
            padding: 50px;
            text-align: center;
            font-size: 21pt;
            font-weight: bold;
            font-family: Arial, sans-serif;
            color: #bbb;
        }
    </style>

    @volt
        <div>

            <div class="card">
                <label for="imageInput" class="form-label">
                    Bukti follow akun social media Thrive Indonesia
                </label>
                <div class="card-body">
                    <label for="imageInput">
                        <div id="dropZone"
                            class="d-flex align-items-center justify-content-center flex-column {{ count($follows) >= 5 ? 'd-none' : '' }}">
                            <p> <i class="bi bi-file-earmark-text"></i>
                            </p>
                            <small style="font-size: 17px;">Drop file here or click to upload</small>
                            <input type="file" class="d-none" id="imageInput" wire:model="follows" multiple>
                        </div>
                    </label>
                    <!-- Error follow sosmed -->
                    @error('follows.*')
                        <small id="followsId" class="form-text color-custom"> {{ $message }}
                        </small>
                    @enderror
                </div>
            </div>

            @if (!empty($follows))
                @foreach ($follows as $key => $item)
                    <div class="card my-2">
                        <div class="card-body">
                            <div class="hstack justify-content-between align-items-center">
                                <i class="bi bi-file-earmark-post"></i>
                                {{ $item->getClientOriginalName() }}
                                <a type="button" wire:click.prevent='removeItem({{ json_encode($key) }})'>
                                    <i class="bi bi-x-lg"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif

            @error('follows.*')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <!-- Form for single document upload -->
            <div>
                <div class="card mt-4">
                    <div class="card-body">
                        <label for="documentInput" class="form-label">
                            Upload Document
                        </label>
                        <label id="dropZone"
                            class="d-flex align-items-center justify-content-center {{ $document ? 'd-none' : '' }}">
                            <span class="fs-1">Drop file here or click to upload</span>
                            <input type="file" class="d-none" id="documentInput" wire:model="document">
                        </label>
                        <!-- Error document upload -->
                        @error('document')
                            <small id="documentId" class="form-text color-custom"> {{ $message }}
                            </small>
                        @enderror
                    </div>
                </div>

                @if ($document)
                    <div class="card my-2">
                        <div class="card-body">
                            <div class="hstack justify-content-between align-items-center">
                                <i class="bi bi-file-earmark-post"></i>
                                {{ $document->getClientOriginalName() }}
                                <a type="button" wire:click.prevent='$set("document", null)'>
                                    <i class="bi bi-x-lg"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
                @error('document')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
    @endvolt
</x-guest-layout>
