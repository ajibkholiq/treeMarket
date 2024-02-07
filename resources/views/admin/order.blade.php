@extends('layout.mainAdmin')
@push('css')
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
@endpush
@section('content')
<div class="modal fade modal-md" id="detail-modal" tabindex="-1" aria-labelledby="exampleModalgridLabel" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalgridLabel">Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row ">
                    <div class="col-lg-12">
                        <h5 id="notrans" class="text-danger"></h5>
                        <hr>
                        <div id="or"></div>

                        <hr>
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="m-0 ">Total :</h5>
                            <div class="px-2">
                                <h5 class="m-0" id="total"></h5>
                            </div>
                        </div>
                        <hr>

                    </div>
                    <div class="col-lg-12 k">

                        <h5>Alamat Pengiriman</h5>
                        <p id="p" class="m-0"></p>
                        <p id="alamat" class="m-0"></p>
                        <hr>
                    </div>

                    <div class="col-lg-12">

                        <h5>Note :</h5>
                        <p id="note"></p>
                        <hr>
                    </div>
                    <div class="col-lg-12 ">
                        <div class="d-flex gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="button" id="selesai" class="btn btn-primary">Packing Selesai</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="row">
       
        <div class="col-lg-12 " style="margin-top: 10px ;margin-bottom: 30px">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Order</h5>
                </div>
                <div class="card-body">
                    <table id="data-table" class="table table-bordered dt-responsive " style="width:100%">
                        <thead>

                            <tr style="">

                        </thead>
                    </table>
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
    <script src="{{ url('js/order.js') }}"></script>
@endpush
