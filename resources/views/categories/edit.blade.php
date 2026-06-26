<x-appadmin-layout>
    <div class="container mt-4">
        <div class="mb-3">
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm border-0 p-4">
                <h5 class="fw-bold mb-1">Edit Kategori</h5>
                <p class="text-muted mb-3">Ubah data kategori</p>

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-bold">Kode Kategori</label>
                        <input type="text" name="kode_kategori" class="form-control"
                               value="{{ old('kode_kategori', $category->kode_kategori) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Kategori</label>
                        <input type="text" name="nama_kategori" class="form-control"
                               value="{{ old('nama_kategori', $category->nama_kategori) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="3">{{ old('deskripsi', $category->deskripsi) }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary px-4">Update</button>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary px-4">Batal</a>
                </form>
            </div>
        </div>
    </div>
</x-appadmin-layout>