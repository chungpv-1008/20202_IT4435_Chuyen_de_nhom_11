$("document").ready(function() {
    $("input[type=checkbox]").on("click", filter);
    function filter() {
        $("#all-job").addClass('active')
        $("#suitable-job").removeClass('active')
        $("#all-job-list").css("display", "block");
        $("#suitable-job-list").css("display", "none");
        let tagIdArray = []
        $('.checkbox:checked').each(function() {
            tagIdArray.push($(this).val());
        });
        let url = '/project1/public/filter'
        let token = $('#_token').val();
        $.ajax({
            type: "POST",
            url: url,
            data: {
                tag: tagIdArray,
                _token: $('#_token').val(),
            },
            success: function(data) {
                $("#all-job-list").html(data);
            },
        });
    };
})
