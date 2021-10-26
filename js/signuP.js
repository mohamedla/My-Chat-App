const form = document.querySelector('.wrapper .signup form'),
      regisbutton = document.querySelector('.wrapper .signup .button input'),
      errorMessage = document.querySelector('.wrapper .signup .error-txt');

form.onsubmit = (e)=>{
    e.preventDefault();
}

regisbutton.onclick = ()=>{
    let req = new XMLHttpRequest();
    req.open('post','php/signup.php', true);
    req.onload = ()=>{
        if(req.readyState === XMLHttpRequest.DONE){
            if(req.status === 200){
                let data =  req.response;
                if(data == "seccess "){
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