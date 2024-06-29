<x-guest-layout>
    <x-slot name="title">
        Thrive Blog Competition 2024
    </x-slot>
    <form action="" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card mb-3 border-0">
            <div class="card-body">
                <div class="mb-3">
                    <label for="fullname" class="form-label">Nama lengkap (Sesuai dengan KTP)</label> <input type="text"
                        class="form-control rounded-3" value="{{ old('fullname') }}" name="fullname" id="fullname"
                        aria-describedby="fullnameId" placeholder="Nama Lengkap" />

                    <!-- Error fullname -->
                    @error('fullname')
                        <small id="emailId" class="form-text color-custom"> {{ $message }} </small>
                    @enderror
                </div>
            </div>
        </div>

        <div class="card my-3 border-0">
            <div class="card-body">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control rounded-3" value="{{ old('email') }}" name="email"
                        id="email" aria-describedby="emailId" placeholder="contoh@email.com" />

                    <!-- Error email -->
                    @error('email')
                        <small id="emailId" class="form-text color-custom"> {{ $message }} </small>
                    @enderror
                </div>
            </div>
        </div>

        <div class="card my-3 border-0">
            <div class="card-body">
                <div class="mb-3">
                    <label for="whatsapp" class="form-label">
                        No Whatsapp
                    </label>
                    <input type="number" class="form-control rounded-3" value="{{ old('whatsapp') }}" name="whatsapp"
                        id="whatsapp" aria-describedby="whatsappId" placeholder="08xxxxxxxxx" />

                    <!-- Error whatsappp -->
                    @error('whatsapp')
                        <small id="whatsappId" class="form-text color-custom"> {{ $message }} </small>
                    @enderror
                </div>
            </div>
        </div>


        <div class="card my-3 border-0">
            <div class="card-body">
                <div class="mb-3">
                    <label for="blog_link" class="form-label">Link atau URL bukti tayang / published link
                        blog</label>
                    <input type="url" class="form-control rounded-3" value="{{ old('blog_link') }}" name="blog_link"
                        id="blog_link" aria-describedby="blog_linkId" placeholder="link atau url" />

                    <!-- Error email -->
                    @error('blog_link')
                        <small id="blog_linkId" class="form-text color-custom"> {{ $message }} </small>
                    @enderror
                </div>

            </div>
        </div>

        <div class="card my-3 border-0">
            <div class="card-body">
                <div class="mb-3">
                    <label for="document" class="form-label">
                        Upload karya tulis dalam bentuk file
                    </label>
                    <input type="file" class="form-control rounded-3" name="document" id="document"
                        aria-describedby="documentId" />

                    <!-- Error document -->
                    @error('document')
                        <small id="documentId" class="form-text color-custom"> {{ $message }} </small>
                    @enderror

                </div>
                <small class="form-text text-muted m-0">
                    <strong>Upload File Maks 5 MB</strong> (format .pdf, .doc atau .docx)
                    <br>
                    <strong>Teknis penamaan file :</strong>
                    Judul Karya Tulis_Nama Lengkap Peserta_Nomor Telepon/HP
                    <br>
                    <strong>Contoh:</strong> Makin Produktif dengan ET PC Desktop Workstation_Thrive_08xx-xxxx-xxxx
                </small>
            </div>
        </div>

        <div class="card my-3 border-0">
            <div class="card-body">
                <div class="mb-3">
                    <label for="follows" class="form-label">
                        Bukti follow akun social media Thrive Indonesia
                    </label>
                    <input type="file" class="form-control rounded-3" name="follows[]" id="follows"
                        aria-describedby="followsId" multiple />

                    <!-- Error follow sosmed -->
                    @error('follows')
                        <small id="followsId" class="form-text color-custom"> {{ $message }}
                        </small>
                    @enderror
                </div>
                <small class="form-text text-muted m-0">
                    <strong>Upload File Maks 5 MB</strong> (format .pdf, .jpg atau
                    .jpeg)
                    <br>
                    <strong>Teknis penamaan file:</strong> Bukti follow_Nama Sosial Media_Akun Sosial Media Thrive_Nama
                    Lengkap
                    <br>
                    <strong>Contoh:</strong> Bukti follow_Tiktok_@thrive.itsolutions_Thrive
                </small>
            </div>
        </div>

        <div class="card my-3 border-0">
            <div class="card-body">
                <div class="mb-3">

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="requirements" required>
                        <label class="form-check-label" for="requirements">
                            Saya sudah membaca dan menyetujui
                            <a class="color-custom text-decoration-none" data-bs-toggle="modal"
                                data-bs-target="#modalId">syarat dan
                                ketentuan yang berlaku.</a>
                        </label>
                    </div>

                </div>
                <div class="mb-3">
                    <p>Dan menyatakan :</p>
                    <ol>
                        <li>
                            Keikutsertaan dalam Thrive Indonesia Blog Competition 2024
                        </li>
                        <li>
                            Mematuhi segala peraturan dan ketentuan yang telah ditetapkan oleh Thrive Blog Competition
                            2024
                        </li>
                        <li>
                            Menyerahkan karya original milik sendiri untuk dapat disertakan pada Thrive Blog Competition
                            2024
                        </li>
                        <li>
                            Bertanggung jawab penuh atas karya sendiri yang diikutsertakan pada Thrive Blog Competition
                            2024
                        </li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="card my-3 border-0">
            <div class="card-body">
                <div class="d-grid">
                    <button type="submit" class="btn btn-custom">
                        SUBMIT
                    </button>
                </div>
            </div>
        </div>
    </form>

    @include('pages.modal-form')
</x-guest-layout>
