<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TES TAMBAH BARANG</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: lightblue;
        }
        .container {
            max-width: 900px;
        }
        .card-body {
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="col-md-12">
            <div>
                <h3 class="text-center my-4">TAMBAHKAN PEMINJAMAN BARANG</h3>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group mb-3">
        <label class="font-weight-bold">Foto</label>
        <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">
        @error('image')
            <div class="alert alert-danger mt-2">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="form-group mb-3">
        <label class="font-weight-bold">Nama</label>
        <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama') }}" placeholder="Masukkan Nama Barang">
        @error('nama')
            <div class="alert alert-danger mt2">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="form-group mb-3">
        <label class="font-weight-bold">DESCRIPTION</label>
        <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="3" placeholder="Masukkan Description barang">{{ old('description') }}</textarea>
        @error('description')
            <div class="alert alert-danger mt-2">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label class="font-weight-bold">Waktu Dipinjam</label>
                <input type="datetime-local" class="form-control @error('waktu_dipinjam') is-invalid @enderror" name="waktu_dipinjam" value="{{ old('waktu_dipinjam') }}" placeholder="Pilih Waktu Dipinjam">
                @error('waktu_dipinjam')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label class="font-weight-bold">Jumlah Barang</label>
                <input type="number" class="form-control @error('stock') is-invalid @enderror" name="stock" value="{{ old('stock') }}" placeholder="Masukkan Jumlah Barang">
                @error('stock')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-start mt-3">
        <button type="submit" class="btn btn-md btn-primary me-3">SAVE</button>
        <a class="btn btn-danger" href="{{ route('products.index') }}">Cancel</a>
    </div>
</form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
