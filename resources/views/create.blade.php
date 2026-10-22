<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Mahasiswa</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="card border-0 shadow-sm mx-auto" style="max-width: 750px;">
        <div class="card-body p-4 p-md-5">

            <h2 class="fw-bold mb-1">Tambah Mahasiswa</h2>
            <p class="text-secondary mb-4">
                Masukkan informasi mahasiswa baru.
            </p>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('mahasiswa.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                <div class="mb-3">
                    <label for="nim" class="form-label">NIM</label>
                    <input type="text" id="nim" name="nim"
                           class="form-control"
                           value="{{ old('nim') }}" required>
                </div>

                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Lengkap</label>
                    <input type="text" id="nama" name="nama"
                           class="form-control"
                           value="{{ old('nama') }}" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="angkatan" class="form-label">Angkatan</label>
                        <input type="number" id="angkatan" name="angkatan"
                               class="form-control"
                               value="{{ old('angkatan') }}"
                               min="2000" max="2100" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="sks_lulus" class="form-label">SKS Lulus</label>
                        <input type="number" id="sks_lulus" name="sks_lulus"
                               class="form-control"
                               value="{{ old('sks_lulus') }}"
                               min="0" max="255" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="status_keaktifan" class="form-label">
                        Status Keaktifan
                    </label>

                    <select id="status_keaktifan" name="status_keaktifan"
                            class="form-select" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="Aktif"
                            {{ old('status_keaktifan') == 'Aktif' ? 'selected' : '' }}>
                            Aktif
                        </option>
                        <option value="Tidak Aktif"
                            {{ old('status_keaktifan') == 'Tidak Aktif' ? 'selected' : '' }}>
                            Tidak Aktif
                        </option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="gambar" class="form-label">Foto Mahasiswa</label>
                    <input type="file" id="gambar" name="gambar"
                           class="form-control" accept="image/*">
                    <div class="form-text">
                        Maksimal ukuran 2 MB.
                    </div>
                </div>

                <div class="d-flex flex-wrap gap-2">
                    <button type="submit" class="btn btn-primary">
                        Simpan Mahasiswa
                    </button>

                    <a href="{{ route('mahasiswa.index') }}"
                       class="btn btn-outline-secondary">
                        Kembali
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>

</body>
</html>
