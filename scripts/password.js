function showPWD(){
    let pwdInput = document.querySelectorAll(".pas");
    console.log(pwdInput);
    pwdInput.forEach(element => {

        const type = element.getAttribute("type") === "password" ? "text" : "password";
        element.setAttribute("type", type);
    }) 
}z