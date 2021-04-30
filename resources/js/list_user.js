$("document").ready(function() {
    $("#candidate_list").css("display","none");
    $("#employer").click(function() {
        $("#employer_list").css("display","block");
        $("#candidate_list").css("display","none");
    })

    $("#candidate").click(function() {
        $("#employer_list").css("display","none");
        $("#candidate_list").css("display","block");
    })

    $(".button-confirm").on("click", check);
    function check() {
        return confirm($(".button-confirm").attr('data-confirm'))
    }
})
