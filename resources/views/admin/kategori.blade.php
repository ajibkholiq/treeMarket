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
                style="justify-items: end">Tambah Kategori</button>
        </div>

        <div class="col-lg-12 " style="margin-top: 10px ;margin-bottom: 30px">

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Kategori</h5>
                </div>
                <div class="card-body">
                    <table id="data-table" class="table table-bordered dt-responsive " style="width:100%">
                        <thead>

                            <tr style="">
                                <th style="width: 20px;" class="text-center" >Action</th>
                                <th>Nama</th>
                                <th >Remark</th>
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
                    <h5 class="modal-title" id="exampleModalgridLabel">Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="javascript:void(0);" method="POST" id="formBarang" enctype="multipart/form-data">
                        @csrf
                        @method("POST")
                        <div class="row g-3">
                            <div class="col-xxl-6">
                                <div>
                                    <label for="nama" class="form-label">Kategori</label>
                                    <input required type="text" name="nama" class="form-control" id="nama"
                                        placeholder="Kategori">
                                </div>
                            </div><!--end col-->
                            <div class="col-xxl-6">
                                <div>
                                    <label for="remark" class="form-label">Remark</label>
                                    <input required type="text" name="remark" class="form-control" id="remark"
                                        placeholder="Remark">
                                </div>
                            </div><!--end col-->
                       
                            <div class="col-lg-12">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Keluar</button>
                                    <button type="submit" class="btn btn-primary" >Tambah</button>
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
                    <h5 class="modal-title" id="exampleModalgridLabel">Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="javascript:void(0);" method="POST" id="editBarang" enctype="multipart/form-data">
                        @csrf
                        @method("PUT")
                        <input required type="hidden" name="uuid" id="uuid">
                        <div class="row g-3">
                            <div class="col-xxl-6">
                                <div>
                                    <label for="nama" class="form-label">Kategori</label>
                                    <input required type="text" name="nama" class="form-control" id="namae"
                                        placeholder="Kategori">
                                </div>
                            </div><!--end col-->
                            <div class="col-xxl-6">
                                <div>
                                    <label for="remark" class="form-label">Remark</label>
                                    <input required type="text" name="remark" class="form-control" id="remarke"
                                        placeholder="Remark">
                                </div>
                            </div><!--end col-->
                       
                            <div class="col-lg-12">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Keluar</button>
                                    <button type="button" id="edit" class="btn btn-primary" data-bs-dismiss="modal">Simpan</button>
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
    <script src="{{ url('js/kategori.js') }}"></script>
@endpush
