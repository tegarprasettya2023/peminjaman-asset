<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Peminjaman Barang</title>
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
        .custom-file-input {
            border: 1px solid #ced4da;
            border-radius: .25rem;
            padding: .375rem .75rem;
        }
        #currentImage {
            max-width: 150px;
            height: auto;
            display: block;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="col-md-12">
            <h3 class="text-center my-4">Edit Peminjaman Barang</h3>
            <hr>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT') <!-- Gunakan PUT untuk pembaruan data -->
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="imageInput" class="form-label">Foto</label>
                                        <div class="mb-3">
                                            @if($product->image)
                                                <img id="currentImage" src="{{ asset('storage/products/' . $product->image) }}" alt="Product Image">
                                            @endif
                                        </div>
                                        <input type="file" name="image" id="imageInput" class="form-control @error('image') is-invalid @enderror custom-file-input">
                                        @error('image')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group mb-3">
                                        <label for="nama" class="form-label">Nama</label>
                                        <input type="text" id="nama" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama', $product->nama) }}" placeholder="Masukkan Nama Peminjam">
                                        @error('nama')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" rows="3" placeholder="Masukkan Description barang">{{ old('description', $product->description) }}</textarea>
                                        @error('description')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="waktu_dipinjam" class="form-label">Waktu Dipinjam</label>
                                                <input type="datetime-local" id="waktu_dipinjam" class="form-control @error('waktu_dipinjam') is-invalid @enderror" name="waktu_dipinjam" value="{{ old('waktu_dipinjam', $product->waktu_dipinjam) }}">
                                                @error('waktu_dipinjam')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="stock" class="form-label">Jumlah Barang</label>
                                                <input type="number" id="stock" class="form-control @error('stock') is-invalid @enderror" name="stock" value="{{ old('stock', $product->stock) }}" placeholder="Masukkan Jumlah Barang">
                                                @error('stock')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-start mt-3">
                                <button type="submit" class="btn btn-primary me-3">SAVE</button>
                                <a class="btn btn-danger" href="{{ route('products.index') }}">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('imageInput').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const imageElement = document.getElementById('currentImage');
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    if (imageElement) {
                        imageElement.src = e.target.result;
                    } else {
                        const newImage = document.createElement('img');
                        newImage.id = 'currentImage';
                        newImage.src = e.target.result;
                        newImage.alt = 'Product Image';
                        newImage.style.maxWidth = '150px';
                        newImage.style.height = 'auto';
                        document.querySelector('.form-group.mb-3').appendChild(newImage);
                    }
                }
                reader.readAsDataURL(file);
            } else {
                if (imageElement) {
                    imageElement.src = '';  // Clear the image if no file is selected
                }
            }
        });
    </script>
</body>
</html>
