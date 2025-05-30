const Password = document.getElementById("Password");
const ConfirmPassword = document.getElementById("ConfirmPassword");
const userError = document.getElementById("Errorside");
const TheForm = document.getElementById("myform");

TheForm.addEventListener("submit" , (e)=>{
    if(Password.value !== ConfirmPassword.value){
        e.preventDefault();
        userError.style.display = "block";
        userError.textContent = "Incorrect please make sure your password do match.";
    }else{
        userError.style.display="none";
    }});















// const mySubmit=()=>{
//     // if(Password.value !== ConfirmPassword.value){

//     //     LetterChange.classList.add("errorlogin");
//     //     userError.textContent= "Incorrect Password please enter correct password";

//     // }


//     // if(Password.value !== ConfirmPassword.value){
//     //     LetterChange.style.color ="red";
//     //     LetterChange2.style.color="red";
//     //     userError.textContent="Incorrect password please try again";
//     // }else if(Password.value == ConfirmPassword.value){
//     //     LetterChange.style.color ="green";
//     //     LetterChange2.style.color="green"; 
//     // }
// }

// if(Password.value !== ConfirmPassword.value){

//     LetterChange.classList.toggle("errorlogin");
//     userError.textContent= "Incorrect Password please enter correct password";

// }