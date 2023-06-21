<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Transaksi</title>
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/css/adminlte.min.css') }}">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mt-5">
                <h4 style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif">SweepSouth</h4>
                <h5>Bukti Pemesanan</h5>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-6">
                <table class="table">
                    <tbody>
                      <tr>
                        <td>No Transaksi</td>
                        <td>{{ $transaction->id }}</td>
                      </tr>
                      <tr>
                        <td>Nama</td>
                        <td><b>{{ $transaction->member->name }}</b></td>
                      </tr>
                      <tr>
                        <td>Alamat</td>
                        <td>{{ $transaction->member->address }}</td>
                      </tr>
                      <tr>
                        <td>No.Telepon</td>
                        <td><b>{{ $transaction->member->phone_number }}</b></td>
                      </tr>
                    </tbody>
                  </table>
                  

            </div>
            <div class="col-6 text-right">
                <p>{{ date('d F Y', strtotime($transaction->created_at)) }}</p>
                <p>Jam Pengerjaan : {{ date( 'H:i', strtotime($transaction->update_at)) }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table table-bordered">
                    <thead class="">
                        <tr>
                            <th>No</th>
                            <th>Layanan Kebersihan</th>
                            <th>Jenis Tempat</th>
                            <th>Kategori</th>
                            <th>Durasi</th>
                            <th>Tarif</th>
                            <th>Biaya Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $tot = 0;
                        @endphp

                        @foreach ($transaction->transaction_details as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->price_list->item->name }}</td>
                                <td>{{ $item->price_list->service->name }}</td>
                                <td>{{ $item->price_list->category->name }}</td>
                                <td>{{ $item->quantity }} Jam</td>
                                <td>{{ $item->getFormattedPrice() }}</td>
                                <td>{{ $item->getFormattedSubTotal() }}</td>
                            </tr>
                            @php
                                $tot += $item->sub_total;
                            @endphp
                        @endforeach

                        <tr>
                            <td colspan="6" class="text-center"><b>Sub Total Harga</b></td>
                            <td>{{ 'Rp ' . number_format($tot, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td colspan="6" class="text-center"><b>{{ $transaction->service_type->name }}</b></td>
                            <td>{{ $transaction->getFormattedServiceCost() }}</td>
                        </tr>
                        <tr>
                            <td colspan="6" class="text-center"><b>Potongan</b></td>
                            <td>- {{ $transaction->discount }}</td>
                        </tr>
                        <tr>
                            <td colspan="6" class="text-center"><b>Total</b></td>
                            <td><b>{{ $transaction->getFormattedTotal() }}</b></td>
                        </tr>
                        <tr>
                            <td colspan="6" class="text-center"><b>Dibayar</b></td>
                            <td><b>{{ $transaction->getFormattedPaymentAmount() }}</b></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-4 text-center">
                <p>Tangerang Selatan, {{ date('d F Y') }}</p>
                <br>
                <br>
                <br>
                <p>{{ $transaction->admin->name }}</p>
            </div>
            <div class="col-4"></div>
            <div class="col-4 text-center">
                <p>Tangerang Selatan, {{ date('d F Y') }}</p>
                <br>
                <br>
                <br>
                <p>{{ $transaction->member->name }}</p>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        window.print();
    </script>
</body>

</html>
