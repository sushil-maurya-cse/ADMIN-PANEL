  
 $(document).ready(function(){  
      $('#userTable').DataTable();  
 });
 
      
        jQuery.validator.addMethod("noSpace", function(value, element) { 
    return value == '' || value.trim().length != 0;  
}, "No space please and don't leave it empty");
        if ($("#usertable").length > 0) {
        $("#usertable").validate({
          rules: {
                name: {
                    required: true,
                    minlength:5,
                    maxlength: 15,
                    noSpace:true
                },
 
                email: {
                    required: true,
                    email:true
                },
 
                password: {
                    required: true,
                    minlength:6,
                },
            },
            messages: {
 
                name: {
                    required: "Please enter name",
                },
                email: {
                    required: "Please enter valid email",
                },
                 password: {
                    required: "Please enter password",
                },
            },
        })
    } 
 