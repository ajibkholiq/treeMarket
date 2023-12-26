@extends('layout.mainAdmin')
@push('css')
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
@endpush
@section('content')
    <div class="row">

        <div class="col-md-12">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-modal"
                style="justify-items: end">Tambah Barang</button>
        </div>

        <div class="col-lg-12 " style="margin-top: 10px ;margin-bottom: 30px">

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Barang</h5>
                </div>
                <div class="card-body">
                    <table id="data-table" class="table table-bordered dt-responsive " style="width:100%">
                        <thead>

                            <tr style="text-align:center">
                                <th>Action</th>
                                <th>Gambar</th>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Deskripsi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Grids in modals -->
    <div class="modal fade" id="add-modal" tabindex="-1" aria-labelledby="exampleModalgridLabel" aria-modal="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalgridLabel">Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="javascript:void(0);" method="POST" id="formBarang" enctype="multipart/form-data">
                        @csrf
                        @method("POST")
                        <div class="row g-3">
                            <div class="col-xxl-6">
                                <div>
                                    <label for="nama" class="form-label">Nama Barang</label>
                                    <input required type="text" name="nama" class="form-control" id="nama"
                                        placeholder="Nama Barang">
                                </div>
                            </div><!--end col-->
                            <div class="col-xxl-6">
                                <div>
                                    <label for="kategori" class="form-label">Kategori</label>
                                    <select name="kategori" class="form-control" id="kategori"> 

                                    </select>
                                </div>
                            </div><!--end col-->
                            <div class="col-xxl-6">
                                <div>
                                    <label for="gambar" class="form-label">Gambar Barang</label>
                                    <input required type="file" class="form-control"  accept="image/*" id="gambar" name="gambar">
                                </div>
                            </div><!--end col-->
                            <div class="col-xxl-6">
                                <div>
                                    <label for="jumlah" class="form-label">Jumlah Barang</label>
                                    <input required type="number" name="jumlah" class="form-control" id="jumlah"
                                        placeholder="Masukan Jumlah Barang">
                                </div>
                            </div><!--end col-->
                            
                            <div class="col-xxl-6">
                                <div>
                                    <label for="harga" class="form-label">Harga Barang</label>
                                    <input required type="number" name="harga" class="form-control" id="harga"
                                        placeholder="Masukan Harga Barang">
                                </div>
                            </div><!--end col-->
                            <!-- Example Textarea -->
                            <div>
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4"></textarea>
                            </div>
                            <div class="col-lg-12">
                                <div class=" gap-2 justify-content-end">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div><!--end col-->
                        </div><!--end row-->
                    </form>
                </div>
                
            </div>
        </div>
    </div>
    <div class="modal fade" id="edit-modal" tabindex="-1" aria-labelledby="exampleModalgridLabel" aria-modal="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalgridLabel">Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="javascript:void(0);" method="POST" id="editBarang" enctype="multipart/form-data">
                        @csrf
                        @method("PUT")
                        <div class="row g-3">
                            <div class="col-xxl-6">
                                <div>
                                    <label for="nama" class="form-label">Nama Barang</label>
                                    <input required type="text" name="nama" class="form-control" id="namaedt"
                                        placeholder="Nama Barang">
                                </div>
                            </div><!--end col-->
                            <div class="col-xxl-6">
                                <div>
                                    <label for="kategori" class="form-label">Kategori</label>
                                    <select name="kategori" class="form-control" id="kategoriedt"> 

                                    </select>
                                </div>
                            </div><!--end col-->
                            <div class="col-xxl-6">
                                <div>
                                    <label for="gambar" class="form-label">Gambar Barang</label>
                                    <input type="file" class="form-control" id="gambaredt" accept="image/*" name="gambar">
                                </div>
                            </div><!--end col-->
                            <div class="col-xxl-6">
                                <div>
                                    <label for="jumlah" class="form-label">Jumlah Barang</label>
                                    <input required type="number" name="jumlah" class="form-control" id="jumlahedt"
                                        placeholder="Masukan Jumlah Barang">
                                </div>
                            </div><!--end col-->
                            <input type="hidden" id="uuid">
                            <div class="col-xxl-6">
                                <div>
                                    <label for="harga" class="form-label">Harga Barang</label>
                                    <input required type="number" name="harga" class="form-control" id="hargaedt"
                                        placeholder="Masukan Harga Barang">
                                </div>
                            </div><!--end col-->
                            <!-- Example Textarea -->
                            <div>
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea class="form-control" id="deskripsiedt" name="deskripsi" rows="4"></textarea>
                            </div>
                            <div class="col-lg-12">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" id="edit">Simpan</button>
                                </div>
                            </div><!--end col-->
                        </div><!--end row-->
                    </form>
                </div>
                
            </div>
        </div>
    </div>
@endsection
@push('js')
   
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="assets/js/pages/datatables.init.js"></script>
    <script src="{{ url('js/barang.js') }}"></script>
@endpush
