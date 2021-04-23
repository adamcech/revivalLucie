let file_picker_selected = true;

let search_type = "all";

let returnElId = "";
let refreshPrevElementId = "";

function openFilePicker(returnElementId, refreshPreviewElementId, onlyImage = false) {
    returnElId = returnElementId;
    refreshPrevElementId = refreshPreviewElementId;

    let fileTypes = "all";

    if (onlyImage) {
        fileTypes = "image";
    }

    filePickerStart(fileTypes);
}

$(function() {
    if ($("#file_picker").length) {
        file_picker = $("#file_picker")[0];

        let window = $("<div id='file_picker_window'></div>");
        let window_overlay = $("<div id='file_picker_window_overlay'></div>");

        let window_overlay_spinner = $("<div><i class='fa fa-circle-o-notch fa-spin' aria-hidden='true'></i></div>");
        window_overlay.append(window_overlay_spinner);

        $(file_picker).append(window_overlay);
        $(file_picker).append(window);

        let window_header = $("<div id='file_picker_window_header'></div>");
        let window_body = $("<div id='file_picker_window_body'></div>");
        let window_footer = $("<div id='file_picker_window_footer'></div>");

        window.append(window_header);
        window.append(window_body);
        // window.append(window_footer);

        let header_content = $("<div id='file_picker_window_header_content'></div>");
        let header_icons = $("<div id='file_picker_window_header_icons'><i id='file_picker_window_header_icons_close' class='fa fa-times fa-30px' aria-hidden='true'></i></div>");

        window_header.append(header_content);
        window_header.append(header_icons);

        let header_content_search_bar = $("<div id='header_content_search_bar'><label>Hledat:</label><input onkeyup='filePickerSearch()' value='' type='text' placeholder='Hledat' id='file_picker_search'/></div>");
        header_content.append(header_content_search_bar);

        let header_content_upload = $("<div id='header_content_upload'><label id='file_upload_label'>Nahrát soubor:</label><input id='file_picker_upload_input' type='file' name='upload_file'/><input type='button' id='file_picker_upload' value='Nahrát'/></div>");
        header_content.append(header_content_upload);

        let window_footer_select = $("<div id='file_picker_window_footer_select'><button id='file_picker_select'>Vybrat</button></div>");
        window_footer.append(window_footer_select);
    }
});

function filePickerStart(selected_search_type) {
    search_type = selected_search_type;


    if ($("#file_picker_src").length) {
        $("#file_picker_src").remove();
    }

    if ($("#file_picker_alt").length) {
        $("#file_picker_alt").remove();
    }

    $(".tox-dialog-wrap").css("display", "none");
    $("#file_picker").css("display", "block");

    $("#file_picker_search").val("");
    $("#file_picker_search").focus();
    filePickerSearch();
}

function filePickerEnd(id, name, idName, type, shortcut) {
    console.log(id, name, idName, type, shortcut);

    refreshPreviewBox(name, shortcut, "/files/" + idName);
    $("#"+returnElId).val(id);

    file_picker_selected = true;
    close();
}

function refreshPreviewBox(name, shortcut, link) {
    let box = $("#"+refreshPrevElementId);
    box.empty();


    let itemBox = $("<a class='item_box' target='_blank' href='"+link+"'></a>");
    let helper = $("<span class='helper'></span>");
    let faIcon = $(generateBoxContent(name, shortcut, link));


    itemBox.append(helper);
    itemBox.append(faIcon);



    let itemLabel = $("<a href='"+link+"' target='_blank'></a>");
    let fileName = $("<div class='file_name'>"+name+"</div>");
    itemLabel.append(fileName);

    box.append(itemBox);
    box.append(itemLabel);
}

function generateBoxContent(name, shortcut, link) {
    console.log(name, shortcut, link);

    if (shortcut === "jpg" || shortcut === "jpeg" || shortcut === "png" || shortcut === "gif" || shortcut === "bmp") {
        return "<img src='"+link+"' alt='"+name+"'/>";
    } else if (shortcut === "pdf" || shortcut === "xps") {
        return "<i class='fa fa-file-pdf-o files-icon'></i>";
    } else if (shortcut === "doc" || shortcut === "docx" || shortcut === "odt") {
        return "<i class='fa fa-file-word-o files-icon'></i>";
    } else if (shortcut === "xls" || shortcut === "xlsx" || shortcut === "ods") {
        return "<i class='fa fa-file-excel-o files-icon'></i>";
    } else if (shortcut === "ppt" || shortcut === "pptx" || shortcut === "pps" || shortcut === "ppsx" || shortcut === "odp") {
        return "<i class='fa fa-file-powerpoint-o files-icon'></i>";
    } else if (shortcut === "zip" || shortcut === "rar") {
        return "<i class='fa fa-file-archive-o files-icon'></i>";
    } else if (shortcut === "mp4" || shortcut === "avi" || shortcut === "flv" || shortcut === "mkv") {
        return "<i class='fa fa-file-video-o files-icon'></i>";
    } else if (shortcut === "mp3" || shortcut === "flac") {
        return "<i class='fa fa-file-audio-o files-icon'></i>";
    } else if (shortcut === "txt") {
        return "<i class='fa fa-file-text-o files-icon'></i>";
    } else {
        return "<i class='fa fa-file-o files-icon'></i>";
    }
}

function close() {
    $("#file_picker").css("display", "none");
}

$(document).on("click", "#file_picker_select", function(event) {});

$(document).on("click", "#file_picker_window_header_icons_close", function(event) {
    file_picker_selected = false;
    close();
});

$(document).on("click", ".file_picker_window_body_item", function(event) {
    let target = event.target;

    let i = 0;
    while ($(target).attr("fileid") === undefined) {
        target = $(target).parent();

        i++;
        if (i === 10) {
            break;
        }
    }

    filePickerEnd(
        $(target).attr("fileid"),
        $(target).attr("filename"),
        $(target).attr("fileidname"),
        $(target).attr("filetype"),
        $(target).attr("fileshortcut")
    );
});

function filePickerSearch() {
    let search = $("#file_picker_search").val();

    $.ajax({
        url: "/administrace/ajax/files.php",
        type: "POST",
        data: {'type': search_type === "image" ? "searchImages" : "search", 'query': search, 'limit': 50},
        success: function (data) {
            files = JSON.parse(data);
            printSearch(files);
        }
    });
}

function printSearch(files) {
    let layout = $("#file_picker_window_body");
    $(layout).empty();

    for (let i = 0; i < (files.length > 50 ? 50 : files.length) ; i++) {
        let file = files[i];

        let created_icon = "";

        if (file["shortcut"] === "pdf" || file["shortcut"] === "xps") {
            created_icon = "<i class='fa fa-file-pdf-o files-icon'></i>";
        } else if (file["shortcut"] === "doc" || file["shortcut"] === "docx" || file["shortcut"] === "odt") {
            created_icon = "<i class='fa fa-file-word-o files-icon'></i>";
        } else if (file["shortcut"] === "xls" || file["shortcut"] === "xlsx" || file["shortcut"] === "ods") {
            created_icon = "<i class='fa fa-file-excel-o files-icon'></i>";
        } else if (file["shortcut"] === "ppt" || file["shortcut"] === "pptx" || file["shortcut"] === "pps" || file["shortcut"] === "ppsx" || file["shortcut"] === "odp") {
            created_icon = "<i class='fa fa-file-powerpoint-o files-icon'></i>";
        } else if (file["shortcut"] === "zip" || file["shortcut"] === "rar") {
            created_icon = "<i class='fa fa-file-archive-o files-icon'></i>";
        } else if (file["shortcut"] === "mp4" || file["shortcut"] === "avi" || file["shortcut"] === "flv" || file["shortcut"] === "mkv") {
            created_icon = "<i class='fa fa-file-video-o files-icon'></i>";
        } else if (file["shortcut"] === "mp3" || file["shortcut"] === "flac") {
            created_icon = "<i class='fa fa-file-audio-o files-icon'></i>";
        } else if (file["shortcut"] === "txt") {
            created_icon = "<i class='fa fa-file-text-o files-icon'></i>";
        } else if (file["shortcut"] === "jpg" || file["shortcut"] === "jpeg" || file["shortcut"] === "png" || file["shortcut"] === "gif" || file["shortcut"] === "bmp") {
            created_icon = "<img src='/files/mini/" + file["idName"] + "' alt='" + file["name"] + "'/>";
        } else {
            created_icon = "<i class='fa fa-file-o files-icon'></i>";
        }

        let item = $("<div fileid='" + file["id"] + " ' filename='" + file["name"] + "' fileidname='" + file["idName"] + "' filetype='" + file["type"] + "' fileshortcut='" + file["shortcut"] + "' class='file_picker_window_body_item'><div class='file_picker_window_body_item_container'><span class='helper'></span>" + created_icon + "</div><div class='file_picker_window_body_item_label'>" + (file["name"].length > 30 ? file["name"].substring(0, 30) + "..." : file["name"]) + "</div></div>");
        layout.append(item);
    }
}

$(document).on("click", "#file_picker_upload", function(event) {
    if ($('#file_picker_upload_input')[0].files[0] === undefined) {
        alert("Nebyl vložen žádný soubor pro nahrání!");
        return;
    }

    var fd = new FormData();
    var files = $('#file_picker_upload_input')[0].files[0];
    fd.append('files', files);
    fd.append('type', "ajax");

    $.ajax({
        url: '/administrace/executables/uploadFile.php',
        type: 'post',
        data: fd,
        contentType: false,
        processData: false,
        beforeSend: function () {
            beforeSearch();
        },
        success: function(){
            afterSearch(remove_diacritic(files["name"]).toLowerCase());
        },
    });
});

function beforeSearch() {
    $("#file_picker_window_overlay").css("display", "flex");
}

function afterSearch(search) {
    $("#file_picker_window_overlay").css("display", "none");
    $("#file_picker_upload_input").val("");
    $("#file_picker_search").val(search);
    $("#file_picker_search").focus();
    filePickerSearch();
}