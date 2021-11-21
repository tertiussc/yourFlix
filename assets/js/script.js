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

function startHideTimer() {
    var timeout = null;

    $(document).on("mousemove", function () {
        clearTimeout(timeout);
        $(".watch-nav").fadeIn();

        timeout = setTimeout(function () {
            $(".watch-nav").fadeOut();
        }, 2000);
    });
}

function initVideo(videoId, username) {
    startHideTimer();
    // call update function
    updateProgressTimer(videoId, username);
}

function updateProgressTimer(videoId, username) {
    addDuration(videoId, username);

    var timer;

    $("video")
        .on("playing", function (event) {
            window.clearInterval(timer);
            timer = window.setInterval(function () {
                updateProgress(videoId, username, event.target.currentTime);
            }, 3000);
        })
        .on("ended", function () {
            window.clearInterval(timer);
        });
}

function updateProgress(videoId, username, progress){
    $.post(
        "assets/ajax/update_duration.php",
        { videoId: videoId, username: username, progress: progress },
        function (data) {
            if (data !== null && data !== "") {
                alert(data);
            }
        }
    );;
}

function addDuration(videoId, username) {
    $.post(
        "assets/ajax/add_duration.php",
        { videoId: videoId, username: username },
        function (data) {
            if (data !== null && data !== "") {
                alert(data);
            }
        }
    );
}
