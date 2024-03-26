function validatesignupform() {

    let form = document.getElementById('signupform');
        let email = document.getElementById('signupemail');
        let password = document.getElementById('signuppassword');
        let fname = document.getElementById('signupfname');
        let lname = document.getElementById('signuplname');
        let checkbox = document.getElementById('check1');
        let flag = 1;
          if(email.value == ""){
            document.getElementById("erroremail").innerHTML="Email is not entered";
            flag =0;
          }
          else{
            document.getElementById("erroremail").innerHTML="";
            flag =1;
          }
  
          if(password.value == ""){
            document.getElementById("errorpassword").innerHTML="Password is not entered";
            flag =0;
          }
          else if(password.value.length < 10){
            document.getElementById("errorpassword").innerHTML="Password should be 10 characters";
            flag =0;
          }
          
          else{
            document.getElementById("errorpassword").innerHTML="";
            flag =1;
          }
  
          if(fname.value == ""){
            document.getElementById("errorfname").innerHTML="First name is not entered";
            flag =0;
          }
          else{
            document.getElementById("errorfname").innerHTML="";
            flag =1;
          }
  
          if(lname.value == ""){
            document.getElementById("errorlname").innerHTML="Last name is not entered";
            flag =0;
          }
          else{
            document.getElementById("errorlname").innerHTML="";
            flag =1;
          }
          
          if(flag){
            return true;
          }else{
            return false;
          }
          
          return true;
        }