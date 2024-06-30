<?php

use function Livewire\Volt\{state, on};
use App\Models\Participant;
use function Laravel\Folio\name;

name('participants.show');

state([
    'fullname' => fn() => $this->participant->fullname,
    'email' => fn() => $this->participant->email,
    'whatsapp' => fn() => $this->participant->whatsapp,
    'blog_link' => fn() => $this->participant->blog_link,
    'fileExtension' => fn() => pathinfo($this->participant->documents->first()->file_path, PATHINFO_EXTENSION),
    'imageExtension' => fn() => pathinfo($this->participant->follows->first()->image_path, PATHINFO_EXTENSION),
    'status' => fn() => $this->participant->status,
    'description' => fn() => $this->participant->description,
    'participant',
]);

$download = function () {
    $filePath = statusdocuments->first()->file_path;

    if (Storage::exists($filePath)) {
        return Storage::download($filePath);
    }

    $this->dispatch('download-failed');
};

on([
    'update-status' => function () {
        $this->status = $this->status;
    },
]);

$statusPending = function () {
    Participant::whereId($this->participant->id)->update(['status' => 'MENUNGGU']);
    $this->dispatch('update-status');
};
$statusAccept = function () {
    Participant::whereId($this->participant->id)->update(['status' => 'TERIMA']);
    $this->dispatch('update-status');
};
$statusReject = function () {
    Participant::whereId($this->participant->id)->update(['status' => 'TOLAK']);
    $this->dispatch('update-status');
};

$descriptionSaved = function () {
    Participant::whereId($this->participant->id)->update([
        'description' => $this->description,
    ]);
};

?>


<x-admin-layout>
    <x-slot name="title">Partisipan {{ $participant->fullname }}</x-slot>


    @volt
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="/home">Beranda</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a href="{{ route('participants.index') }}">Peserta</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a href="#">{{ $participant->fullname }}</a>
                    </li>
                </ol>
            </nav>

            <div class="card">
                <div class="card-body">
                    <div class="bg-label-primary rounded-3 text-center mb-3 pt-4">
                        <img class="img-fluid w-60"
                            src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/img/illustrations/sitting-girl-with-laptop-dark.png"
                            alt="Card girl image">
                    </div>
                    <div class="mb-3 row">
                        <p class="col-md-3 fw-bold">Nama Lengkap</p>
                        <div class="col-md-9 d-flex">
                            :
                            <p class="ms-1">
                                {{ $participant->fullname ?? '' }}
                                <span
                                    class="badge {{ $participant->status == 'MENUNGGU' ? 'bg-warning' : ($participant->status == 'TERIMA' ? 'bg-success' : 'bg-danger') }}">
                                    {{ $participant->status }}
                                </span>
                                </h6>

                        </div>
                    </div>
                    <div class="mb-3 row">
                        <p class="col-md-3 fw-bold">Email</p>
                        <div class="col-md-9">
                            <p>: {{ $participant->email ?? '' }}</p>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <p class="col-md-3 fw-bold">Whatsapp</p>
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
                    <div class="mb-3 row">
                        <p class="col-md-3 fw-bold">Status</p>
                        <div class="col-md-9 ">
                            :
                            <div class="form-check form-check-inline">
                                <input wire:loading.attr='disabled' wire:click="statusPending" class="form-check-input"
                                    type="radio" name="status" id="menunggu" value="menunggu"
                                    {{ $participant->status == 'MENUNGGU' ? 'checked' : '' }}>
                                <label class="form-check-label" for="menunggu">Menunggu</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input wire:loading.attr='disabled' wire:click="statusAccept" class="form-check-input"
                                    type="radio" name="status" id="terima" value="terima"
                                    {{ $participant->status == 'TERIMA' ? 'checked' : '' }}>
                                <label class="form-check-label" for="terima">Terima</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input wire:loading.attr='disabled' wire:click="statusReject" class="form-check-input"
                                    type="radio" name="status" id="tolak" value="tolak"
                                    {{ $participant->status == 'TOLAK' ? 'checked' : '' }}>
                                <label class="form-check-label" for="tolak">Tolak</label>
                            </div>

                        </div>
                    </div>
                    <div class="mb-3 row">
                        <p class="col-md-3 fw-bold">Keterangan (Opsional)</p>
                        <div class="col-md-9 text-end">
                            <form wire:submit='descriptionSaved'>
                                @csrf
                                <div class="d-flex mb-2">
                                    :
                                    <textarea class="form-control ms-2" wire:model='description' rows="5">
                                        {{ $description }}
                                    </textarea>
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm" role="button">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    @include('pages.admin.participants.tabs')
                </div>

            </div>

        </div>
    @endvolt
</x-admin-layout>
