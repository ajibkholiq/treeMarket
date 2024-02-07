@extends('layout.main')
@section('content')
    <div class="row">
        <a href="/"><h5><- kembali</h5></a>
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

        
        <!--end col-->
    </div>
@endsection
@push('css')
    @push('css')
        <!--datatable css-->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
        <!--datatable responsive css-->
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    @endpush
@endpush
@push('js')
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

    <script>
        let table;
        document.addEventListener("DOMContentLoaded", function() {
            cos = JSON.parse(localStorage.getItem('noPelanggan'));
            console.log(cos);
            table = new DataTable("#data-table", {
                processing: false,
                ordering: true,
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"],
                ],
                language: {
                    emptyTable: "Tidak ada data",
                },
                ajax: {
                    url: "/api/ordercos/" + cos.no_pelanggan,
                    type: "GET",
                },
                columns: [{
                        title: "Action",
                        data: null,
                        render: function(data, type, row) {
                            if (data.status === 'packing') {
                                return `<div style="display:flex; gap:8px; justify-content: center">
                    <button id="batal" class="btn btn-outline btn-danger" data-id="${data.no_trans}">Batalkan</button> 
                    </div>
                   `;
                            
                            } else if (data.status === 'dikirim') {
                                return ` <div style="display:flex; gap:8px; justify-content: center">
                    <button id="selesai" class="btn btn-outline btn-success " data-id="${data.no_trans}">Selesai</button> 
                    </div>`;

                            } else {
                                return ""

                            }


                        },
                    },
                    {
                        title: "Kode Transaksi",
                        data: "no_trans"
                    },
                    {
                        title: "Nama",
                        data: "nama"
                    },
                    {
                        title: "Alamat",
                        data: "alamat"
                    },
                    {
                        title: "Type",
                        data: "type"
                    },
                    {
                        title: "Total",
                        data: "total"
                    },
                    {
                        title: "Tanggal",
                        data: "tgl"
                    },
                    {
                        title: "Status",
                        data: "status"
                    },
                ],
            })
            $("body").on("click", "#selesai", function() {
                $.ajax({
                    url: "/api/update-status",
                    type: "post",
                    data: {
                        kode: $(this).data('id'),
                    },
                    success: () => {
                        $("#detail-modal").modal("hide");
                        table.ajax.reload();

                    },

                })
            })
            $("body").on("click", "#batal", function() {
                $.ajax({
                    url: "/api/update-status",
                    type: "post",
                    data: {
                        kode: $(this).data('id'),
                        status: "batalkan",
                    },
                    success: () => {
                        table.ajax.reload();

                    },

                })
            })
        });
    </script>
@endpush
