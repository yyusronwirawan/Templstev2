/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 * 
 */

function articleImage(e) {

    var a = new FormData;
    a.append("image", e),  fetch("/article-image", { method: "POST", body: a, headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") } }).then(e => e.json()).then(e => { $("#summernote").summernote("insertImage", e) }).then(() => { swal({ icon: "success", text: "Uploaded successfully" }) }).catch(e => { swal({ icon: "error", text: e }) })
}

$(document).ready(function() {
    window.setTimeout(function() {}, 9e3),  $image_crop = $(".image-preview").croppie({ enableExif: !0, enforceBoundary: !1, enableOrientation: !0, viewport: { width: 200, height: 200, type: "square" }, boundary: { width: 300, height: 300 } }), $(" #avatarCrop ").change(function() {
        $("#avatar-holder").addClass("d-none"), $("#avatar-updater").removeClass("d-none");
        var e = new FileReader;
        e.onload = function(e) { $image_crop.croppie("bind", { url: e.target.result }) }, e.readAsDataURL(this.files[0])
    }), $("#toggleClose").click(function() { $("#toggleClose").css("display", "none"), $(".app-logo").css("display", "none"), $(".toggleopen").css("display", "block") }), $(".toggleopen").click(function() { $(".toggleopen").css("display", "none"), $(".app-logo").css("display", "block"), $("#toggleClose").css("display", "block") }), $("#rotate-image").click(function(e) { $image_crop.croppie("rotate", 90) }), $("#crop_image").click(function() {
        $image_crop.croppie("result", { type: "canvas", size: "viewport" }).then(function(e) {
            var a = $("input[name=avatar-url]").val(),
                t = $('meta[name="csrf-token"]').attr("content"),
                o = $("#crop_image");
            o.html("Saving Avatar..."), o.attr("disabled", "disabled"), $.ajaxSetup({ headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") } }), $.ajax({ url: a, type: "POST", data: { avatar: e, _token: t }, dataType: "json", success: function(e) {}, complete: function(e) { swal({ text: e.responseText, icon: "success" }).then(() => { location.reload() }) } })
        })
    }), $("#avatar-cancel-btn").click(function() { $("#avatar-holder").removeClass("d-none"), $("#avatar-updater").addClass("d-none") });
});
$("#summernote").summernote({
    toolbar: [
        ["style", ["style"]],
        ["font", ["bold", "underline", "clear"]],
        ["color", ["color"]],
        ["para", ["ul", "ol", "paragraph"]],
        ["insert", ["link", "picture", "video"]],
        ["view", ["codeview"]]
    ],
    height: 300,
    minHeight: null,
    maxHeight: null,
    focus: 0,
    spellCheck: !0,
    callbacks: { onImageUpload: function(e) { articleImage(e[0]) }, onImageLinkInsert: function(e) { $("#summernote").summernote("insertImage", e) } }
});
$("#plan-description").summernote({
    toolbar: [
        ["font", ["bold"]],
        ["para", ["ul", "ol"]],
    ],
    height: 150,
    minHeight: 150,
    maxHeight: 150,
    focus: 0,
    spellCheck: !0,
    callbacks: { onImageUpload: function(e) { articleImage(e[0]) }, onImageLinkInsert: function(e) { $("#plan-description").summernote("insertImage", e) } }
});
