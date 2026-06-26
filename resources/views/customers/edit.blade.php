<x-app-layout>
    <div class="container mt-4">
        <div class="mb-3">
            <a href="{{ route('admin.customers.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
        </div>

        <div class="col-md-6">
            <x-card title="Edit Customer" subtitle="Ubah data pelanggan">
                <form action="{{ route('admin.customers.update', $customer->id) }}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Customer</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $customer->name }}">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email Customer</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ $customer->email }}">
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Customer</label>
                        <input type="number" name="phone" id="phone" class="form-control" value="{{ $customer->phone }}">
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat Customer</label>
                        <input type="text" name="alamat" id="alamat" class="form-control" value="{{ $customer->alamat }}">
                    </div>

                    <button type="submit" class="btn btn-primary">Update Customer</button>
                </form>
            </x-card>
        </div>
    </div>
</x-app-layout>