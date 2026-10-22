<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-4">
    <div class="mb-3">
       
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0">Informasi lengkap mahasiswa</h5>
        </div>

        <div class="card-body p-4">
            <div class="row g-4 align-items-start">
                <div class="col-md-4 text-center">
                    @if ($mahasiswa->gambar)
                        <img
                            src="{{ asset('storage/' . $mahasiswa->gambar) }}"
                            alt="Foto {{ $mahasiswa->nama }}"
                            class="img-thumbnail mb-3"
                            style="width: 180px; height: 220px; object-fit: cover;"
                        >
                    @else
                        <div class="bg-light border rounded d-flex align-items-center justify-content-center mx-auto mb-3"
                             style="width: 180px; height: 220px;">
                            <span class="text-muted">Tidak ada foto</span>
                        </div>
                    @endif

                    <h5 class="mb-1">{{ $mahasiswa->nama }}</h5>
                    <p class="text-muted mb-0">{{ $mahasiswa->nim }}</p>
                </div>

                <div class="col-md-8">
                    <h6 class="mb-3">Informasi Akademik</h6>

                    <table class="table table-bordered align-middle">
                        <tr>
                            <th class="table-light" style="width: 40%;">NIM</th>
                            <td>{{ $mahasiswa->nim }}</td>
                        </tr>
                        <tr>
                            <th class="table-light">Nama Lengkap</th>
                            <td>{{ $mahasiswa->nama }}</td>
                        </tr>
                        <tr>
                            <th class="table-light">Angkatan</th>
                            <td>{{ $mahasiswa->angkatan }}</td>
                        </tr>
                        <tr>
                            <th class="table-light">SKS Lulus</th>
                            <td>{{ $mahasiswa->sks_lulus }}</td>
                        </tr>
                        <tr>
                            <th class="table-light">Status Keaktifan</th>
                            <td>
                                <span class="badge {{ strtolower($mahasiswa->status_keaktifan) === 'aktif' ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $mahasiswa->status_keaktifan }}
                                </span>
                            </td>
                        </tr>
                    </table>

                    <div class="d-flex gap-2 justify-content-end mt-4">
                        <a href="{{ route('mahasiswa.index') }}"
                           class="btn btn-outline-secondary">
                            Kembali
                        </a>

                        <a href="{{ route('mahasiswa.edit', $mahasiswa->id) }}"
                           class="btn btn-warning">
                            Edit Data
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>