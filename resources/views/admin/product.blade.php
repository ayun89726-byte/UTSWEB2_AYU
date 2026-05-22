<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    @include('components.navadmin')

    <div class="container mt-4">
        
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Daftar Product</h2>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahProduct">
                Tambah Product
            </button>
        </div>

        <div class="card">
            <div class="card-header bg-light">
                <h5 class="card-title mb-0">Data Barang</h5>
                <small class="text-muted">Kelola kode, nama, satuan, dan harga barang</small>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped mt-2">
                        <thead class="table-primary">
                            <tr>
                                <th>No</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Satuan</th>
                                <th>Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $key => $row)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $row->kode_barang }}</td>
                                    <td>{{ $row->nama_barang }}</td>
                                    <td>{{ $row->satuan }}</td>
                                    <td>Rp {{ number_format($row->harga, 0, ',', '.') }}</td>
                                    <td>
                                        <form action="{{ route('product.destroy', $row->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">Belum ada data product. Silakan tambah baru!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalTambahProduct" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahLabel">Tambah Product Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('product.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Kode Barang</label>
                            <input type="text" name="kode_barang" class="form-control" placeholder="Contoh: BRG001" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Barang</label>
                            <input type="text" name="nama_barang" class="form-control" placeholder="Contoh: Sabun Mandi" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Satuan</label>
                            <input type="text" name="satuan" class="form-control" placeholder="Contoh: Pcs / Kotak" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Harga Barang</label>
                            <input type="number" name="harga" class="form-control" placeholder="Contoh: 5000" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-modal="dismiss" data-bs-dist="modal" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>