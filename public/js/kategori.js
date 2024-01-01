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
            url: "/api/kategori",
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
                    <button id="bt-edit" class="btn btn-outline btn-warning bx bx-pencil " data-uuid="${data.uuid}" data-bs-toggle="modal" data-bs-target="#edit-modal"></button></div>
                   `;
                },
            },
            { title: "Kategori", data: "nama" },
            { title: "Remark", data: "remark" },
        ],
    });

    $("#formBarang").submit( function () {
        var dataform = new FormData($("#formBarang")[0]);
        
        $.ajax({
            url: "/api/kategori",
            type: "POST",
            data : dataform,
            processData: false,
            contentType: false,
            success : (response)=>{
                table.ajax.reload();
                $('.show').hide();
                toastr.success("Berhasil ditambahkan!", "Kategori");
                this.reset();
            }
        });
    
    })
    
    $("body").on("click", "#bt-hapus", function () {
        let uuid = $(this).data("id");
        $.ajax({
            url: "/api/kategori/" + uuid,
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
    $("body").on("click", "#bt-edit", function () {
        $.ajax({
            url: "/api/kategori/" + $(this).data("uuid"),
            type: "GET",
            success: (data) => {
                $('#namae').val(data.nama);
                $('#uuid').val(data.uuid);
                $('#remarke').val(data.remark);
            },
        });
    });
    $("#edit").click( function () {
        var dataform = new FormData($("#editBarang")[0]);
        $.ajax({
            url: "/api/kategori/"+ $('#uuid').val(),
            type: "POST",
            data : dataform,
            processData: false,
            contentType: false,
            success : (response)=>{
                toastr.success("Berhasil diubah!", "Kategori");
                table.ajax.reload(); 
                
            }
        });
    
    });
    
    
});
