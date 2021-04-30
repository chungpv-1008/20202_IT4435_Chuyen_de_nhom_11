$("document").ready(function() {
    $(".button-confirm").on("click", check);
    function check() {
        return confirm($(".button-confirm").attr('data-confirm'))
    }
})
