<?php

use function Livewire\Volt\{state};
use App\Models\Participant;
use function Laravel\Folio\name;

name('participants.show');

state([
    'fullname' => fn() => $this->participant->fullname,
    'email' => fn() => $this->participant->email,
    'whatsapp' => fn() => $this->participant->whatsapp,
    'blog_link' => fn() => $this->participant->blog_link,
    'fileExtension' => fn() => pathinfo($this->participant->documents->first()->file_path, PATHINFO_EXTENSION),
    'fileFollows' => fn() => $this->participant->follows,
    'participant',
]);

$download = function () {
    $filePath = $this->participant->documents->first()->file_path; // Sesuaikan path dengan lokasi file Anda

    if (Storage::exists($filePath)) {
        return Storage::download($filePath);
    }

    $this->dispatch('download-failed');
};
?>


<x-admin-layout>
    <x-slot name="title">Partisipan {{ $participant->fullname }}</x-slot>

    @push('styles')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/carousel/carousel.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/carousel/carousel.thumbs.css" />

        <style>
            img {
                max-width: 100%;
                height: auto;
            }

            #myCarousel {
                max-width: 400px;
                margin: 0 auto;
            }

            #myCarousel .f-carousel__slide {
                display: flex;
                justify-content: center;
                align-items: center;
            }
        </style>
    @endpush

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/carousel/carousel.umd.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/carousel/carousel.thumbs.umd.js"></script>
        <script>
            new Carousel(document.getElementById("myCarousel"), {
                // Your custom options
                Dots: false
            }, {
                Thumbs
            });
        </script>
    @endpush

    @volt
        <div>
            <div class="card">
                <div class="card-body">
                    <div class="bg-label-primary rounded-3 text-center mb-3 pt-4">
                        <img class="img-fluid w-60"
                            src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/img/illustrations/sitting-girl-with-laptop-dark.png"
                            alt="Card girl image">
                    </div>
                    <div class="mb-3 row">
                        <p class="col-md-3 fw-bold">Nama Lengkap</p>
                        <div class="col-md-9">
                            <p>: {{ $participant->fullname ?? '' }}</p>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <p class="col-md-3 fw-bold">Email</p>
                        <div class="col-md-9">
                            <p>: {{ $participant->email ?? '' }}</p>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <p class="col-md-3 fw-bold">whatsapp</p>
                        <div class="col-md-9">
                            <p>: {{ $participant->whatsapp ?? '' }}</p>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <p class="col-md-3 fw-bold">Link blog</p>
                        <div class="col-md-9">
                            <p>:
                                <a href="{{ $participant->blog_link }}" target="_blank" rel="noopener noreferrer">
                                    {{ $participant->blog_link }}
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-document-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-document" type="button" role="tab"
                                aria-controls="pills-document" aria-selected="true">
                                File Blog
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-follows-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-follows" type="button" role="tab" aria-controls="pills-follows"
                                aria-selected="false">
                                Bukti Mengikuti
                            </button>
                        </li>

                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-document" role="tabpanel"
                            aria-labelledby="pills-document-tab">


                            @if ($fileExtension === 'pdf')
                                <object class="pdf rounded"
                                    data="{{ Storage::url($participant->documents->first()->file_path) }}" width="100%"
                                    height="600">
                                    Your browser does not support PDF viewing. Please download the PDF to view it: <a
                                        href="{{ Storage::url($participant->documents->first()->file_path) }}">Download
                                        PDF</a>.
                                </object>
                            @else
                                <p>Jenis berkas tidak didukung. Lakukan unduh berkas
                                    <a wire:click="download"
                                        class="text-primary fw-bold">({{ $this->participant->documents->first()->file_path ?? 'Tidak di temukan' }})</a>

                                <div class="d-flex">
                                    <div wire:loading class="spinner-border spinner-border-sm" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>

                                    <x-alert on="download-failed" class="text-danger fw-bold">
                                        Error
                                        <i class="bi bi-x-octagon text-danger"></i>
                                    </x-alert>
                                </div>
                                </p>
                            @endif
                        </div>
                        <div class="tab-pane fade" id="pills-follows" role="tabpanel" aria-labelledby="pills-follows-tab">
                            <div class="f-carousel" id="myCarousel">
                                @foreach ($fileFollows as $no => $follow)
                                    <div class="f-carousel__slide" data-thumb-src="{{ Storage::url($follow->image_path) }}">
                                        <img width="100%" height="auto" alt="{{ $follow->participant->fullname }}"
                                            data-lazy-src="{{ Storage::url($follow->image_path) }}" />
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    @endvolt
</x-admin-layout>
