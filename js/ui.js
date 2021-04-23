function print_gallery(element_id, gallery, tags, wow_max_random) {
    let container = $("#"+element_id);
    container.empty();

    let container_fluid = $("<div class='container-fluid'></div>");

    // HEADER
    container_fluid.append('<div class="row"><div class="col wow fadeInUp" data-wow-delay="100ms"><h3>Galerie</h3><div class="line"></div></div></div>');

    // TAGS
    let tags_row = $('<div class="row"></div>');
    let row_col = $('<div class="col-12"></div>');
    let menu_container = $('<div class="alime-projects-menu wow fadeInUp" data-wow-delay="100ms"></div>');
    let text_container = $('<div class="portfolio-menu text-center"></div>');
    let all = $('<button class="btn active" data-filter="*">Vše</button>');

    tags_row.append(row_col);
    row_col.append(menu_container);
    menu_container.append(text_container);
    text_container.append(all);
    for (let i = 0; i < tags.length; i++) {
        text_container.append('<button class="btn" data-filter=".tag' + tags[i]["id"] + '">' + tags[i]["name"] + '</button>');
    }
    container_fluid.append(tags_row);

    // ITEMS
    let portfolio = $('<div class="row alime-portfolio"></div>');
    for (let i = 0; i < gallery.length; i++) {
        let item_container = $('<div class="col-12 col-sm-6 col-lg-3 single_gallery_item tag' + gallery[i]["tag"]["id"] + ' mb-30 wow fadeInUp" data-wow-delay="' + String(100 + parseInt(Math.random() * wow_max_random)) + 'ms"></div>');
        let item_content = $('<div class="single-portfolio-content"></div>');
        let item_img = $('<img src="/files/mini/' + gallery[i]["file"]["idName"] + '" alt="' + gallery[i]["file"]["name"] + '"/>');
        let item_hover = $('<div class="hover-content"><a href="/files/' + gallery[i]["file"]["idName"] + '" class="portfolio-img">+</a></div>');

        item_container.append(item_content);
        item_content.append(item_img);
        item_content.append(item_hover);

        portfolio.append(item_container);
    }
    container_fluid.append(portfolio);

    // SHOW MORE
    container_fluid.append('<div class="row"><div class="col-12 text-center wow fadeInUp" data-wow-delay="800ms"><a href="#" class="btn alime-btn btn-2 mt-15">Více</a></div></div>');

    container.append(container_fluid);
}


function check_contact_form() {

    if ($("#message-name").val().length === 0) {
        alert("Vyplňte své jméno.");
        return false;
    }

    let telefon = document.getElementById("message-phone");
    let cisla = 0;

    for (let i = 0; i < telefon.value.length; i++) {
        if (telefon.value.charCodeAt(i) >= 48 && telefon.value.charCodeAt(i) <= 57) {
            cisla++;
        }
    }

    if (cisla !== telefon.value.length) {
        alert("Telefon může obsahovat pouze čísla.");
        return false;
    }
    if (telefon.value.length < 9) {
        alert("Telefon musí mít minimálně 9 znaků.");
        return false;
    }

    if (!validateEmail(document.getElementById("message-email").value)) {
        alert("Špatný e-mail.");
        return false;
    }

    if ($("#message-content").val().length === 0) {
        alert("Napište zprávu.");
        return false;
    }

    disable_submit('contact-form-submit');
    return true
}

function disable_submit(element_id) {
    $("#"+element_id).prop("disabled", "true");
}

function validateEmail(email) {
    var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    return re.test(email);
}

function set_href(elementId, file) {
    $("#" + elementId).prop("href", "/files/" + file["idName"]);
}

function print_concert_counter(parent_id, count) {
    $("#" + parent_id).text(40 + (count - (count % 10)));
}

function print_members(parent_id, members, delay) {
    for (let i = 0; i < members.length; i++) {
        $("#" + parent_id).append(print_member(members[i], (i+1) * delay));
    }
}

function print_member(member, delay) {
    let name = member["name"];
    let role = member["role"];
    let img_src = "/files/" + member["file"]["idName"];

    let col = $("<div class='col'></div>");
    let team_member = $("<div class='team-content-area mb-30 wow fadeInDown' data-wow-delay='" + delay + "ms'></div>");
    let member_thumb = $("<div class='member-thumb'><img src='" + img_src + "' alt='Alexandr Škoda'></div>");
    let member_name = $("<h5>" + name + "<br class='only-phone'/><span class='only-phone'>" + role + "</span></h5>");
    let member_role = $("<span class='only-desktop'>" + role + "</span>");

    col.append(team_member);
    team_member.append(member_thumb);
    team_member.append(member_name);
    team_member.append(member_role);

    return col;
}

function print_contacts(parent_id, contacts) {
    for (let i = 0; i < contacts.length; i++) {
        $("#" + parent_id).append(print_contact(contacts[i]));
    }
}

function print_contact(contact) {
    let person = contact["name"];
    let email = contact["email"];
    let phone = contact["phone"];

    if (person.length === 0) {
        return
    }

    let row = $("<div class='row mt-10'></div>");

    row.append(print_contact_col("h5", "Kontaktní Osoba", "div", person));

    if (email.length === 0) {
        row.append(print_contact_col("p", "Telefon", "a", phone, "tel"));
        row.append(print_contact_col("p", "Email", "a", email, "mailto"));
    } else {
        row.append(print_contact_col("p", "Email", "a", email, "mailto"));
        row.append(print_contact_col("p", "Telefon", "a", phone, "tel"));
    }

    return row;
}

function print_contact_col(header_tag, header_text, content_tag, content_text, link_type = "") {
    let col = $("<div class='col'></div>");
    let contact_info = $("<div class='contact-info mb-10'></div>");

    let contact_header = $("<" + header_tag + ">" + (content_text.length > 0 ? header_text + ": " : "") + "</" + header_tag+ ">");

    let generated_tag = "<" + content_tag + ">";

    if (content_tag === "a") {

        generated_tag = "<" + content_tag + " href='";

        if (link_type === "mailto") {
            generated_tag += "mailto:" + content_text;
        }

        else if (link_type === "tel") {
            generated_tag += "tel:+420" + content_text.replace(/\s/g, '');
        }

        generated_tag += "'>";
    }

    let contact_text = $(generated_tag + content_text + "</" + content_tag+ ">");

    col.append(contact_info);
    contact_info.append(contact_header);
    contact_info.append(contact_text);

    return col;
}

function print_concerts(parent_id_left, parent_id_right, upcoming, past, max_items) {
    let left_list = $("#" + parent_id_left);
    let right_list = $("#" + parent_id_right);

    for (let i = 0; i < upcoming.length; i++) { upcoming[i]["upcoming"] = true; }
    for (let i = 0; i < past.length; i++) { past[i]["upcoming"] = false; }

    let concerts = upcoming;
    for (let i = 0; concerts.length < max_items && past.length > i; i++) { concerts.push(past[i]); }

    for (let i = 0; i < concerts.length / 2; i++) {
        $(left_list).append(build_calendar_date(concerts[i], concerts[i]["upcoming"] || upcoming.length === 0));
    }

    for (let i = concerts.length / 2; i < concerts.length; i++) {
        $(right_list).append(build_calendar_date(concerts[i], concerts[i]["upcoming"] || upcoming.length === 0));
    }
}

function build_calendar_date(concert, no_opacity) {
    let week = ['Neděle', 'Pondělí', 'Úterý', 'Středa', 'Čtvrtek', 'Pátek', 'Sobota'];

    let date = new Date(concert["date"]);

    let day = date.getDate();
    let month = date.getMonth();
    let year = date.getFullYear();
    let	concert_date = new Date(year, month, day);

    let description = concert["name"];
    let place = concert["place"];

    let container = $("<div class='concerts-row " + (no_opacity ? "" : "concerts-old") + "'></div>");

    let figure_container = $("<div class='concerts-column'></div>");
    $(container).append(figure_container);

    let figure = $("<figure class='concert-date'></figure>");
    $(figure_container).append(figure);

    let header = $("<header>" + week[concert_date.getDay()] + "</header>");
    let section = $("<section>" + concert_date.getDate() + ". " + (1 + concert_date.getMonth()) + ". </section>");

    $(figure).append(header);
    $(figure).append(section);

    let formated_text = "<strong>" + description + "</strong><br/>";

    formated_text += "<span class='concerts-lower-font'>";
    if (place.length >= 1) {
        formated_text += place + ", "
    }
    formated_text += concert_date.getDate() + ". " + (1 + concert_date.getMonth()) + ". " + concert_date.getFullYear();
    formated_text += "</span>";

    let text = $("<div class='concerts-column concerts-column-odd'>" + formated_text + "</div>");
    $(container).append(text);

    return container;
}

function print_songs(parent_id, songs) {
    let song_list = $("#" + parent_id);

    for (let i = 0; i < songs.length; i++) {
        $(song_list).append("<li>" + songs[i]["name"] + " <span class='only-desktop song-desc'> - " + songs[i]["comment"] + "</span></li>");

        // $(song_list).append(build_song_row(i, songs[i]["name"], songs[i]["comment"]));
    }
}

function build_song_row(counter, name, description) {

    let container = $("<div class='song-row'></div>");

    let row = $("<div class='row'></div>");
    $(container).append(row);

    let col_name = $("<div class='col'>" + (counter + 1) + ") " + name + " <span class='song-desc'> - " + description + "</span></div>");

    $(row).append(col_name);

    return container;
}

function build_song_row_two_cols(name, description) {

    let container = $("<div class='song-row'></div>");

    let row = $("<div class='row'></div>");
    $(container).append(row);

    let col_name = $("<div class='col'>" + name + "</div>");
    let col_description = $("<div class='song-desc col'> - " + description + "</div>");

    $(row).append(col_name);
    $(row).append(col_description);

    return container;
}