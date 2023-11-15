@extends('layout.master')

@section('title', 'index')

@section('content')
    <div class="container mt-5">
        <h1>Data Buku</h1>
        <div class="d-flex align-items-center my-3">
            <div class="flex-fill me-2">
                @if (Session::has('pesan'))
                    <div class="alert alert-success py-2 px-3 m-0">{{ Session::get('pesan') }}</div>
                @endif
                @if (count($data_buku))
                    <div class="alert alert-success py-2 px-3 m-0">Ditemukan <strong>{{ count($data_buku) }}</strong> buku dengan kata <strong>{{ $cari }}</strong></div> 
                @else
                    <div class="d-flex">
                        <div class="alert alert-warning flex-grow-1 py-2 px-3 m-0">Data {{ $cari }} tidak ditemukan</div>
                        <a href="/buku" class="btn btn-warning ms-2">Kembali</a>
                    </div>
                @endif
            </div>
            <form action="{{ route('buku.search') }}" method="get">
                @csrf
                <div class="input-group">
                    <input type="text" name="kata" class="form-control border-primary flex-fill" placeholder="Cari...">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i></button>
                </div>
            </form>
            <a href="{{ route('buku.create') }}" class="btn btn-primary ms-2">Tambah Buku</a>
        </div>
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>id</th>
                    <th>Judul buku</th>
                    <th>Penulis</th>
                    <th>Tgl. Terbit</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data_buku as $buku)
                    <tr>
                        <td>{{ ++$no }}</td>
                        <td>{{ $buku->judul }}</td>
                        <td>{{ $buku->penulis }}</td>
                        <td>{{ date('d/m/y', strtotime($buku->tgl_terbit)) }}</td>
                        <td>{{ "Rp".number_format($buku->harga, 0, ',', '.') }}</td>
                        <td>
                            <div class="d-flex">
                                <form method="POST" action="{{ route('buku.edit', $buku->id) }}" class="me-2">
                                    @csrf
                                    <button class="btn btn-warning">Update</button>
                                </form>
                                <form method="POST" action="{{ route('buku.destroy', $buku->id) }}">
                                    @csrf
                                    <button onclick="return confirm('Yakiiin?')" class="btn btn-danger">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div>{{ $data_buku->links() }}</div>
    </div>
@endsection