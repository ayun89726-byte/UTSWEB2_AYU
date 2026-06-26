<x-appadmin-layout>
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h2 fw-bold">Manajemen Produk</h1>
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary">+ Tambah Produk</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Satuan</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                            <th>Kategori</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $key => $product)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td><span class="badge bg-light text-danger border">{{ $product->kode_barang }}</span></td>
                            <td>{{ $product->nama_barang }}</td>
                            <td><span class="badge bg-info text-dark">{{ $product->satuan }}</span></td>
                            <td>Rp {{ number_format($product->harga, 0, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning btn-sm text-white">Edit</a>
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</button>
                                </form>
                            </td>
                            <td>
                                @if($product->category)
                                    <span class="badge bg-secondary">{{ $product->category->nama_kategori }}</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">Belum ada data produk</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-appadmin-layout>