let table;
document.addEventListener("DOMContentLoaded", function () {
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
            url: "/api/order",
            type: "GET",
        },
        columns: [
            {
                title: "Action",
                data: null,
                render: function (data, type, row) {
                    return `
                    <div style="display:flex; gap:8px; justify-content: center">
                    <button id="bt-hapus" class="btn btn-outline btn-danger bx bx-trash  " data-id="${data.uuid}"></button> 
                    <button id="detail" class="btn btn-outline btn-success " data-id="${data.uuid}">Detail</button> 
                   `;
                },
            },
            { title: "Kode Transaksi", data: "no_trans" },
            { title: "Nama", data: "costumer.nama" },
            { title: "Alamat", data: "costumer.alamat" },
            { title: "Type", data: "type" },
            { title: "Total", data: "total" },
            { title: "Tanggal", data: "tgl" },
            { title: "Status", data: "status" },
        ],
    });

    $("body").on("click", "#bt-hapus", function () {
        let uuid = $(this).data("id");
        $.ajax({
            url: "/api/order/" + uuid,
            type: "DELETE",
            data: {
                _token: $("input[name='_token']").val(),
                _method: "DELETE",
            },
            success: () => {
                toastr.success("Berhasil dihapus!", "Kategori");
                table.ajax.reload();
            },
        });
    });
    let no_trans;
    $("body").on("click", "#detail", function () {
        let uuid = $(this).data("id");
        $.ajax({
            url: "/api/order/" + uuid,
            type: "GET",
            success: (data) => {
                // console.log(data);
                if (data.type == 'kirim'){
                $("#p").text(data.costumer.nama + " | +62" + data.costumer.no_hp);
                $("#alamat").text(data.costumer.alamat);
                $('.k').show();
                }
                else {$('.k').hide();}
                $("#note").text(data.note);
                $("#notrans").text(data.no_trans);
                no_trans = data.no_trans;

                $("#total").text(
                    "Rp." +
                        data.total
                            .toString()
                            .replace(/\B(?=(\d{3})+(?!\d))/g, ".")
                );
                $("#detail-modal").modal("show");
                $("#or").empty();
                data.status == "packing"? $('#selesai').text('Packing Selesai'): $('#selesai').text('Selesai');
                                $.each(data.detail, (i, val) => {
                    ag = parseInt(val.harga.replace("Rp.", "").replace('.', ""));

                    $("#or").append(
                        `<div class="d-block dropdown-item dropdown-item-cart text-wrap px-3 py-2">
                                <div class="d-flex align-items-center">
                                    <img src="/image/barang/${val.gambar}"
                                        class="me-3 rounded-circle avatar-md p-2 bg-light" alt="user-pic">
                                    <div class="flex-1">
                                        <h6 class="mt-0 mb-1 fs-14">
                                            <a href="#"
                                                class="text-reset">${
                                                    val.nama
                                                }</a>
                                        </h6>
                                        <p class="mb-0 fs-12 text-muted">
                                            Quantity: <span>${val.jumlah} x ${
                                                "Rp." +
                                                val.harga
                                                    .toString()
                                                    .replace(/\B(?=(\d{3})+(?!\d))/g, ".")
                        } </span>
                                        </p>
                                    </div>
                                    <div class="px-2">
                                        <h5 class="m-0 fw-normal">Rp.<span
                                                class="cart-item-price total " >${
                                                    ag * val.jumlah
                                                }</span></h5>
                                    </div>
                                </div>
                            </div>`
                    );

                    // toastr.success("Berhasil dihapus!", "Kategori");
                    // table.ajax.reload();
                });

            },
        });
    });
    $("#selesai").click(()=>{
        $.ajax({
            url: "/api/update-status",
            type: "post",
            data : {
                kode : no_trans,
            },
            success: ()=>{
                $("#detail-modal").modal("hide");
                table.ajax.reload();

            },
        
        })
    })
});
