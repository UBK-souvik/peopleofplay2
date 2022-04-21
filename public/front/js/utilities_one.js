var str_save_role_url_redirect = "/user/profile/edit",
    str_save_role_data_url = "/user/role-profile-data/edit",
    str_save_role_url_delete = "/user/role-profile-data/delete",
    str_delete_role_data_url_ajax = "/user/delete-user-role-data-ajax",
    int_hide_collapse_social_icons_flag = 0;

function openEditGalleryModal(e) {
    var a = "#ModalGalleryVideoForm" + e;
    $(a).show(), $(a).css("display", "block"), $(a).modal({
        show: !0
    })
}

function get_date_format_new(e) {
    var a = new Date(e),
        r = ("0" + a.getDate()).slice(-2),
        t = ("0" + (a.getMonth() + 1)).slice(-2);
    return a.getFullYear() + "-" + t + "-" + r
}

function get_gallery_url_data(e) {
    return [create_gallery_url_new, delete_gallery_url_new, main_gallery_url_new]
}

function gallerySaveSubmitAjax(e) {
   
    var a;
    a = "" != e ? "#galleryForm" + e : "#galleryForm";
    $(a + " #gallery_type").val();
    var r, t, o = $(a + " #gallery_link_type").val();
    arr_url_data = get_gallery_url_data(o), r = arr_url_data[0], t = arr_url_data[2];
    var l = new FormData($("#galleryForm" + e)[0]);
    $.ajax({
        url: r,
        data: l,
        processData: !1,
        contentType: !1,
        dataType: "json",
        type: "POST",
        beforeSend: function() {
            $("#galleryForm .postBtn").show(); 
            $(".gallerySubmitButton").attr("disabled", !0)
            
              // $('.gallerySubmitButton').html('<i class="fa fa-spinner fa-spin postBtn"></i>');
        },
        error: function(a, r) {
            $(".gallerySubmitButton").attr("disabled", !1);
            var t = formatErrorMessage(a, r);
            toastr.error(t), openEditGalleryModal(e)
            $("#galleryForm .postBtn").hide(); 
        },
        success: function(e) {
            window.location.href = t
            $("#galleryForm .postBtn").hide(); 
         }
    })

}

function deleteGalleryModal(e, a) {
    var r, t;
    t = (r = get_gallery_url_data(a))[1], str_save_gallery_url_redirect = r[2];
    var o = confirm("Are you sure");
    postData = {
        gallery_id: e,
        _token: ajax_csrf_token_new
    }, o && $.ajax({
        url: t,
        data: postData,
        headers: {
            "X-CSRF-TOKEN": ajax_csrf_token_new
        },
        type: "POST",
        beforeSend: function() {},
        error: function(e, a) {
            var r = formatErrorMessage(e, a);
            toastr.error(r), console.log(r)
        },
        success: function(e) {
            window.location.href = str_save_gallery_url_redirect
        }
    })
}

function readURL(input) {
$('.custom-file__label .imageLoading').show();
if (input.files && input.files[0]) {
 var reader = new FileReader();
 reader.onload = function(event) {
$(".gallery-upload-preview-class").attr('src', event.target.result);
}
 reader.readAsDataURL(input.files[0]);
}
 $('.custom-file__label .imageLoading').hide();
}

function getImagePreview(e, a) {
    readURL(e)   
}

function showProdEventDropDownByDest(e, a) {
    a > 0 && ($("#" + e + " .assign-prod-event-drop-down-class").hide(), $("#" + e + " #assign-gallery-event-product-div" + a).show())
}

function deleteRoleDataModal(e) {
    var a = confirm("Are you sure");
    postData = {
        role_id: e
    }, a && $.ajax({
        url: base_url_new + str_delete_role_data_url_ajax + "/" + e,
        data: postData,
        processData: !1,
        contentType: !1,
        type: "GET",
        beforeSend: function() {
            $("#edit-profile-roles-data-div").html("Loading. Please Wait...")
        },
        error: function(e, a) {
            var r = formatErrorMessage(e, a);
            toastr.error(r), console.log(r)
        },
        success: function(e) {
            toastr.success(e.message), show_user_roles_edit_profile_data()
        }
    })
}

function readBlogNewsURL(e) {
    if ($("#blah").show(), e.files && e.files[0]) {
        var a = new FileReader;
        a.onload = function(e) {
            $("#blah").attr("src", e.target.result)
        }, a.readAsDataURL(e.files[0])
    }
}

function getExpandCollapseClass() {
    0 == int_hide_collapse_social_icons_flag ? ($("#btn-expand-collapse-social-media-icons").html("<< Collapse"), int_hide_collapse_social_icons_flag = 1) : ($("#btn-expand-collapse-social-media-icons").html("Expand >>"), int_hide_collapse_social_icons_flag = 0)
}

function frontend_show_standard_ckeditor_new(e) {
    CKEDITOR.replace(e, {
        removeButtons: ""
    })
}

function frontend_get_ckeditor_description_new(e) {
    return CKEDITOR.instances[e].getData()
}
$(document).ready(function() {
    document.getElementById("edit-profile-roles-data-div") && show_user_roles_edit_profile_data(), $(document).on("click", "#addRoleModalDiv .addUpdateRoleBtn", function(e) {
        e.preventDefault();
        var a = new FormData($("#addRoleModalDiv #addRoleModalDivForm")[0]);
        $.ajax({
            url: base_url_new + str_save_role_data_url,
            data: a,
            processData: !1,
            contentType: !1,
            dataType: "json",
            type: "POST",
            beforeSend: function() {
                $("#addRoleModalDiv .addUpdateRoleBtn").attr("disabled", !0)
            },
            error: function(e, a) {
                $("#addRoleModalDiv .addUpdateRoleBtn").attr("disabled", !1);
                var r = formatErrorMessage(e, a);
                toastr.error(r), console.log(r)
            },
            success: function(e) {
                $("#addRoleModalDiv .addUpdateRoleBtn").attr("disabled", !1), toastr.success(e.message), $("#addRoleModalDiv").modal("hide"), show_user_roles_edit_profile_data()
            }
        })
    })
});