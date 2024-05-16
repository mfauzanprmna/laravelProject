@extends('layout/layout')

@section('content')
<div class="container pt-5">


    <form action="{{ route('barang.import') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="file" name="file" class="form-control">

        <br>
        <button class="btn btn-success"><i class="fa fa-file"></i> Import Barang Data</button>
    </form>
    <div class="mt-2">
        <a href="{{ route('barang.tambah') }}" class="btn btn-success mb-2">Tambah Data</a>
        <a href="{{ route('barang.export') }}" class="btn btn-success mb-2">Export Excel</a>
    </div>
    <div class="card">
        <div class="card-header bg-info text-white">
            <h4 class="card-title">Data Barang</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Barang</th>
                            <th>Qty</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($data as $isi) { ?>
                            <tr>
                                <td>{{ $no }}</td>
                                <td>{{ $isi->nama_barang }}</td>
                                <td>{{ $isi->qty }}</td>
                                <td>Rp{{ number_format($isi->harga_beli) }},-</td>
                                <td>Rp{{ number_format($isi->harga_jual) }},-</td>
                                <td>
                                    <a href="{{ route('barang.edit', $isi->id) }}" class="btn btn-success">
                                        Edit</a>
                                    <a href="{{ route('barang.destroy', $isi->id) }}" onclick="javascript:return confirm('Apakah ingin menghapus data barang ?')" class="btn btn-danger">
                                        Hapus</a>

                                </td>
                            </tr>
                        <?php $no++;
                        } ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>
@endsection