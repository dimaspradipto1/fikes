@extends('layouts.dashboard.template')

@section('title', 'Edit Sejarah Ibnu Sina')

@section('content')
<div class="pagetitle">
    <h1>Edit Sejarah Ibnu Sina</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('sejarah-ibnu-sina.index') }}">Sejarah Ibnu Sina</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-lg-9 col-md-11">
        <div class="card shadow-sm">
            <div class="card-header py-3">
                <h5 class="mb-0 fw-semibold">
                    <i class="bi bi-pencil-square me-2 text-warning"></i>Form Edit Sejarah Ibnu Sina
                </h5>
            </div>
            <div class="card-body pt-4">

                {{-- Error Summary --}}
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <strong>Periksa kembali data Anda:</strong>
                        <ul class="mb-0 mt-1 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form action="{{ route('sejarah-ibnu-sina.update', $sejarahIbnuSina->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Upload Foto --}}
                    <div class="mb-3">
                        <label for="photo" class="form-label fw-semibold">
                            Foto Ibnu Sina
                        </label>

                        {{-- Foto saat ini --}}
                        @if ($sejarahIbnuSina->url_photo)
                            <div class="mb-2 d-flex align-items-center gap-3">
                                <img id="img-current"
                                     src="{{ Storage::disk('public')->url($sejarahIbnuSina->url_photo) }}"
                                     alt="Foto Saat Ini"
                                     class="rounded border shadow-sm"
                                     style="max-height:150px; max-width:240px; object-fit:cover;">
                                <div class="text-muted small">
                                    <i class="bi bi-image me-1"></i>Foto saat ini.<br>
                                    Pilih file baru untuk mengganti.
                                </div>
                            </div>
                        @endif

                        <input type="file"
                               id="photo"
                               name="photo"
                               class="form-control @error('photo') is-invalid @enderror"
                               accept="image/jpg,image/jpeg,image/png,image/webp">
                        <div class="form-text">Format: JPG, JPEG, PNG, WEBP. Maks. 2 MB. Kosongkan jika tidak ingin mengganti foto.</div>
                        @error('photo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        {{-- Preview foto baru --}}
                        <div id="preview-photo" class="mt-2 d-none">
                            <img id="img-preview" src="" alt="Preview Foto Baru"
                                 class="rounded border shadow-sm" style="max-height:180px; max-width:280px; object-fit:cover;">
                            <div class="form-text text-success"><i class="bi bi-check-circle me-1"></i>Foto baru siap diupload.</div>
                        </div>
                    </div>

                    {{-- URL Video --}}
                    <div class="mb-3">
                        <label for="url_video" class="form-label fw-semibold">
                            URL Video
                        </label>
                        <input type="url"
                               id="url_video"
                               name="url_video"
                               class="form-control @error('url_video') is-invalid @enderror"
                               value="{{ old('url_video', $sejarahIbnuSina->url_video) }}"
                               placeholder="https://youtube.com/watch?v=...">
                        <div class="form-text">Masukkan URL video (opsional).</div>
                        @error('url_video')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Deskripsi (TinyMCE) --}}
                    <div class="mb-4">
                        <label for="deskripsi" class="form-label fw-semibold">
                            Deskripsi / Isi Sejarah <span class="text-danger">*</span>
                        </label>
                        @error('deskripsi')
                            <div class="text-danger small mb-1"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
                        @enderror
                        <textarea id="deskripsi"
                                  name="deskripsi"
                                  class="@error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $sejarahIbnuSina->deskripsi) }}</textarea>
                    </div>

                    {{-- Tombol --}}
                    <div class="d-flex gap-2 justify-content-end">
                        <a href="{{ route('sejarah-ibnu-sina.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-1"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-warning text-white">
                            <i class="bi bi-save me-1"></i> Simpan Perubahan
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // ── Preview foto baru saat file dipilih ─────────────────────────────
    document.getElementById('photo').addEventListener('change', function () {
        const file = this.files[0];
        const preview = document.getElementById('preview-photo');
        const img = document.getElementById('img-preview');
        if (file) {
            img.src = URL.createObjectURL(file);
            preview.classList.remove('d-none');
            const current = document.getElementById('img-current');
            if (current) current.style.opacity = '0.4';
        } else {
            preview.classList.add('d-none');
            const current = document.getElementById('img-current');
            if (current) current.style.opacity = '1';
        }
    });

    // ── Inisialisasi TinyMCE ────────────────────────────────────────────
    tinymce.init({
        selector: '#deskripsi',
        language: 'id',
        height: 450,
        menubar: true,
        plugins: [
            'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
            'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
            'insertdatetime', 'media', 'table', 'help', 'wordcount'
        ],
        toolbar:
            'undo redo | blocks | bold italic underline strikethrough | ' +
            'forecolor backcolor | alignleft aligncenter alignright alignjustify | ' +
            'bullist numlist outdent indent | removeformat | ' +
            'link image media table | code fullscreen | help',
        images_upload_url: '{{ route('sejarah-ibnu-sina.uploadImage') }}',
        images_upload_handler: function (blobInfo, progress) {
            return new Promise(function (resolve, reject) {
                const formData = new FormData();
                formData.append('file', blobInfo.blob(), blobInfo.filename());
                formData.append('_token', '{{ csrf_token() }}');

                fetch('{{ route('sejarah-ibnu-sina.uploadImage') }}', {
                    method: 'POST',
                    body: formData,
                })
                .then(res => res.json())
                .then(data => {
                    if (data.location) {
                        resolve(data.location);
                    } else {
                        reject('Upload gagal: respons tidak valid.');
                    }
                })
                .catch(() => reject('Upload gambar gagal.'));
            });
        },
        automatic_uploads: true,
        file_picker_types: 'image',
        content_style: 'body { font-family: "Open Sans", sans-serif; font-size: 15px; line-height: 1.7; }',
        branding: false,
        promotion: false,
    });
</script>
@endpush
