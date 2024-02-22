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
        scrollY: "68vh",
        serverSide: true,
        orderCellsTop: true,
        ajax: url + "/user/",
        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                orderable: false,
                serachable: false,
                sClass: "text-center",
            },
            { data: "nik", name: "nik" },
            { data: "name", name: "name" },
            {
                data: "actions",
                name: "actions",
                orderable: false,
                serachable: false,
                sClass: "text-center",
            },
        ],
        initComplete: function () {
            this.api()
                .columns([1, 2])
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
            urlSubmit = url + "/user-update-data";
        } else {
            text = "Simpan";
            action = "Simpan";
            urlSubmit = url + "/user-insert-data";
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
                $("#nameError").html("");
                $("#nikError").html("");
                if (data.errors) {
                    $("#submit").html(action);
                    if (data.errors.name) {
                        $("#nameError").html(data.errors.name[0]);
                    }
                    if (data.errors.nik) {
                        $("#nikError").html(data.errors.nik[0]);
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
                url: url + "/user-delete-data",
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
        url: url + "/user-edit-data",
        data: { id: id },
        method: "POST",
        success: function (data) {
            $("#id").val(data.data.id);
            $("#name").val(data.data.name);
            $("#nik").val(data.data.nik);
            $("#submit").html("Update");
            $("#card-form").show(1000);
        },
        error: function (data) {
            console.log("Error:", data);
        },
    });
}
