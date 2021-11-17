function volumeToggle(button) {
    var muted = $(".preview-video").prop("muted");
    $(".preview-video").prop("muted", !muted);

    $(button).find("i").toggleClass("fa-volume-mute");
    $(button).find("i").toggleClass("fa-volume-up");
}

function previewEnded() {
    $(".preview-video").toggle();
    var x = document.getElementsByClassName("preview-image");
    x[0].removeAttribute("hidden");
    // $(".preview-image").toggle();
}

function goBack() {
    window.history.back();
}
