$("document").ready(function() {
    $("#unapproved_job_list").css("display","none");
    $("#approved_job").click(function(){
        $("#approved_job_list").css("display","block");
        $("#unapproved_job_list").css("display","none");
    })

    $("#unapproved_job").click(function() {
        $("#approved_job_list").css("display","none");
        $("#unapproved_job_list").css("display","block");
    })
})
