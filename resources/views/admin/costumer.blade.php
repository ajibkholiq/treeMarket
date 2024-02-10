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


        <div class="col-lg-12 " style="margin-top: 10px ;margin-bottom: 30px">

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Pelanggan</h5>
                </div>
                <div class="card-body">
                    <table id="data-table" class="table table-bordered dt-responsive " style="width:100%">
                        <thead>

                            <tr style="">
                                <th style="width: 20px;" class="text-center" >Action</th>
                                <th>no_plg</th>
                                <th>nama</th>
                                <th>email</th>
                                <th>no_hp</th>
                                <th>alamat</th>
                        </thead>
                    </table>
                </div>
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
    <script src="{{ url('js/costumer.js') }}"></script>
@endpush
