@extends('layouts.dashboard')

@section('title', 'Log Transaksi')

@section('content')
    <div class="table-responsive mt-4">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th class="font-weight-semi-bold border-top-0 py-2">#</th>
                    <th class="font-weight-semi-bold border-top-0 py-2">Tanggal</th>
                    <th class="font-weight-semi-bold border-top-0 py-2">Kategori</th>
                    <th class="font-weight-semi-bold border-top-0 py-2">Nominal</th>
                    <th class="font-weight-semi-bold border-top-0 py-2">Status</th>
                    <th class="font-weight-semi-bold border-top-0 py-2">Aksi</th>
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
                        <td class="py-3">
                            @if ($transaction->is_confirmed == 0)
                                Belum dikonfirmasi
                            @else
                                Dikonfirmasi
                            @endif
                        </td>
                        <td class="py-3">
                            <a class="btn btn-sm btn-soft-success" data-toggle="modal"
                                data-target="#edit{{ $transaction->id }}">Ubah</a>
                            <a class="btn btn-sm btn-soft-danger" data-toggle="modal"
                                data-target="#delete{{ $transaction->id }}">Hapus</a>
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
    @foreach ($transactions as $transaction)
        <div id="edit{{ $transaction->id }}" class="modal fade" role="dialog"
            aria-labelledby="edit{{ $transaction->id }}Label" aria-hidden="true">
            <form action="{{ route('admin.transaction.update', [$transaction->id]) }}" method="post">
                @method('put')
                @csrf
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="edit{{ $transaction->id }}Label">Update Transaksi</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="date">Tanggal</label>
                                <input type="text" name="date" id="date" class="form-control"
                                    value="{{ $transaction->created_at }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="category">Kategori</label>
                                <input type="text" name="category" id="category" class="form-control"
                                    value="{{ $transaction->category->name }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="nominal">Nominal</label>
                                <input type="text" name="nominal" id="nominal" class="form-control"
                                    value="{{ $transaction->nominal }}">
                            </div>
                            <div class="form-group">
                                <label for="confirmation">Konfirmasi?</label>
                                <div class="form-check" id="confirmation">
                                    <input class="form-check-input" type="radio" name="confirmation" id="confirmation1"
                                        value="0" checked>
                                    <label class="form-check-label" for="confirmation">
                                        Jangan
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="confirmation" id="confirmation2"
                                        value="1">
                                    <label class="form-check-label" for="confirmation">
                                        Konfirmasi
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
        <div id="delete{{ $transaction->id }}" class="modal fade" role="dialog"
            aria-labelledby="delete{{ $transaction->id }}Label" aria-hidden="true">
            <form action="{{ route('admin.transaction.destroy', [$transaction->id]) }}" method="post">
                @method('delete')
                @csrf
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="delete{{ $transaction->id }}Label">Hapus Kategori</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Apakah Anda setuju menghapus transaksi <strong>{{ $transaction->category->name }} pada
                                {{ $transaction->created_at }}</strong> ?
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
