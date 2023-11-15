@extends('layout.master')

@section('title', 'index')

@section('content')
    <div class="container">
        <h1>Data Buku</h1>
        <div class="d-flex align-items-center my-3">
            <div class="flex-fill me-2">
                @if (Session::has('pesan'))
                    <div class="alert alert-success py-2 px-3 m-0">{{ Session::get('pesan') }}</div>
                @endif
            </div>
            <form action="{{ route('buku.search') }}" method="get">
                @csrf
                <div class="input-group">
                    <input type="text" name="kata" class="form-control flex-fill rounded-0" placeholder="Cari...">
                    <button type="submit" class="btn btn-primary rounded-0"><i class="bi bi-search"></i></button>
                </div>
            </form>
            @if (Auth::check() && Auth::user()->level == 'admin')
                <a href="{{ route('buku.create') }}" class="btn btn-primary rounded-0 ms-2">Tambah Buku</a>
            @endif
        </div>
        <table class="table table-hover text-center">
            <thead class="table-primary">
                <tr>
                    <th>id</th>
                    <th>Buku</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Tgl. Terbit</th>
                    <th>Harga</th>
                    @if (Auth::check() && Auth::user()->level == 'admin')
                        <th>Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($data_buku as $buku)
                    <tr>
                        <td>{{ ++$no }}</td>
                        <td>
                            @if ($buku->filepath)
                                <div class="relative h-10 w-10">
                                    <img class="object-center" src="{{ asset($buku->filepath) }}" alt="thumbnail">
                                </div>
                            @endif
                        </td>
                        <td>{{ $buku->judul }}</td>
                        <td>{{ $buku->penulis }}</td>
                        <td>{{ date('d/m/y', strtotime($buku->tgl_terbit)) }}</td>
                        <td>{{ "Rp".number_format($buku->harga, 0, ',', '.') }}</td>
                        @if (Auth::check() && Auth::user()->level == 'admin')
                            <td>
                                <div class="d-flex justify-content-center">
                                    <form method="POST" action="{{ route('buku.edit', $buku->id) }}" class="me-2">
                                        @csrf
                                        <button class="btn btn-warning rounded-0">Update</button>
                                    </form>
                                    <form method="POST" action="{{ route('buku.destroy', $buku->id) }}">
                                        @csrf
                                        <button onclick="return confirm('Yakiiin?')" class="btn btn-danger rounded-0">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
        <strong>{{ "Jumlah data: ".$jumlah_data }} buku</strong>
        <p>{{ "Total harga: Rp".number_format($total_harga, 2, ',', '.') }}</p>
        <div>{{ $data_buku->links() }}</div>
    </div>
@endsection