<?php
use function Laravel\Folio\name;
use function Livewire\Volt\{state, usesFileUploads};
use App\Models\Participant;

name('test2');

usesFileUploads();

state(['files' => [], 'photos' => []]);

$removePhoto = function ($filename) {
    $this->removeUploadedFile($filename, $this->photos);
    $this->photos = array_filter($this->photos, function ($photo) use ($filename) {
        return $photo->getClientOriginalName() !== $filename;
    });
};

$removeFile = function ($filename) {
    $this->removeUploadedFile($filename, $this->files);
    $this->files = array_filter($this->files, function ($file) use ($filename) {
        return $file->getClientOriginalName() !== $filename;
    });
};

$removeUploadedFile = function ($filename, $files) {
    $fileToRemove = null;
    foreach ($files as $file) {
        if ($file->getClientOriginalName() === $filename) {
            $fileToRemove = $file;
            break;
        }
    }

    if ($fileToRemove) {
        $tempPath = $fileToRemove->getRealPath();
        if (File::exists($tempPath)) {
            File::delete($tempPath);
        }
    }
};

?>
<x-guest-layout>
    <x-slot name="title">
        Thrive Blog Competition 2024
    </x-slot>



    @volt
        <div>
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


            {{-- <div class="card">
                <div class="card-body">

                    <div class="row">
                        <div class="col-12">
                            <form wire:submit.prevent="uploadFiles" enctype="multipart/form-data">
                                <label class="{{ $files ? 'd-none' : '' }}" for="fileInput">
                                    <div id="dropZone" class="d-flex align-items-center justify-content-center">
                                        Drop files here or click to upload
                                        <input type="file" id="fileInput" wire:model.live="files" class="d-none"
                                            multiple>
                                    </div>
                                </label>
                                <p class="my-3">
                                    @foreach ($files as $file)

                                        <div class="d-flex align-items-center mb-2">
                                            @if (Str::contains($file->getMimeType(), 'image'))
                                                <img src="{{ $file->temporaryUrl() }}" alt="Uploaded file" class="me-2"
                                                    style="max-width: 100px;">
                                            @else
                                                <div class="me-2" style="font-size: 2rem; color: #777;">
                                                    <i class="bi bi-file-earmark-text"></i>
                                                    <!-- Menggunakan ikon Bootstrap untuk file dokumen -->
                                                </div>
                                                <span class="me-2">{{ $file->getClientOriginalName() }}</span>
                                            @endif
                                            <button type="button" class="btn btn-danger btn-sm"
                                                wire:click="removeFile('{{ $file->getClientOriginalName() }}')"
                                                wire:key="removeFile('{{ $file->getClientOriginalName() }}')">
                                                Cancel Upload
                                            </button>
                                        </div>
                                    @endforeach
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div> --}}

            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Upload Photos</h5>
                    <div class="row">
                        <div class="col-12">
                            <form wire:submit.prevent="uploadPhotos" enctype="multipart/form-data">
                                <label for="photoInput">
                                    <div id="dropZone" class="d-flex align-items-center justify-content-center">
                                        Drop photos here or click to upload
                                        <input type="file" id="photoInput" wire:model="photos" class="d-none" multiple>
                                    </div>
                                </label>

                                @if ($photos)
                                    <div class="uploaded-files mt-3">
                                        @foreach ($photos as $photo)
                                            <div class="d-flex align-items-center mb-2">
                                                <img src="{{ $photo->temporaryUrl() }}" alt="Uploaded photo" class="me-2"
                                                    style="max-width: 100px;">
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    wire:click="removePhoto('{{ $photo->getClientOriginalName() }}')"
                                                    wire:key="removePhoto('{{ $photo->getClientOriginalName() }}')">
                                                    Cancel Upload
                                                </button>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                                @error('photos.*')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                                <button type="submit" class="btn btn-primary mt-3">Save photos</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Upload Files</h5>
                    <div class="row">
                        <div class="col-12">
                            <form wire:submit.prevent="uploadFiles" enctype="multipart/form-data">
                                <label for="fileInput">
                                    <div id="dropZone" class="d-flex align-items-center justify-content-center">
                                        Drop files here or click to upload
                                        <input type="file" id="fileInput" wire:model="files" class="d-none" multiple>
                                    </div>
                                </label>

                                @if ($files)
                                    <div class="uploaded-files mt-3">
                                        @foreach ($files as $file)
                                            <div class="d-flex align-items-center mb-2">
                                                <div class="me-2" style="font-size: 2rem; color: #777;">
                                                    <i class="bi bi-file-earmark-text"></i>
                                                </div>
                                                <span class="me-2">{{ $file->getClientOriginalName() }}</span>
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    wire:click="removeFile('{{ $file->getClientOriginalName() }}')"
                                                    wire:key="removeFile('{{ $file->getClientOriginalName() }}')">
                                                    Cancel Upload
                                                </button>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                                @error('files.*')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                                <button type="submit" class="btn btn-primary mt-3">Save files</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    @endvolt
</x-guest-layout>
