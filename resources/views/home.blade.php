@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')
    <div class="row">
        <div class="col-md-6 col-xl-4 mb-3 mb-xl-4">
            <div class="card flex-row align-items-center p-3 p-md-4">
                <div class="icon icon-lg bg-soft-primary rounded-circle mr-3">
                    <i class="gd-wallet icon-text d-inline-block text-primary"></i>
                </div>
                <div>
                    <h4 class="lh-1 mb-1">1.000.000</h4>
                    <h6 class="mb-0">Saldo</h6>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-4 mb-3 mb-xl-4">
            <div class="card flex-row align-items-center p-3 p-md-4">
                <div class="icon icon-lg bg-soft-success rounded-circle mr-3">
                    <i class="gd-arrow-up icon-text d-inline-block text-success"></i>
                </div>
                <div>
                    <h4 class="lh-1 mb-1">1.000.000</h4>
                    <h6 class="mb-0">Pemasukan</h6>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-4 mb-3 mb-xl-4">
            <div class="card flex-row align-items-center p-3 p-md-4">
                <div class="icon icon-lg bg-soft-danger rounded-circle mr-3">
                    <i class="gd-arrow-down icon-text d-inline-block text-danger"></i>
                </div>
                <div>
                    <h4 class="lh-1 mb-1">0</h4>
                    <h6 class="mb-0">Pengeluaran</h6>
                </div>
            </div>
        </div>
    </div>

    <a data-toggle="modal" data-target="#add" class="btn btn-light"><i class="gd-plus"></i> Tambah Log</a>

    <div class="table-responsive mt-4">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th class="font-weight-semi-bold border-top-0 py-2">#</th>
                    <th class="font-weight-semi-bold border-top-0 py-2">Tanggal</th>
                    <th class="font-weight-semi-bold border-top-0 py-2">Kategori</th>
                    <th class="font-weight-semi-bold border-top-0 py-2">Nominal</th>
                    <th class="font-weight-semi-bold border-top-0 py-2">Keterangan</th>
                    <th class="font-weight-semi-bold border-top-0 py-2">Status</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $num = 1;
                @endphp
                @foreach ($transactions as $transaction)
                    <tr>
                        <td class="py-3">{{ $num }}</td>
                        <td class="py-3">{{ $transaction->created_at }}</td>
                        <td class="py-3">{{ $transaction->category->name }}</td>
                        <td class="py-3">{{ $transaction->nominal }}</td>
                        <td class="py-3">{{ $transaction->description }}</td>
                        <td class="py-3">
                            @if ($transaction->is_confirmed == 0)
                                Belum dikonfirmasi
                            @else
                                Dikonfirmasi
                            @endif
                        </td>
                    </tr>
                    @php
                        $num++;
                    @endphp
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('modal')
    <div id="add" class="modal fade" role="dialog" aria-labelledby="addLabel" aria-hidden="true">
        <form action="{{ route('transaction.store') }}" method="post">
            @method('post')
            @csrf
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addLabel">Tambah Log</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="category">Pilih Kategori</label>
                            <select class="form-control" id="category" name="category">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nominal">Nominal</label>
                            <input type="text" name="nominal" id="nominal" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="description">Keterangan</label>
                            <textarea class="form-control" name="description" id="description" cols="30"
                                rows="5"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-soft-light" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-soft-primary">Tambah</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
