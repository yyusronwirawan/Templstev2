function articleImage(e) {
    "use strict";
    var a = new FormData;
    a.append("image", e), swal({ text: "Image uploading. Please Wait! ...", button: !1 }), fetch("/article-image", { method: "POST", body: a, headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") } }).then(e => e.json()).then(e => { $("#summernote").summernote("insertImage", e) }).then(() => { swal({ icon: "success", text: "Uploaded successfully" }) }).catch(e => { swal({ icon: "error", text: e }) })
}


$(document).ready(function() {
    $(document).on('click','.show_confirm',function (event) {
    var form = $(this).closest("form");
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
    })
    swalWithBootstrapButtons.fire({
        title: 'Are you sure?',
        text: "This action can not be undone. Do you want to continue?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No',
        reverseButtons: true
    }).then((result) => {
        if(result.isConfirmed)
    {
        form.submit();
    }
})
});
    if ($(".pc-dt-simple").length > 0) {
        $( $(".pc-dt-simple") ).each(function( index,element ) {
            var id = $(element).attr('id');
            const dataTable = new simpleDatatables.DataTable("#"+id);
        });
    }
});
