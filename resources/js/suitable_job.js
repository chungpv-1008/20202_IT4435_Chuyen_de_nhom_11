$("document").ready(function() {
    $("#suitable-job-list").css("display", "none");
    $("#all-job").click(function() {
        $("#all-job-list").css("display", "block");
        $("#suitable-job-list").css("display", "none");
    })

    $("#suitable-job").click(function() {
        $("#all-job-list").css("display", "none");
        $("#suitable-job-list").css("display", "block");
    })
})
