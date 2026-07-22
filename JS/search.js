var currentSort = "";
const params = new URLSearchParams(window.location.search);
if (params.get("sort") != null) {
    currentSort = params.get("sort");
}
var currentPage = window.location.pathname;
var timer;
var tts = window.tts;

$("#voice").on("click", function () {
    var recognition = new webkitSpeechRecognition();
    recognition.lang = "vi-VN";
    recognition.continuous = false;
    recognition.interimResults = false;
    recognition.start();
    recognition.onresult = function (event) {
        clearTimeout(timer);
        var text = event.results[0][0].transcript;
        $("#spoken-text").val(text);
        var encodedText = encodeURIComponent(text);
        console.log(currentSort);
        timer = setTimeout(function () {
            if (!currentPage.includes("index.php") && !currentPage.includes("sanpham.php")) {
                window.location.href = "sanpham.php?keyword=" + encodedText + "&sort=" + currentSort;
                return;
            }
        }, 800);
        $.ajax({
            url: "searchvoice.php",
            type: "POST",
            data: {
                q: encodedText,
                sort: currentSort,
            },
            success: function (data) {
                $("#search-results").html(data);
            },
        });
    };
});

$(document).ready(function () {
    $("#spoken-text").on("input", function () {
        clearTimeout(timer);
        var searchKeyword = $(this).val().trim();
        if (searchKeyword.length > 0) {
            console.log(currentSort);
            timer = setTimeout(function () {
                if (!currentPage.includes("index.php") && !currentPage.includes("sanpham.php")) {
                    window.location.href = "sanpham.php?keyword=" + encodeURIComponent(searchKeyword) + "&sort=" + currentSort;
                    return;
                }
            }, 800);
            $.ajax({
                url: "search.php",
                type: "POST",
                data: {
                    keyword: searchKeyword,
                    sort: currentSort,
                },
                success: function (data) {
                    $("#search-results").html(data);
                },
            });
        } else {
            window.location.href = "sanpham.php";
        }
    });
});
