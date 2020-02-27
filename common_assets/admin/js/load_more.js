$(document).ready(function(){
   
 
    // Load more data teacher
    $('.load-more-teacher').click(function(){
        var row_teacher = Number($('#row_teacher').val());
        var allcount_teacher = Number($('#all_teacher').val());
        row_teacher = row_teacher + 0;

        if(row_teacher <= allcount_teacher){
            $("#row_teacher").val(row_teacher);

            $.ajax({
                url: base_url+'admin/institute/teacherList',
                type: 'post',
                data: {row:row_teacher,instituteId:$('#instituteId').val()},
                beforeSend:function(){
                    $(".load-more-teacher").text("Loading...");
                },
                success: function(response){

                    // Setting little delay while displaying new content
  
                        // appending posts after last post with class="post"
                        $(".teacherData").append(response);

                        var rowno_teacher = row_teacher + 3;

                        // checking row value is greater than allcount or not
                        if(rowno_teacher >= allcount_teacher){
                            // Change the text and background
                            $('.load-more-teacher').hide();
                            $('.load-more-teacher').css("background","darkorchid");
                        }else{
                            $(".load-more-teacher").text("Load more");
                        }
                  


                }
            });
        }else{
            $('.load-more-teacher').text("Loading...");

            // Setting little delay while removing contents
            setTimeout(function() {
                // Reset the value of row
                $("#row_teacher").val(0);
                // Change the text and background
                $('.load-more-teacher').text("Load more");
            }, 2000);


        }

    });
    $( ".load-more-teacher" ).trigger( "click" );    
    // Load more data staff
    $('.load-more-staff').click(function(){
        var row_staff = Number($('#row_staff').val());
        var allcount_staff = Number($('#all_staff').val());
        row_staff = row_staff + 0;

        if(row_staff <= allcount_staff){
            $("#row_staff").val(row_staff);

            $.ajax({
                url: base_url+'admin/institute/staffList',
                type: 'post',
                data: {row:row_staff,instituteId:$('#instituteId').val()},
                beforeSend:function(){
                    $(".load-more-staff").text("Loading...");
                },
                success: function(response){

                    // Setting little delay while displaying new content
  
                        // appending posts after last post with class="post"
                        $(".staffData").append(response);

                        var rowno_staff = row_staff + 3;

                        // checking row value is greater than allcount or not
                        if(rowno_staff >= allcount_staff){
                            // Change the text and background
                            $('.load-more-staff').hide();
                            $('.load-more-staff').css("background","darkorchid");
                        }else{
                            $(".load-more-staff").text("Load more");
                        }
                  


                }
            });
        }else{
            $('.load-more-staff').text("Loading...");

            // Setting little delay while removing contents
            setTimeout(function() {
                // Reset the value of row
                $("#row_staff").val(0);
                // Change the text and background
                $('.load-more-staff').text("Load more");
            }, 2000);


        }

    });
    $( ".load-more-staff" ).trigger( "click" );
// Load more data student
    $('.load-more-student').click(function(){
        var row_student = Number($('#row_student').val());
        var allcount_student = Number($('#all_student').val());
        row_student = row_student + 0;

        if(row_student <= allcount_student){
            $("#row_student").val(row_student);

            $.ajax({
                url: base_url+'admin/institute/studentList',
                type: 'post',
                data: {row:row_student,instituteId:$('#instituteId').val()},
                beforeSend:function(){
                    $(".load-more-student").text("Loading...");
                },
                success: function(response){

                    // Setting little delay while displaying new content
  
                        // appending posts after last post with class="post"
                        $(".studentData").append(response);

                        var rowno_student = row_student + 3;

                        // checking row value is greater than allcount or not
                        if(rowno_student >= allcount_student){
                            // Change the text and background
                            $('.load-more-student').hide();
                            $('.load-more-student').css("background","darkorchid");
                        }else{
                            $(".load-more-student").text("Load more");
                        }
                  


                }
            });
        }else{
            $('.load-more-student').text("Loading...");

            // Setting little delay while removing contents
            setTimeout(function() {
                // Reset the value of row
                $("#row_student").val(0);
                // Change the text and background
                $('.load-more-student').text("Load more");
            }, 2000);


        }

    });
    $( ".load-more-student" ).trigger( "click" );

});