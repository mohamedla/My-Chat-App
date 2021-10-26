const form = document.querySelector(".typing-area"),
        forminput = document.querySelector(".typing-area .massege"),
        formbutton = document.querySelector(".typing-area button"),
        chatBox = document.querySelector(".chat-box");

form.onsubmit = (e)=>{
    e.preventDefault();
}
chatBox.onmouseenter = ()=>{
    chatBox.classList.add("active");
}
chatBox.onmouseleave = ()=>{
    chatBox.classList.remove("active");
}
formbutton.onclick = ()=>{
    let req = new XMLHttpRequest();
    req.open("post","php/insert-msg.php", true);
    req.onload = ()=>{
        if(req.readyState === XMLHttpRequest.DONE){
            if(req.status === 200){
                forminput.value  = "";
                if(!chatBox.classList.contains("active")){
                    scrollToBottom();
                }
            }
        }

    }
    let formData = new FormData(form);
    req.send(formData);
}

setInterval(()=>{
    let req = new XMLHttpRequest();
    req.open('post','php/get-chat.php', true);
    req.onload = ()=>{
        if(req.readyState === XMLHttpRequest.DONE){
            if(req.status === 200){
                let data =  req.response;
                chatBox.innerHTML = data;
                if(!chatBox.classList.contains("active")){
                    scrollToBottom();
                }
            }
        }

    }
    let formData = new FormData(form);
    req.send(formData);
},500);

function scrollToBottom(){
    chatBox.scrollTop = chatBox.scrollHeight;
}