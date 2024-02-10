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
            url: "/api/costumer",
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
                   `;
                },
            },
            { title: "No pelanggan", data: "no_plg" },
            { title: "Nama", data: "nama" },
            { title: "Email", data: "email" },
            { title: "No HP", data: "no_hp" },
            { title: "Alamat", data: "alamat" },
        ],
    });
    
    $("body").on("click", "#bt-hapus", function () {
        let uuid = $(this).data("id");
        $.ajax({
            url: "/api/costumer/" + uuid,
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
    
    
    
});
