@extends('layouts.dashboard')

@section('title', 'Kategori')

@section('content')
    <div class="row">
        <div class="col-8">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th class="font-weight-semi-bold border-top-0 py-2">#</th>
                            <th class="font-weight-semi-bold border-top-0 py-2">Kategori</th>
                            <th class="font-weight-semi-bold border-top-0 py-2">Tipe</th>
                            <th class="font-weight-semi-bold border-top-0 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $num = 1;
                        @endphp
                        @foreach ($categories as $category)
                            <tr>
                                <td class="py-3">{{ $num }}</td>
                                <td class="py-3">{{ Str::title($category->name) }}</td>
                                <td class="py-3">{{ Str::title($category->type) }}</td>
                                <td class="py-3">
                                    <a class="btn btn-sm btn-soft-success" data-toggle="modal"
                                        data-target="#edit{{ $category->id }}">Ubah</a>
                                    <a class="btn btn-sm btn-soft-danger" data-toggle="modal"
                                        data-target="#delete{{ $category->id }}">Hapus</a>
                                </td>
                            </tr>
                            @php
                                $num++;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="h6 font-weight-semi-bold text-uppercase mb-0">Buat Category</h5>
                </div>
                <div class="card-body pt-0">
                    <form action="{{ route('admin.category.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nama Kategori</label>
                            <input type="text" name="name" id="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="transactionType">Tipe Transaksi</label>
                            <div class="form-check" id="transactionType">
                                <input class="form-check-input" type="radio" name="type" id="pemasukan" value="pemasukan">
                                <label class="form-check-label" for="type">
                                    Pemasukan
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="type" id="pengeluaran"
                                    value="pengeluaran">
                                <label class="form-check-label" for="type">
                                    Pengeluaran
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-sm btn-soft-primary">Buat</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    @foreach ($categories as $category)
        <div id="edit{{ $category->id }}" class="modal fade" role="dialog"
            aria-labelledby="edit{{ $category->id }}Label" aria-hidden="true">
            <form action="{{ route('admin.category.update', [$category->id]) }}" method="post">
                @method('put')
                @csrf
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="edit{{ $category->id }}Label">Update Kategori</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Nama Kategori</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $category->name }}">
                            </div>
                            <div class="form-group">
                                <label for="transactionType">Tipe Transaksi</label>
                                <div class="form-check" id="transactionType">
                                    <input class="form-check-input" type="radio" name="type" id="pemasukan" value="pemasukan">
                                    <label class="form-check-label" for="type">
                                        Pemasukan
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="type" id="pengeluaran"
                                        value="pengeluaran">
                                    <label class="form-check-label" for="type">
                                        Pengeluaran
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-soft-light" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-soft-success">Update</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div id="delete{{ $category->id }}" class="modal fade" role="dialog"
            aria-labelledby="delete{{ $category->id }}Label" aria-hidden="true">
            <form action="{{ route('admin.category.destroy', [$category->id]) }}" method="post">
                @method('delete')
                @csrf
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="delete{{ $category->id }}Label">Hapus Kategori</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Apakah Anda setuju menghapus kategori <strong>{{ $category->name }}</strong> ?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-soft-light" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-soft-danger">Hapus</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    @endforeach
@endsection
