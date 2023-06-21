@extends('admin.template.main')

@section('css')
    <link href="{{ asset('vendor/datatables-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/datatables-responsive/css/responsive.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('main-content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Input Transaksi</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @elseif (session('warning'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            {{ session('warning') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @elseif (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.transactions.session.store') }}" method="post">
                                @csrf
                                <div class="form-group row">
                                    <label for="id-member" class="col-sm-2 col-form-label">ID Member</label>
                                    <div class="col-sm-2">
                                        <input type="number" min="1" class="form-control" id="id-member"
                                            name="member-id"
                                            @if (isset($memberIdSessionTransaction)) value="{{ $memberIdSessionTransaction }}"
                                        disabled title="Harap selesaikan transaksi yang ada untuk mengganti id member" @endif
                                            required>
                                    </div>
                                    <div class="col-sm-2">
                                        <button id="#" class="btn btn-success" data-toggle="modal"
                                            data-target="#cariMember">Cari Kontak</button>
                                    </div>
                                </div>
                                <div class="form-group row namaMembers" style="">
                                    <label for="barang" class="col-sm-2 col-form-label">Nama Member</label>
                                    <div class="col-sm-4">
                                        <input type="text" min="1" class="form-control" id="namaMember"
                                            name="namaMember" value="" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="barang" class="col-sm-2 col-form-label">Jasa Kebersihan</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" id="barang" name="item">
                                            @foreach ($items as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="servis" class="col-sm-2 col-form-label">Jenis Tempat</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" id="servis" name="service">
                                            @foreach ($services as $service)
                                                <option value="{{ $service->id }}">{{ $service->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" id="kategori" name="category">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="banyak" class="col-sm-2 col-form-label">Durasi</label>
                                    <div class="col-sm-2">
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <button type="button" class="quantity-left-minus btn btn-danger btn-number"
                                                    data-type="minus" data-field="">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                            </span>
                                            <input type="text" id="quantity" name="quantity"
                                                class="form-control input-number" value="2" min="2"
                                                max="100">
                                            <span class="input-group-btn">
                                                <button type="button"
                                                    class="quantity-right-plus btn btn-success btn-number" data-type="plus"
                                                    data-field="">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <button type="submit" id="tambah-transaksi" class="btn btn-primary">Tambah
                                            Transaksi</button>
                                    </div>
                                </div>
                            </form>
                            <table id="tbl-input-transaksi" class="table mt-2 dt-responsive nowrap" style="width: 100%">
                                <thead class="thead-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Pilihan Layanan</th>
                                        <th>Jenis Tempat</th>
                                        <th>Kategori</th>
                                        <th>Biaya</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($sessionTransaction))
                                        @foreach ($sessionTransaction as $transaction)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $transaction['itemName'] }}</td>
                                                <td>{{ $transaction['serviceName'] }}</td>
                                                <td>{{ $transaction['categoryName'] }}</td>
                                                {{-- <td>{{ $transaction['quantity'] }}</td> --}}
                                                <td>{{ $transaction['subTotal'] }}</td>
                                                <td>
                                                    <a href="{{ route('admin.transactions.session.destroy', ['rowId' => $transaction['rowId']]) }}"
                                                        class="btn btn-danger">Hapus</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            @if (isset($sessionTransaction))
                                <button id="btn-bayar" class="btn btn-success" data-toggle="modal"
                                    data-target="#paymentModal">Bayar</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>

    {{-- Modal Cari Kontak Pelanggan --}}
    <div class="modal fade" id="cariMember" tabindex="-1" role="dialog" aria-labelledby="addItemModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addItemModalLabel">Cari Member</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table id="daftarMember" class="table dt-responsive nowrap" style="width: 100%">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th hidden>ID Member</th>
                                <th>Nama Member</th>
                                <th>No Telp</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($members as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td hidden>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->phone_number }}</td>
                                    <td>{{ $item->address }}</td>
                                    <td><button type="submit" class="btn btn-primary kirimDataButton" id="kirimData"
                                            data-id="{{ $item->id }}" data-name="{{ $item->name }}">Pilih</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modals')
    <x-admin.modals.payment-modal :$serviceTypes :vouchers="$vouchers ?? []" :totalPrice="$totalPrice ?? '0'" :show="isset($sessionTransaction)" />
@endsection

@section('scripts')
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#tbl-input-transaksi').DataTable({
                "searching": false,
                "bPaginate": false,
                "bLengthChange": false,
                "bFilter": false,
                "bInfo": false
            });
            $('#daftarMember').DataTable();
        
        
            // Menampilkan data dalam DataTables
            let dataMember = $('#daftarMember').DataTable();

            // Mengiirmkan data dari datatables ke input
            let kirimDataButtons = document.getElementsByClassName('kirimDataButton');

            for (let i = 0; i < kirimDataButtons.length; i++) {
                kirimDataButtons[i].onclick = function() {
                    // Dapatkan baris yang terkait dengan tombol yang diklik
                    let row = this.closest('tr');

                    // Dapatkan data dari setiap sel dalam baris
                    let idMember = row.cells[1].textContent;
                    let namaMember = row.cells[2].textContent;
                 

                    // Set nilai pada elemen input
                    document.getElementById('id-member').value = idMember;
                    document.getElementById('namaMember').value = namaMember;
                    
                   
                };
            }



        });
    </script>
    <script></script>

    @if (session('id_trs'))
        <script type="text/javascript">
            window.open('{{ route('admin.transactions.print.index', ['transaction' => session('id_trs')]) }}', '_blank');
        </script>
    @endif
@endsection
