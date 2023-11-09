$(document).ready(function(){

    $("body").on("click", "#next", function (event) {
        event.preventDefault();
        var q_id = $("#q_id").val();
        var u_id = $("#u_id").val();
        var answer;
        choice1 = document.getElementById('optA');
        choice2 = document.getElementById('optB');
        choice3 = document.getElementById('optC');
        if(choice1.checked) {
            answer = $("#optA").val();
        }
        
        if(choice2.checked) {
            answer = $("#optB").val();
        }
        if(choice3.checked) {
            answer = $("#optC").val();
        } 
        if(typeof answer == 'undefined'){
            alert("Please Choose An Answer");
            return
          }else{
            $.ajax({
              url: "./backend/action.php",
              method: "POST",
              data: {
                next: 1,
                q_id: q_id,
                u_id: u_id,
                answer: answer
              },
              success: function (response) {
                location.href = 'index.php';

             },
                error: function (error) {
                alert(error);
             }
            });
          }
    });   








});
