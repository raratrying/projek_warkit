<div>
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <form wire:submit="generateReport">
                        <div class="form-row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Tanggal Mulai <span class="text-danger">*</span></label>
                                    <input wire:model="start_date" type="date" class="form-control" name="start_date">
                                    @error('start_date')
                                    <span class="text-danger mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Tanggal Berakhir <span class="text-danger">*</span></label>
                                    <input wire:model="end_date" type="date" class="form-control" name="end_date">
                                    @error('end_date')
                                    <span class="text-danger mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Pelanggan</label>
                                    <select wire:model="customer_id" class="form-control" name="customer_id">
                                        <option value="">Pilih Pelanggan</option>
                                        @foreach($customers as $customer)
                                            <option value="{{ $customer->id }}">{{ $customer->customer_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select wire:model="sale_return_status" class="form-control" name="sale_return_status">
                                        <option value="">Pilih Status</option>
                                        <option value="Pending">Diproses</option>
                                        <option value="Shipped">Pengiriman</option>
                                        <option value="Completed">Selesai</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Status Pembayaran</label>
                                    <select wire:model="payment_status" class="form-control" name="payment_status">
                                        <option value="">Pilih Status Pembayaran</option>
                                        <option value="Paid">Dibayar</option>
                                        <option value="Unpaid">Belum Dibayar</option>
                                        <option value="Partial">Sebagian</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary">
                                <span wire:target="generateReport" wire:loading class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                <i wire:target="generateReport" wire:loading.remove class="bi bi-shuffle"></i>
                                Cari Laporan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <table class="table table-bordered table-striped text-center mb-0">
                        <div wire:loading.flex class="col-12 position-absolute justify-content-center align-items-center" style="top:0;right:0;left:0;bottom:0;background-color: rgba(255,255,255,0.5);z-index: 99;">
                            <div class="spinner-border text-primary" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                        <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Referensi</th>
                            <th>Pemasok</th>
                            <th>Status</th>
                            <th>Jumlah</th>
                            <th>Dibayar</th>
                            <th>Alasan</th>
                            <th>Status Pembayaran</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($sale_returns as $sale_return)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($sale_return->date)->format('d M, Y') }}</td>
                                <td>{{ $sale_return->reference }}</td>
                                <td>{{ $sale_return->customer_name }}</td>
                                <td>
                                    @if ($sale_return->status == 'Pending')
                                        <span class="badge badge-info">
                                            {{ $sale_return->status }}
                                        </span>
                                            @elseif ($sale_return->status == 'Shipped')
                                                <span class="badge badge-primary">
                                            {{ $sale_return->status }}
                                        </span>
                                            @else
                                                <span class="badge badge-success">
                                            {{ $sale_return->status }}
                                        </span>
                                    @endif
                                </td>
                                <td>{{ format_currency($sale_return->total_amount) }}</td>
                                <td>{{ format_currency($sale_return->paid_amount) }}</td>
                                <td>{{ format_currency($sale_return->due_amount) }}</td>
                                <td>
                                    @if ($sale_return->payment_status == 'Partial')
                                        <span class="badge badge-warning">
                                    {{ $sale_return->payment_status }}
                                </span>
                                    @elseif ($sale_return->payment_status == 'Paid')
                                        <span class="badge badge-success">
                                    {{ $sale_return->payment_status }}
                                </span>
                                    @else
                                        <span class="badge badge-danger">
                                    {{ $sale_return->payment_status }}
                                </span>
                                    @endif

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8">
                                    <span class="text-danger">Tidak Ada Data Pengembalian Penjualan Yang Tersedia</span>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <div @class(['mt-3' => $sale_returns->hasPages()])>
                        {{ $sale_returns->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
