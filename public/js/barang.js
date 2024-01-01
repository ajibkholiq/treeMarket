let table;
document.addEventListener("DOMContentLoaded", function () {
    table = new DataTable("#data-table", {
        processing: false,
        ordering: true,
        columnDefs : [
            {"className": "dt-center", "targets": 1}
          ],
        lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, "All"],
        ],
        language: {
            emptyTable: "Tidak ada data",
        },
        ajax: {
            url: "/api/getbarang",
            type: "GET",
        },
        columns: [
            {
                title: "Action",
                data: null,
                render: function (data, type, row) {
                    return `
                    <div style="display:flex; gap:8px; justify-content: center">
                    <button id="bt-hapus" class="btn btn-outline btn-danger bx bx-trash" data-id="${data.uuid}"></button> 
                    <button id="bt-edit" class="btn btn-outline btn-warning bx bx-pencil " data-uuid="${data.uuid}" data-bs-toggle="modal" data-bs-target="#edit-modal"></button></div>
                   `;
                },
            },
            { title: "Gambar",data: null, render: (data)=>{
                return `
                <img src="/image/barang/${data.gambar}" alt="${data.gambar}" style="width: 50px">
                `
            } ,},
            { title: "Nama", data: "nama" },
            { title: "Harga", data: "harga" },
            { title: "Jumlah", data: "jumlah" },
            { title: "Deskripsi", data: "deskripsi" },
        ],
    });  
    $.ajax({
        url: "/api/kategori",
        type: "GET",
        success: (data) => {
            $.each(data.data, (i, val) => {
                $("#kategori").append(
                    ` <option  value="${val.id}">${val.nama}</option>  `
                );
            });
        },
    });
});

$("#formBarang").submit(function () {
    var dataform = new FormData($("#formBarang")[0]);
    var deskripsi = CKEDITOR.instances.deskripsi.getData();
    dataform.append('deskripsi', deskripsi)
    $.ajax({
        url: "/api/barang",
        type: "POST",
        data : dataform,
        processData: false,
        contentType: false,
        success : (response)=>{
            toastr.success("Berhasil ditambahkan!", "Barang");
            table.ajax.reload();
            $('#add-modal').modal('hide');    
            $('#formBarang')[0].reset();
        },
    });

})
$("body").on("click", "#bt-hapus", function () {
    let uuid = $(this).data("id");
    $.ajax({
        url: "/api/barang/" + uuid,
        type: "DELETE",
        data: {
            _token: $("input[name='_token']").val(),
            _method: "DELETE",
        },
        success: () => {
            toastr.success("Berhasil dihapus!", "Barang");
            table.ajax.reload();
        },
    });
});
$("body").on("click", "#bt-edit", function () {
    $.ajax({
        url: "/api/kategori",
        type: "GET",
        success: (data) => {
            $.each(data.data, (i, val) => {
                $("#kategoriedt").append(
                    ` <option  value="${val.id}">${val.nama}</option>  `
                );
            });
        },
    });

    $.ajax({
        url: "/api/barang/" + $(this).data("uuid"),
        type: "GET",
        success: (data) => {
            
            $('#namaedt').val(data.nama);
            $('#uuid').val(data.uuid);
            $('#kategoriedt').val(data.kategori_id);
            $('#jumlahedt').val(data.jumlah);
            $('#hargaedt').val(data.harga);
            $('#deskripsiedt').val(data.deskripsi);
        },
    });
});

$("#edit").click( function () {
    var dataform = new FormData($("#editBarang")[0]);
    var deskripsi = CKEDITOR.instances.deskripsiedt.getData();
    dataform.append('deskripsi', deskripsi)
    $.ajax({    
        url: "/api/barang/"+ $('#uuid').val(),
        type: "POST",
        data : dataform,
        processData: false,
        contentType: false,
        success : (response)=>{
            toastr.success("Berhasil diubah!", "Kategori");
            table.ajax.reload(); 
            $('#add-modal').modal('hide');      
            $("#editBarang")[0].reset();
            
        }
    });
});
$('#gambar').on('change',()=>{
    if($('#gambar')[0].files[0].size >2097152){
        toastr.error("Maksimal 2MB!", "Gambar Terlalu Besar");
    }
});
$('#gambaredt').on('change',()=>{
    if($('#gambaredt')[0].files[0].size >2097152){
        toastr.error("Maksimal 2MB!", "Gambar Terlalu Besar");

    }
});

