const Password = document.getElementById("Password");
const ConfirmPassword = document.getElementById("ConfirmPassword");
const userError = document.getElementById("Errorside");
const TheForm = document.getElementById("myform");


TheForm.addEventListener("submit" , (e)=>{
    if(Password.value !== ConfirmPassword.value){
        e.preventDefault();
        userError.style.display = "block";
        userError.textContent = "Incorrect, password don't match.";
    }else{
        userError.style.display="none";
    }});