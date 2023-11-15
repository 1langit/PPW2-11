@extends('layout.master')

@section('title', 'create')

@section('content')
    <div class="container mt-5 mb-3">
        <h4 class="mb-4">Tambah Buku</h4>
        @if (count($errors) > 0)
            <ul class="alert alert-danger px-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <form method="POST" action="{{ route('buku.store') }}" enctype="multipart/form-data">
            @csrf
            <table>
                <tr><td>Judul buku</td><td><input type="text" name="judul" class="w-100 ms-5 px-1"></td></tr>
                <tr><td>Penulis</td><td><input type="text" name="penulis" class="w-100 ms-5 px-1"></td></tr>
                <tr><td>Tanggal terbit</td><td><input type="date" name="tgl_terbit" class="w-100 ms-5 px-1" placeholder="yyyy/mm/dd"></td></tr>
                <tr><td>Harga</td><td><input type="text" name="harga" class="w-100 ms-5 px-1"></td></tr>
                <tr><td>Thumbnail</td><td><input type="file" name="thumbnail" class="form-control border-dark rounded-0 w-100 ms-5 py-1"></td></tr>
            </table>
            <h4 class="my-4">Gallery</h4>
            <div class="row mt-2">
                <div class="col-auto">
                    <a href="javascript:void(0);" id="tambah" onclick="addFileInput()" class="btn btn-secondary rounded-0 m-0">Tambah</a>
                </div>
                <div class="col">
                    <div class="w-100 my-1" id="fileinput_wrapper"></div>
                </div>
            </div>
            <div class="d-flex justify-content-end mt-1">
                <button class="btn btn-primary rounded-0 me-2" type="submit">Simpan</button>
                <a href="/dashboard" class="btn btn-danger rounded-0">Batal</a>
            </div>
        </form>
    </div>

    <script type="text/javascript">
        function addFileInput () {
            var div = document.getElementById('fileinput_wrapper');
            div.innerHTML += '<input type="file" name="gallery[]" id="gallery" class="form-control border-dark rounded-0 w-25 mb-1 py-1">';
        };
    </script>
@endsection