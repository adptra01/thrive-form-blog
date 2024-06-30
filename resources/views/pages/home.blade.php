<?php

use function Livewire\Volt\{computed, usesPagination, state};
use function Laravel\Folio\name;
use App\Models\Participant;

name('home');

state([
    'count' => fn() => Participant::count(),
]);

?>

<x-admin-layout>
    <x-slot name="title">Home</x-slot>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/home">Beranda</a>
            </li>
        </ol>
    </nav>

    @volt
        <div>
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h4 class="card-title text-primary fw-bold">Halloo {{ auth()->user()->name }}! 🎉</h4>
                            <p class="mb-4">Kamu telah memiliki <span class="fw-medium">{{ $count }}</span>
                                pendaftar hari ini, periksa detail-nya.</p>
                        </div>
                    </div>
                    <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                            <img src="{{ asset('/assets/img/illustrations/man-with-laptop-light.png') }}" height="140"
                                alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                data-app-light-img="illustrations/man-with-laptop-light.png">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endvolt
</x-admin-layout>
