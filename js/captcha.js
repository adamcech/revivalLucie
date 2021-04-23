function captcha_submit(token) {
    document.getElementById("contact-us-form").submit();
}

function captcha_validate(event) {
    event.preventDefault();
    if (check_contact_form()) {
        grecaptcha.execute();
    }
}

function captcha_load() {
    var element = document.getElementById('contact-form-submit');
    element.onclick = captcha_validate;
}