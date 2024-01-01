@extends('layout.main')
@push('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
@endpush
@section('content')
    <div class="row" id="barang" style="border:1"></div>
    <div class="modal fade" id="checkout-modal" tabindex="-1" aria-labelledby="exampleModalgridLabel" aria-modal="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalgridLabel">Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row ">
                        <div class="col-lg-12">
                            <hr>
                            <div id="or"></div>
                            {{-- <div class="table-responsive table-card">
                                <table class="table table-borderless align-middle mb-0" id="data">
                                    <thead class="table-light text-muted">
                                        <tr>
                                            <th style="width: 90px;" scope="col">Product</th>
                                            <th scope="col">Product Info</th>
                                            <th scope="col" class="text-end">Price</th>
                                        </tr>
                                    </thead>
                                    <tbody  >
                                    

                                        <tr id="or" class="table-active">
                                            <th colspan="2">Total (IDR) :</th>
                                            <td class="text-end">
                                                <span class="fw-semibold " id="total">
                                                    $353.15
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div> --}}
                            <hr>
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="m-0 ">Total:</h5>
                                <div class="px-2">
                                    <h5 class="m-0" id="checkout-total"></h5>
                                </div>
                            </div>
                            <hr>

                        </div>
                        <div class="col-lg-12">
                            <label for="type" class="form-label">Type</label>
                            <select required class="form-select mb-3" name="type" id="type"
                                aria-label="Default select example">
                                <option value="kirim">Kirim ke Rumah</option>
                                <option value="ambil">Ambil ke Toko</option>
                            </select>
                        </div>
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label for="note" class="form-label">Note</label>
                                <textarea class="form-control" id="note" name="note" placeholder="Note..." rows="3"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-12  mt-5">
                            <div class="d-flex gap-2 justify-content-end">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="button" id="checkout" class="btn btn-primary">Order</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="costumer-modal" tabindex="-1" aria-labelledby="exampleModalgridLabel" aria-modal="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-body">
                    <form action="javascript:void(0);" method="POST" id="form-costumer" data-uuid="" data-jumlah=""
                        enctype="multipart/form-data">

                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="pills-bill-info" role="tabpanel"
                                aria-labelledby="pills-bill-info-tab">
                                <div>
                                    <h5 class="mb-1">Billing Information</h5>
                                    <p class="text-muted mb-4">Please fill all information below</p>
                                </div>

                                <div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="mb-3">
                                                <label for="billinginfo-firstName" class="form-label">Name</label>
                                                <input type="text" class="form-control" id="nama" name="nama"
                                                    placeholder="Enter name" value="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="billinginfo-email" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="email" name="email"
                                                    placeholder="Enter email">
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="nama" class="form-label">Handphone</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text">+62</span>
                                                    <input type="number" placeholder="Enter Phone" required
                                                        name="nohp" id="nohp" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="billinginfo-address" class="form-label">Address</label>
                                        <textarea class="form-control" id="alamat" name="alamat" placeholder="Enter address" rows="3"></textarea>
                                    </div>

                                    <div class="d-flex">
                                        <button type="submit" class="btn btn-primary right ms-auto nexttab">Save
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end tab content -->
                    </form>
                    {{-- <form action="javascript:void(0);" method="POST" id="form-costumer" data-uuid="" data-jumlah=""
                        enctype="multipart/form-data">
                        <div class="row g-3">
                            <div class="col-xxl-6">
                                <div>
                                    <label for="nama" class="form-label">Nama</label>
                                    <input required type="text" name="nama" class="form-control" id="nama"
                                        placeholder="Nama">
                                </div>
                            </div><!--end col-->
                            <div class="col-xxl-6">
                                <label for="nama" class="form-label">Handphone</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">+62</span>
                                    <input type="number" placeholder="Nomor Handphone" required name="nohp"
                                        id="nohp" class="form-control">
                                </div>
                            </div>
                            <div class="col-xxl-6">
                                <div>
                                    <label for="nama" class="form-label">Alamat</label>
                                    <input required type="text" name="alamat" class="form-control" id="alamat"
                                        placeholder="alamat">
                                </div>
                            </div>
                            <!--end col-->

                            <div class="col-lg-12">
                                <div class=" gap-2 justify-content-end">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                            <!--end col-->

                        </div><!--end row-->
                    </form> --}}
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="detail-modal" aria-modal="true" tabindex="-1" aria-labelledby="exampleModalgridLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="card">
                        <img class="card-img-top img-fluid" id="gambar" src=""
                            style="height: 250px; object-fit:contain" alt="Card image cap">

                    </div>
                    <div class="d-flex justify-content-bettwen">
                        <h4 id="namab" class="card-title mb-2 col-8 text-capitalize"></h4>
                        <h6 id="stok" class="col-4 text-end text-danger">
                            </h4>

                    </div>
                    <h6 id="harga" class="card-title mb-2 col-8 text-capitalize text-danger"></h6>
                    <hr>
                    <h6 class="mt-2">Deskripsi</h6>
                    <p id="deskripsi" class="card-text text-muted"> </p>
                    <hr>
                    <div class="d-flex justify-content-bettwen">
                        <h6 class=" col-8 col-sm-9 align-item-center">Jumlah</h6>
                        <div class="input-step">
                            <button type="button" class="minus">–</button>
                            <input type="number" id="jumlah" class="product-quantity" value="1" min="1"
                                max="100">
                            <button type="button" class="plus">+</button>
                        </div>
                    </div>
                    <hr>
                    <div class="hstack gap-2 justify-content-end">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="chart" data-uuid="" data-bs-dismiss="modal"
                            class="btn btn-warning">Keranjang</button>
                        <button type="button" id="beli" data-uuid="" data-bs-dismiss="modal"
                            class="btn btn-primary">Beli</button>
                    </div>

                </div>

            </div>
        </div>
    </div>
    @push('js')
        <script src="assets/js/pages/form-input-spin.init.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

        <script>
            let datachekcout,bi;

            document.addEventListener("DOMContentLoaded", function() {
                function barang() {
                    $.ajax({
                        url: "/api/barang",
                        type: "GET",
                        success: (data) => {
                            $.each(data.data, (i, val) => {
                                $("#barang").append(
                                    `<div class="col-xl-2 col-md-4 col-sm-6 col-xs-6">
                            <div class="card" data-aos="zoom-in" id="detail" data-bs-toggle="modal" data-bs-target="#detail-modal"  data-uuid="${val.uuid}" >
                                <div style="height:150px; margin:10px">
                                    <img src="image/barang/${val.gambar}" class="card-img-top" style="object-fit:contain ;height:150px" alt="...">
                                </div>
                                
                            <div class="card-body">
                                <h5 class="card-title text-capitalize">${val.nama}</h5>
                                <p>Rp.${val.harga.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.')}</p>
                            </div>
                        </div>
                        </div> `
                                );
                            });
                        },
                    });
                }

                function getbarang(ar) {
                    $.ajax({
                        url: "/api/getbarang",
                        type: "post",
                        data: ar,
                        success: (data) => {
                            if (data.data === "notfound") {
                                $('#barang').before(`
                               <div class="alert alert-info alert-border-left alert-dismissible fade show" role="alert">
                                <i class="ri-airplay-line me-3 align-middle"></i> <strong>Info</strong> - ${ar.search} Tidak Ditemukan...
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                 </div>
                                `);
                                barang();
                            } else {
                                $.each(data.data, (i, val) => {
                                    $("#barang").append(
                                        `<div class="col-xl-2 col-md-4 col-sm-6 col-xs-6">
                            <div class="card" data-aos="zoom-in" id="detail" data-bs-toggle="modal" data-bs-target="#detail-modal"  data-uuid="${val.uuid}" >
                                <div style="height:150px; margin:10px">
                                    <img src="image/barang/${val.gambar}" class="card-img-top" style="object-fit:contain ;height:150px" alt="...">
                                </div>
                                
                            <div class="card-body">
                                <h5 class="card-title text-capitalize">${val.nama}</h5>
                                <p>Rp.${val.harga.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.')}</p>
                            </div>
                        </div>
                        </div> `
                                    );
                                });
                            }
                        },
                    });
                }
                var query = new URLSearchParams(window.location.search);
                if (query.has('kategori')) {
                    getbarang({
                        kategori: query.get('kategori')
                    });
                } else if (query.has('search')) {
                    getbarang({
                        search: query.get('search')
                    });

                } else {
                    barang();

                }
                $.ajax({
                    url: "/api/getkategori",
                    type: "GET",
                    success: (data) => {
                        $.each(data.data, (i, val) => {
                            $("#kategori").append(
                                `<li class="nav-item">
                            <a class="nav-link menu-link collapsed" href="?kategori=${val.nama}" aria-expanded="false">
                                <span data-key="t-dashboards">${val.nama}</span>
                            </a>
                        </li>`
                            );
                        });
                    },
                });
                $('body').on('click', '#detail', function() {
                    $.ajax({
                        url: "api/barang/" + $(this).data("uuid"),
                        type: "GET",
                        success: (data) => {
                            $('#gambar').attr("src", "/image/barang/" + data.gambar);
                            bi=data.uuid
                            $('#gambar').attr("alt", data.gambar);
                            $('#namab').html(data.nama);
                            $('#stok').html("Tersisa " + data.jumlah);
                            $('#deskripsi').html(data.deskripsi);
                            $('#harga').html("Rp." + data.harga.toString().replace(
                                /\B(?=(\d{3})+(?!\d))/g, '.'));
                            $('#jumlah').attr("max", data.jumlah)

                        },
                    });
                });
                $('#chart').click(function() {
                    var jumlah = $('#jumlah').val();
                    console.log(bi);
                    $.ajax({
                        url: "api/barang/" + bi,
                        type: "GET",
                        success: (data) => {
                            addChart = {
                                id: data.uuid,
                                nama: data.nama,
                                gambar: data.gambar,
                                harga: data.harga,
                                jumlah: jumlah,
                                chart: true,
                            };
                            if (localStorage.getItem('chart') === '[]' || 
                            localStorage.getItem('chart') === null) {
                                localStorage.setItem('chart', JSON.stringify([addChart]));
                            } else {
                                var chart = JSON.parse(localStorage.getItem('chart'));
                                var oldcart = chart.filter(e => e.id === addChart.id);
                                // console.log(oldcart[0].id);
                                if (oldcart.length > 0) {
                                    // if (oldcart[0].id === addChart.id) {
                                    chart = chart.map(a => a.id === addChart.id ? {
                                        ...a,
                                        jumlah: parseInt(oldcart[0].jumlah) + parseInt(
                                            addChart.jumlah)
                                    } : a);
                                } else {
                                    chart.push(addChart);
                                }

                                localStorage.setItem('chart', JSON.stringify(chart));

                            }
                            $('#detai-modal').modal('hide');
                            cart();
                            toastr.success("DimasukKan ke Keranjang", "Barang");
                        },

                    });

                });
                $('body').on('click', '#beli', function() {
                    if (localStorage.getItem('noPelanggan') == null) {
                        $('#costumer-modal').modal('show');
                    } else {
                        data = beli();
                        datacheckout = data;
                        $.each(data, (i, val) => {
                            ag = parseInt(val.harga.replace("Rp.", "").replace('.', ""));
                            console.log(ag);
                            $('#or').empty();
                            $('#or').append(

                                `<div class="d-block dropdown-item dropdown-item-cart text-wrap px-3 py-2">
                                            <div class="d-flex align-items-center">
                                                <img src="${
                                                    val.gambar
                                                }"
                                                    class="me-3 rounded-circle avatar-md p-2 bg-light" alt="user-pic">
                                                <div class="flex-1">
                                                    <h6 class="mt-0 mb-1 fs-14">
                                                        <a href="apps-ecommerce-product-details.html"
                                                            class="text-reset">${
                                                                val.nama
                                                            }</a>
                                                    </h6>
                                                    <p class="mb-0 fs-12 text-muted">
                                                        Quantity: <span>${
                                                            val.jumlah
                                                        } x ${val.harga} </span>
                                                    </p>
                                                </div>
                                                <div class="px-2">
                                                    <h5 class="m-0 fw-normal">Rp.<span
                                                            class="cart-item-price total " >${
                                                                ag * val.jumlah
                                                            }</span></h5>
                                                </div>
                                            </div>
                                        </div>`);
                        });
                        $('#checkout-total').text("Rp. " + $('.total').text())
                        $('#checkout-modal').modal('show');

                    }

                });
                $("#checkout").click(function() {
                    type = $("#type").val();
                    note = $("#note").val();
                    costumer = localStorage.getItem('noPelanggan');
                    checkout(datacheckout, type, note, costumer);
                    if (datacheckout[0].chart) {
                        localStorage.removeItem('chart');
                        cart();
                    }


                });
                $("#checkouts").click(function() {
                    datacheckout = JSON.parse(localStorage.getItem('chart'));
                    data = datacheckout;
                    $('#or').empty();
                    $.each(data, (i, val) => {
                        $('#or').append(
                            `<div class="d-block dropdown-item dropdown-item-cart text-wrap px-3 py-2">
                                            <div class="d-flex align-items-center">
                                                <img src="image/barang/${
                                                    val.gambar
                                                }"
                                                    class="me-3 rounded-circle avatar-md p-2 bg-light" alt="user-pic">
                                                <div class="flex-1">
                                                    <h6 class="mt-0 mb-1 fs-14">
                                                        <a href="apps-ecommerce-product-details.html"
                                                            class="text-reset">${
                                                                val.nama
                                                            }</a>
                                                    </h6>
                                                    <p class="mb-0 fs-12 text-muted">
                                                        Quantity: <span>${
                                                            val.jumlah
                                                        } x ${val.harga} </span>
                                                    </p>
                                                </div>
                                                <div class="px-2">
                                                    <h5 class="m-0 fw-normal">Rp.<span
                                                            class="cart-item-price total " >${
                                                                val.harga *
                                                                val.jumlah
                                                            }</span></h5>
                                                </div>
                                            </div>
                                        </div>`);
                    });
                    $('#checkout-total').text($('#cart-item-total').text())
                    $('#checkout-modal').modal('show');

                });




                function checkout(data, type, note, pelanggan) {
                    $.ajax({
                        url: "/api/order",
                        type: "POST",
                        data: {
                            pelanggan: pelanggan,
                            data: JSON.stringify(data),
                            type: type,
                            note: note,
                        },
                        success: (data) => {
                            toastr.success("Terima Kasih Telah Order", "Success");
                            $('#checkout-modal').modal('hide');

                        },
                    });
                }

                function beli() {
                    return [{
                        id: bi,
                        nama: $('#namab').text(),
                        gambar: $('#gambar').attr('src').replace('/image/barang/',''),
                        harga: $('#harga').text().replace('Rp.','').replace('.',''),
                        jumlah: $('#jumlah').val(),
                        chart: false,
                    }];
                }
                $("#form-costumer").submit(function() {
                    var dataform = new FormData($("#form-costumer")[0]);
                    $.ajax({
                        url: "/api/costumer",
                        type: "POST",
                        data: dataform,
                        processData: false,
                        contentType: false,
                        success: (data) => {
                            localStorage.setItem('noPelanggan', JSON.stringify(data.data));
                            toastr.success("Terima Kasih Telah Mengisi Formulir", "Success");
                            $('#costumer-modal').modal('hide');
                            $('#form-costumer')[0].reset();
                            $('#checkout-modal').modal('show');


                        },
                    });

                })
            });
        </script>
    @endpush
@endsection
