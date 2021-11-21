/**
 * custom javascript functions
 */

// switches mute on and off
function volumeToggle(button) {
    var muted = $(".preview-video").prop("muted");
    $(".preview-video").prop("muted", !muted);

    $(button).find("i").toggleClass("fa-volume-mute");
    $(button).find("i").toggleClass("fa-volume-up");
}

// raplaces the preview video with a poster img after the video has finished playing
function previewEnded() {
    $(".preview-video").toggle();
    var x = document.getElementsByClassName("preview-image");
    x[0].removeAttribute("hidden");
    // $(".preview-image").toggle();
}

// enables the use to go back to the previous page
function goBack() {
    window.history.back();
}

// fades the back and title overlay in and out on the video player
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

// initiates the fade timer and update progress
function initVideo(videoId, username) {
    startHideTimer();

    updateProgressTimer(videoId, username);
}

// calls the update timers and finished watching indicator 
function updateProgressTimer(videoId, username) {
    addDuration(videoId, username);

    var timer;

    $("video")
        .on("playing", function (event) {
            window.clearInterval(timer);
            timer = window.setInterval(function () {
                // call the update progress function
                updateProgress(videoId, username, event.target.currentTime);
            }, 3000);
        })
        .on("ended", function () {
            window.clearInterval(timer);
            // call the set finished function
            setFinished(videoId, username);
        });
}

// Adds a duration to the DB if a video has never been watched
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

// tracks the video playing progress
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

// tracks if a video has been watched finished
function setFinished(videoId, username) {
    $.post(
        "assets/ajax/set_finished.php",
        { videoId: videoId, username: username },
        function (data) {
            if (data !== null && data !== "") {
                alert(data);
            }
        }
    );
}


