const imgfile = document.getElementById("imgfile"),
      imgbutton = document.getElementById("imgbutton"),
      namebutton = document.getElementById("namebutton"),
      passbutton = document.getElementById("passbutton"),
      updateform = document.querySelector(".profileAtt .form form");


imgfile.onchange = ()=>{
    const image = imgfile.files;
    if (image && image[0]) {

        var reader = new FileReader();
        reader.onload = function (e) { 
            document.querySelector("#imgviewer").setAttribute("src",e.target.result);
            document.getElementById("imgfile").setAttribute("opacity",1);
            document.getElementById("filelab").setAttribute("dispaly","none");
        };
    
        reader.readAsDataURL(image[0]); 
    }
};

imgbutton.onclick = ()=>{
    update('updateimg.php');
}

namebutton.onclick = ()=>{
    update('updatename.php');
}

passbutton.onclick = ()=>{
    update('updatepassword.php');
}

function update (driver){
    let req = new XMLHttpRequest();
    req.open("post","php/"+driver, true);
    req.onload = ()=>{
        if(req.readyState === XMLHttpRequest.DONE){
            if(req.status === 200){
            }
        }
    }
    let formData = new FormData(updateform);
    req.send(formData);
}

