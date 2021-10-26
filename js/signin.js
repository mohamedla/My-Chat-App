const form = document.querySelector('.wrapper .login form'),
        signbutton = document.querySelector('.wrapper .login .button input'),
        errorMessage = document.querySelector('.wrapper .login .error-txt');
form.onsubmit = (e)=>{
    e.preventDefault();
}

signbutton.onclick = ()=>{
    let req = new XMLHttpRequest();
    req.open("post","php/signin.php", true);
    req.onload = ()=>{
        if(req.readyState === XMLHttpRequest.DONE){
            if(req.status === 200){
                let data =  req.response;
                if(data == "seccess"){
                    location.href = "user.php";
                    console.log("user");
                }else{
                    errorMessage.textContent = data;
                    errorMessage.style.display = 'block';
                }
            }
        }

    }
    let formData = new FormData(form);
    req.send(formData);
}