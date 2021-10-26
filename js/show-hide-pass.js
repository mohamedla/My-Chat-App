const passField = document.querySelector('.form .field input[type="password"]'),
      iconbutton = document.querySelector('.form .field i');
iconbutton.onclick = ()=>{
  if(passField.type == 'password'){
    passField.type = 'text';
    iconbutton.classList.add('active');
  }else{
    passField.type = 'password';
    iconbutton.classList.remove('active');

  }
}
