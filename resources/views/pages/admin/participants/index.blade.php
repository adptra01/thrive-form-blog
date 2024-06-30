<?php

use function Livewire\Volt\{computed, usesPagination, state};
use App\Models\participant;
use function Laravel\Folio\name;

name('participants.index');

state(['search'])->url();
usesPagination(theme: 'bootstrap');

$participants = computed(function () {
    if ($this->search == null) {
        return participant::query()->latest()->paginate(10);
    } else {
        return participant::query()
            ->where('fullname', 'LIKE', "%{$this->search}%")
            ->orWhere('email', 'LIKE', "%{$this->search}%")
            ->orWhere('whatsapp', 'LIKE', "%{$this->search}%")
            ->latest()
            ->paginate(10);
    }
});
?>


<x-admin-layout>
    <x-slot name="title">Partisipan </x-slot>

    @volt
        <div>
            <div class="card">
                <div class="card-header">
                    <div class="row">

                        <div class="col-6">
                            <input wire:model.live="search" type="search" class="form-control" name="search" id="search"
                                aria-describedby="helpId" placeholder="Masukkan nama produk toko" />
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive border rounded">
                        <table class="table text-center text-nowrap">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Lengkap</th>
                                    <th>Email</th>
                                    <th>Whatsapp</th>
                                    <th>Link Blog</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($this->participants as $no => $participant)
                                    <tr>
                                        <th>{{ ++$no }}</th>
                                        <th>{{ $participant->fullname }}</th>
                                        <th>{{ $participant->email }}</th>
                                        <th>{{ $participant->whatsapp }}</th>
                                        <th>
                                            <a href="{{ $participant->blog_link }}" target="_blank"
                                                rel="noopener noreferrer" class="btn btn-primary btn-sm">
                                                Lihat
                                            </a>
                                        </th>
                                        <th>
                                            
                                        </th>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>

                        {{ $this->participants->links() }}
                    </div>

                </div>
            </div>
        </div>
    @endvolt
</x-admin-layout>
