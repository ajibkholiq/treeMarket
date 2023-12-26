@extends('layout.main')
@push('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
@endpush
@section('content')
  
    <div class="row" id="barang" style="border:1">
    

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
                        <h4 id="nama" class="card-title mb-2 col-8 text-capitalize"></h4>
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
            document.addEventListener("DOMContentLoaded", function() {
                function barang(){
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
                            }
                            else {
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
                            });}
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
                    // $.ajax({
                    //     url: "/api/barang",
                    //     type: "GET",
                    //     success: (data) => {
                    //         $.each(data.data, (i, val) => {
                    //             $("#barang").append(
                    //                 `<div class="col-xl-2 col-md-4 col-sm-6 col-xs-6">
                    //         <div class="card" data-aos="zoom-in" id="detail" data-bs-toggle="modal" data-bs-target="#detail-modal"  data-uuid="${val.uuid}" >
                    //             <div style="height:150px; margin:10px">
                    //                 <img src="image/barang/${val.gambar}" class="card-img-top" style="object-fit:contain ;height:150px" alt="...">
                    //             </div>
                                
                    //         <div class="card-body">
                    //             <h5 class="card-title text-capitalize">${val.nama}</h5>
                    //             <p>Rp.${val.harga.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.')}</p>
                    //         </div>
                    //     </div>
                    //     </div> `
                    //             );
                    //         });
                    //     },
                    // });
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
                            $('#chart').attr("data-uuid", data.uuid);
                            $('#beli').attr("data-uuid", data.uuid);
                            $('#gambar').attr("alt", data.gambar);
                            $('#nama').html(data.nama);
                            $('#stok').html("Tersisa " + data.jumlah);
                            $('#deskripsi').html(data.deskripsi);
                            $('#harga').html("Rp." + data.harga.toString().replace(
                                /\B(?=(\d{3})+(?!\d))/g, '.'));
                            $('#jumlah').attr("max", data.jumlah)

                        },
                    });
                });
                $('body').on('click', '#chart', function() {
                    var jumlah = $('#jumlah').val();
                    $.ajax({
                        url: "api/barang/" + $(this).data("uuid"),
                        type: "GET",
                        success: (data) => {
                            addChart = {
                                id: data.uuid,
                                nama: data.nama,
                                gambar: data.gambar,
                                harga: data.harga,
                                jumlah: jumlah
                            };
                            if (localStorage.getItem('chart') === '[]' || localStorage.getItem(
                                    'chart') === null) {
                                localStorage.setItem('chart', JSON.stringify([addChart]));
                            } else {
                                var chart = JSON.parse(localStorage.getItem('chart'));
                                var oldcart = chart.filter(e => e.id === addChart.id);
                                // console.log(oldcart[0].id);
                                console.log(addChart.id);
                                if (oldcart.length != 0) {
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
                    var jumlah = $('#jumlah').val();
                    var uuid = $(this).data("uuid")

                    if (localStorage.getItem('costumer') == null) {
                        console.log('login');
                    }




                });
            });
        </script>
    @endpush
@endsection
