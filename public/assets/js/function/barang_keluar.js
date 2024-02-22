var table;
var start_date;
var end_date;
$(document).ready(function () {
    $("#card-form").hide();
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    table = $("#dt_tbl").DataTable({
        processing: true,
        scrollY: "68vh",
        bFilter: false,
        scrollX: true,
        serverSide: true,
        orderCellsTop: true,
        lengthMenu: [10, 50, 100, 1000],
        ajax: {
            url: window.location,
            data: function (d) {
                    (d.start_date = start_date),
                    (d.end_date = end_date),
                    (d.id_produk = $("#id_produk option:selected").val());
            },
        },
        columns: [
            { data: "nama_barang", name: "nama_barang" },
            { data: "nama_customer", name: "nama_customer" },
            { data: "jumlah_barang_keluar", name: "jumlah_barang_keluar" },
            { data: "created_at", name: "created_at" },
            {
                data: "actions",
                name: "actions",
                orderable: false,
                serachable: false,
                sClass: "text-center",
            },
        ],
        
    });

    $("#form").submit(function (e) {
        e.preventDefault();
        $("#submit").html("Tunggu...");
        $("#submit").attr("disabled", true);
        var urlSubmit, text, action;
        if ($("#id").val() != "") {
            text = "Update";
            action = "Update";
            urlSubmit = url + "/barang_keluar-update-data";
        } else {
            text = "Simpan";
            action = "Simpan";
            urlSubmit = url + "/barang_keluar-insert-data";
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
                $("#id_produkError").html("");
                $("#jumlah_barang_masukError").html("");
                if (data.errors) {
                    $("#submit").html(action);
                    if (data.errors.id_produk) {
                        $("#id_produkError").html(data.errors.id_produk[0]);
                    }
                    if (data.errors.jumlah_barang_masuk) {
                        $("#jumlah_barang_masukError").html(data.errors.jumlah_barang_masuk[0]);
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

    $("#id_produk").on("change", function () {
        $("#id_produk").val();
        table.draw();
    });

    $("#custku").on("change", function () {
        $("#custku").val();
        table.draw();
    });

    $("#id_produk").select2({
        ajax: {
            url: url + "/barang_keluarku-user-card-select",
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

    $("#produkku").select2({
        ajax: {
            url: url + "/barang_keluar-user-card-select",
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

    $("#cust").select2({
        ajax: {
            url: url + "/cust-user-card-select",
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
    
    $("#custku").select2({
        ajax: {
            url: url + "/custku-user-card-select",
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
});

$(function () {
    var start = moment().subtract(29, "days");
    var end = moment();

    function cb(start, end) {
        $("#reportrange span").html(
            start.format("YYYY-MM-DD") + " &#8594; " + end.format("YYYY-MM-DD")
        );
    }

    $("#reportrange").daterangepicker(
        {
            startDate: start,
            endDate: end,
            ranges: {
                Today: [moment(), moment()],
                Yesterday: [
                    moment().subtract(1, "days"),
                    moment().subtract(1, "days"),
                ],
                "Last 7 Days": [moment().subtract(6, "days"), moment()],
                "Last 30 Days": [moment().subtract(29, "days"), moment()],
                "This Month": [
                    moment().startOf("month"),
                    moment().endOf("month"),
                ],
                "Last Month": [
                    moment().subtract(1, "month").startOf("month"),
                    moment().subtract(1, "month").endOf("month"),
                ],
            },
        },
        cb
    );

    cb(start, end);
    $("#reportrange").on("apply.daterangepicker", function (ev, picker) {
        console.log(picker.startDate.format("YYYY-MM-DD"));
        console.log(picker.endDate.format("YYYY-MM-DD"));
        start_date = picker.startDate.format("YYYY-MM-DD");
        end_date = picker.endDate.format("YYYY-MM-DD");
        table.draw();
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
                url: url + "/barang_keluar-delete-data",
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