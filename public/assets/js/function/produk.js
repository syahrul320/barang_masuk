var table;
$(document).ready(function () {
    $("#card-form").hide();
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    table = $("#dt_tbl").DataTable({
        processing: true,
        scrollX: true,
        scrollY: "60vh",
        bFilter: false,
        serverSide: true,
        orderCellsTop: true,
        ajax: url + "/produk/",
        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                orderable: false,
                serachable: false,
                sClass: "text-center",
            },
            { data: "kode_barang", name: "kode_barang" },
            { data: "nama_barang", name: "nama_barang" },
            { data: "nama_kategori", name: "nama_kategori" },
            { data: "rasa", name: "rasa" },
            { data: "stok", name: "stok" },
            { data: "satuan", name: "satuan" },
            {
                data: "actions",
                name: "actions",
                orderable: false,
                serachable: false,
                sClass: "text-center",
            },
        ],

        dom: "Bfrtip",
        buttons: ["copyHtml5", "excelHtml5", "csvHtml5", "pdfHtml5"],

        initComplete: function () {
            this.api()
                .columns([1, 2, 3, 4, 5, 6])
                .every(function () {
                    var column = this;
                    var input = document.createElement("input");
                    input.className = "form-control";
                    $(input)
                        .appendTo($(column.footer()).empty())
                        .on("change", function () {
                            column
                                .search($(this).val(), false, false, true)
                                .draw();
                        });
                });
        },
    });

    $("#id_kategori").on("change", function () {
        $("#id_kategori").val();
        table.draw();
    });

    $("#id_kategori").select2({
        ajax: {
            url: url + "/kategori-user-card-select",
            type: "post",
            dataType: "json",
            delay: 250,
            data: function (params) {
                return {
                    search: params.term, // search term
                };
            },
            processResults: function (response) {
                return {
                    results: response,
                };
            },
            cache: true,
        },
    });

    $("#id_rasa").on("change", function () {
        $("#id_rasa").val();
        table.draw();
    });

    $("#id_rasa").select2({
        ajax: {
            url: url + "/rasa-user-card-select",
            type: "post",
            dataType: "json",
            delay: 250,
            data: function (params) {
                return {
                    search: params.term, // search term
                };
            },
            processResults: function (response) {
                return {
                    results: response,
                };
            },
            cache: true,
        },
    });

    $("#add").click(function () {
        document.getElementById("form").reset();
        $("#id").val("");
        $("#submit").attr("disabled", false);
        $("#card-form").show(1000);
    });
    $("#close-form").click(function () {
        $("#card-form").hide(1000);
        document.getElementById("form").reset();
        $("#id").val("");
        $("#submit").html("Simpan");
    });

    $("#form").submit(function (e) {
        e.preventDefault();
        $("#submit").html("Tunggu...");
        $("#submit").attr("disabled", true);
        var urlSubmit, text, action;
        if ($("#id").val() != "") {
            text = "Update";
            action = "Update";
            urlSubmit = url + "/produk-update-data";
        } else {
            text = "Simpan";
            action = "Simpan";
            urlSubmit = url + "/produk-insert-data";
        }
        var formData = new FormData($("#form")[0]);
        $.ajax({
            method: "POST",
            url: urlSubmit,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (data) => {
                $("#submit").attr("disabled", false);
                $("#kode_barangError").html("");
                $("#nama_barangError").html("");
                $("#satuanError").html("");
                $("#id_kategoriError").html("");
                $("#id_rasaError").html("");
                if (data.errors) {
                    $("#submit").html(action);
                    if (data.errors.kode_barang) {
                        $("#kode_barangError").html(data.errors.kode_barang[0]);
                    }
                    if (data.errors.nama_barang) {
                        $("#nama_barangError").html(data.errors.nama_barang[0]);
                    }
                    if (data.errors.satuan) {
                        $("#satuanError").html(data.errors.satuan[0]);
                    }
                    if (data.errors.id_kategori) {
                        $("#id_kategoriError").html(data.errors.id_kategori[0]);
                    }
                    if (data.errors.id_rasa) {
                        $("#id_rasaError").html(data.errors.id_rasa[0]);
                    }
                }

                if (data.success) {
                    table.draw();
                    document.getElementById("form").reset();
                    $("#id").val("");
                    swal("Success " + text + " Data", {
                        icon: "success",
                    });
                    $("#card-form").hide();
                    $("#submit").html("Simpan");
                }
            },
            error: function (data) {
                console.log(data);
            },
        });
    });
});

function destroy(id) {
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this data!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                type: "DELETE",
                url: url + "/produk-delete-data",
                data: { id: id },
                method: "POST",
                success: function (data) {
                    table.draw();
                    swal("Success Delete Data", {
                        icon: "success",
                    });
                },
                error: function (data) {
                    console.log("Error:", data);
                },
            });
        } else {
            swal("Your data is safe!");
        }
    });
}

function edit(id) {
    $("#submit").attr("disabled", false);
    $.ajax({
        url: url + "/produk-edit-data",
        data: { id: id },
        method: "POST",
        success: function (data) {
            $("#id").val(data.data.id);
            $("#kode_barang").val(data.data.kode_barang);
            $("#nama_barang").val(data.data.nama_barang);
            $("#satuan").val(data.data.satuan);
            $("#id_kategori").val(data.data.id_kategori);
            $("#id_rasa").val(data.data.id_rasa);
            $("#submit").html("Update");
            $("#card-form").show(1000);
        },
        error: function (data) {
            console.log("Error:", data);
        },
    });
}
