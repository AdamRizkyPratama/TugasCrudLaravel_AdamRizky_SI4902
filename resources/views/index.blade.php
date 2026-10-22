<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Mahasiswa</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">

    
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h2 class="fw-bold mb-1">Daftar Mahasiswa</h2>
        </div>

        <a href="{{ route('mahasiswa.create') }}"
           class="btn btn-primary">
            + Tambah Mahasiswa
        </a>
    </div>

  
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show"
             role="alert">
            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Close"></button>
        </div>
    @endif


    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">

            <form action="{{ route('mahasiswa.index') }}"
                  method="GET"
                  class="row g-2 mb-4">

                <div class="col-md-9">
                    <input
                        type="text"
                        name="cari"
                        class="form-control"
                        placeholder="Cari berdasarkan nama atau NIM..."
                        value="{{ $keyword ?? request('cari') }}">
                </div>

                <div class="col-md-3 d-flex gap-2">
                    <button type="submit"
                            class="btn btn-primary w-100">
                        Cari
                    </button>

                    <a href="{{ route('mahasiswa.index') }}"
                       class="btn btn-outline-secondary w-100">
                        Reset
                    </a>
                </div>
            </form>

       
            <div class="table-responsive">
                <table class="table table-hover align-middle">

                    <thead class="table-primary">
                        <tr>
                            <th>No.</th>
                            <th>Foto</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Angkatan</th>
                            <th>SKS Lulus</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($mahasiswa as $mhs)
                            <tr>
                                <td>{{ $loop->iteration }}</td>

                        
                                <td>
                                    @if ($mhs->gambar)
                                        <img
                                            src="{{ asset('storage/' . $mhs->gambar) }}"
                                            alt="Foto {{ $mhs->nama }}"
                                            width="50"
                                            height="50"
                                            class="rounded"
                                            style="object-fit: cover;">
                                    @else
                                        <span class="text-secondary small">
                                            Belum ada foto
                                        </span>
                                    @endif
                                </td>

                                <td>{{ $mhs->nim }}</td>

                                <td class="fw-semibold">
                                    {{ $mhs->nama }}
                                </td>

                                <td>{{ $mhs->angkatan }}</td>

                                <td>{{ $mhs->sks_lulus }}</td>

                             
                                <td>
                                    @if ($mhs->status_keaktifan == 'Aktif')
                                        <span class="badge bg-success">
                                            Aktif
                                        </span>
                                    @else
                                        <span class="badge bg-secondary">
                                            Tidak Aktif
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    <div class="d-flex justify-content-center gap-2">

                                        <a href="{{ route('mahasiswa.edit', $mhs->id) }}"
                                           class="btn btn-warning btn-sm">
                                            Edit
                                        </a>

                                       <a href="{{ route('mahasiswa.show', $mhs->id) }}"
                                            class="btn btn-primary btn-sm">
                                            Detail
                                        </a>

                                        <form
                                            action="{{ route('mahasiswa.destroy', $mhs->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus data mahasiswa ini?')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-danger btn-sm">
                                                Hapus
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="8"
                                    class="text-center text-secondary py-4">

                                    @if (request('cari'))
                                        Data mahasiswa tidak ditemukan.
                                    @else
                                        Belum ada data mahasiswa.
                                    @endif

                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

           
            <p class="text-secondary small mb-0">
                Total data ditampilkan: {{ $mahasiswa->count() }} mahasiswa
            </p>

        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>