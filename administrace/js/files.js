var files = null;
var from = 0;
var limit = 60;
var row_count = -1;
var search = false;

// VYTVORENI TABULKY
$( document ).ready(function()
{
    select_limit(from, limit);
});

function refresh_page_items()
{
    container = $(".bottom-pages")[0];
    $(container).empty();

    for (var i = 0; i < Math.ceil(row_count / limit); i++)
    {
        c = "bottom-page-item ";
        c += i == from / limit ? "active-page" : "normal-page";

        var page = $("<a class='"+c+"' onclick='set_from("+i+")' href='#headline'> "+(i+1)+" </a>");

        $(container).append(page);
    }
}

function refresh_page()
{
    var container = $("#files_table");
    $(container).empty();

    var file_layout = $("<div class='file_layout'></div> ");

    for (var i = 0; i < files.length; i++)
    {
        var file_item = $("<div class='file_item'></div>");

        var item_link = $("<a class='item_box' href='/administrace/soubory/"+files[i].id+"/'></a>");

        var span_helper = $("<span class='helper'></span>");

        if (files[i]["shortcut"] == "pdf" || files[i]["shortcut"] == "xps") {
            var file_img = $("<i class='fa fa-file-pdf-o files-icon'></i>");
        } else if (files[i]["shortcut"] == "doc" || files[i]["shortcut"] == "docx" || files[i]["shortcut"] == "odt") {
            var file_img = $("<i class='fa fa-file-word-o files-icon'></i>");
        } else if (files[i]["shortcut"] == "xls" || files[i]["shortcut"] == "xlsx" || files[i]["shortcut"] == "ods") {
            var file_img = $("<i class='fa fa-file-excel-o files-icon'></i>");
        } else if (files[i]["shortcut"] == "ppt" || files[i]["shortcut"] == "pptx" || files[i]["shortcut"] == "pps" || files[i]["shortcut"] == "ppsx" || files[i]["shortcut"] == "odp") {
            var file_img = $("<i class='fa fa-file-powerpoint-o files-icon'></i>");
        } else if (files[i]["shortcut"] == "zip" || files[i]["shortcut"] == "rar") {
            var file_img = $("<i class='fa fa-file-archive-o files-icon'></i>");
        } else if (files[i]["shortcut"] == "mp4" || files[i]["shortcut"] == "avi" || files[i]["shortcut"] == "flv" || files[i]["shortcut"] == "mkv") {
            var file_img = $("<i class='fa fa-file-video-o files-icon'></i>");
        } else if (files[i]["shortcut"] == "mp3" || files[i]["shortcut"] == "flac") {
            var file_img = $("<i class='fa fa-file-audio-o files-icon'></i>");
        } else if (files[i]["shortcut"] == "txt") {
            var file_img = $("<i class='fa fa-file-text-o files-icon'></i>");
        } else if (files[i]["shortcut"] == "jpg" || files[i]["shortcut"] == "jpeg" || files[i]["shortcut"] == "png" || files[i]["shortcut"] == "gif" || files[i]["shortcut"] == "bmp") {
            var file_img = $("<img src='/files/mini/"+files[i].idName+"' alt='"+files[i].name+"'/>");
        } else {
            var file_img = $("<i class='fa fa-file-o files-icon'></i>");
        }

        var item_text = $("<a href='/administrace/soubory/"+files[i].id+"/'><div class='file_name'>"+files[i].name+"</div></a>");

        $(item_link).append(span_helper);
        $(item_link).append(file_img);

        $(file_item).append(item_link);
        $(file_item).append(item_text);

        $(file_layout).append(file_item);
    }
    $(container).append(file_layout);

    if (!search) { select_row_count() }
    else
    {
        container = $(".bottom-pages")[0];
        $(container).empty();
    }
}

function set_from(from)
{
    this.from = from * limit;
    select_limit(this.from, limit);
}

function file_type(name)
{
    str = "";

    for (var i = name.length - 1; i > 0 && name[i] != "."; i--)
    {
        str = name[i] + str;
    }

    return str;
}

function disable_search()
{
    $("#disable_search").hide();
    $("#prod_search").val("");

    search = false;
    from = 0;
    limit = 60;
    select_limit(from, limit);
}

function select_limit(from, limit)
{
    $.ajax(
    {
        url: "/administrace/ajax/files.php",
        type: "POST",
        data: {'type': "selectLimit", 'from': from, 'limit': limit},
        success: function (data)
        {
            files = JSON.parse(data);
            refresh_page();
        }
    });
}

function select_row_count()
{
    $.ajax(
    {
        url: "/administrace/ajax/files.php",
        type: "POST",
        data: {'type': "rowCount"},
        success: function (data)
        {
            row_count = parseInt(data);
            refresh_page_items();
        }
    });
}

function select_search()
{
    query = $("#prod_search").val();

    if (query == "")
    {
        disable_search();
        return;
    }

    if (query.length < 2) { return; }

    search = true;
    $("#disable_search").show();
    query = remove_diacritic(query);

    $.ajax(
        {
            url: "/administrace/ajax/files.php",
            type: "POST",
            data: {'type': "search", 'query': query},
            success: function (data)
            {
                files = JSON.parse(data);
                refresh_page();
            }
        });
}

// VYHLEDAVAC
$(document).on("keyup", "#prod_search", function(event)
{
   select_search();
});

$(document).on("click", "#prod_search_button", function(event)
{
    select_search();
});

$(document).on("click", "#disable_search", function(event)
{
    disable_search();
});