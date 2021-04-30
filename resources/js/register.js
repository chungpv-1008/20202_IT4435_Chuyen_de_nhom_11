$("document").ready(function(){
    $("#employer").change(function(){
        $("#form-employer").css("display","block");
        $("#form-candidate").css("display","none");
    })
    
    $("#candidate").change(function(){
        $("#form-employer").css("display","none");
        $("#form-candidate").css("display","block");
    })
})
