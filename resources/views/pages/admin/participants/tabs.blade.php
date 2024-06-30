@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <script>
        Fancybox.bind('[data-fancybox]', {
            //
        });
    </script>
@endpush

<ul class="nav nav-pills nav-fill mb-3" id="pills-tab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="pills-document-tab" data-bs-toggle="pill" data-bs-target="#pills-document"
            type="button" role="tab" aria-controls="pills-document" aria-selected="true">
            File Blog
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="pills-follows-tab" data-bs-toggle="pill" data-bs-target="#pills-follows"
            type="button" role="tab" aria-controls="pills-follows" aria-selected="false">
            Bukti Mengikuti
        </button>
    </li>
</ul>

<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-document" role="tabpanel" aria-labelledby="pills-document-tab">

        @if ($fileExtension === 'pdf')
            <p class="text-center">
                {{ $participant->documents->first()->file_path }}
            </p>
            <div class="border border-3 p-3 rounded mb-5">
                <object class="pdf" data="{{ Storage::url($participant->documents->first()->file_path) }}"
                    width="100%" height="600">
                    Your browser does not support PDF viewing. Please download the PDF to view it: <a
                        href="{{ Storage::url($participant->documents->first()->file_path) }}">Download
                        PDF</a>.
                </object>
            </div>
        @else
            <p>Jenis berkas tidak didukung. Lakukan unduhan berkas
                <a wire:click="download"
                    class="text-primary fw-bold">({{ $this->participant->documents->first()->file_path ?? 'Tidak di temukan' }})

                    <i class="menu-icon tf-icons bx bx-download"></i>
                </a>

            <div class="d-flex">
                <div wire:loading class="spinner-border spinner-border-sm" role="status">
                    <span class="visually-hidden">
                        Loading...</span>
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
        @if ($imageExtension === 'pdf')
            @foreach ($participant->follows as $no => $item)
                <p class="text-center">
                    {{ $item->image_path }}
                </p>
                <div class="border border-3 p-3 rounded mb-5">
                    <object class="pdf" data="{{ Storage::url($item->image_path) }}" width="100%" height="600">
                        Your browser does not support PDF viewing. Please download the PDF to view it:
                        <a href="{{ Storage::url($item->image_path) }}">Download
                            PDF</a>.
                    </object>
                </div>
            @endforeach
        @else
            @foreach ($participant->follows as $no => $item)
                <a wire:ignore data-fancybox href="https://lipsum.app/id/1/1600x1200"
                    data-caption="{{ $item->image_path }}">
                    <img src="https://lipsum.app/id/1/200x150" width="200" height="150" alt=""
                        class="m-1" />
                </a>
            @endforeach
        @endif
    </div>

</div>
