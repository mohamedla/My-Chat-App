const form = document.querySelector(".typing-area"),
        forminput = document.querySelector(".typing-area .massege"),
        formbutton = document.querySelector(".typing-area button"),
        formimg = document.getElementById("myimg"),
        formvideo = document.getElementById("myvideo"),
        formaudio = document.getElementById("myaudio"),
        formfile = document.getElementById("myfile"),
        chatBox = document.querySelector(".chat-box"),
        userDet = document.querySelector(".chat-area header .details");


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

Object.defineProperty(HTMLMediaElement.prototype, 'playing', {
    get: function(){
        return !!(this.currentTime > 0 && !this.paused && !this.ended && this.readyState > 2);
    }
})

var func = ()=>{
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
                var vid = document.querySelectorAll('video');
                for(video of vid) { 
                    video.onplay  = ()=>{clearInterval(chatIntervalID);};
                    video.onpause   = function () {chatIntervalID = setInterval( func , 500 );};
                }
                var aud = document.querySelectorAll('audio');
                for(audio of aud) { 
                    audio.onplay  = ()=>{clearInterval(chatIntervalID);};
                    audio.onpause   = function () {chatIntervalID = setInterval( func , 500 );};
                }
            }   
        }

    }
    let formData = new FormData(form);
    req.send(formData);
}

var chatrefresh =  ()=>{
    let req = new XMLHttpRequest();
    req.open('post','php/get-chat.php', true);
    req.onload = ()=>{
        if(req.readyState === XMLHttpRequest.DONE){
            if(req.status === 200){
                let data =  req.response;
                var splited =  data.split('^');
                console.log(splited[1]);
                chatBox.innerHTML = splited[0];
                var newInput = document.getElementById("lastmsg");
                newInput.setAttribute('value', splited[1]);
                if(!chatBox.classList.contains("active")){
                    scrollToBottom();
                }
            }   
        }

    }
    let formData = new FormData(form);
    req.send(formData);
};

var chatset = setTimeout (chatrefresh);

setInterval(
    ()=>{
        let req = new XMLHttpRequest();
        req.open('post','php/check-new-msg.php', true);
        req.onload = ()=>{
            if(req.readyState === XMLHttpRequest.DONE){
                if(req.status === 200){
                    let data =  req.response;
                    if(data == 'new'){
                        clearTimeout( chatset );
                        chatset = setTimeout(chatrefresh);
                    }
                }   
            }
        }
        let formData = new FormData(form);
        req.send(formData);
    }
,500)

function scrollToBottom(){
    chatBox.scrollTop = chatBox.scrollHeight;
}

setInterval(()=>{
    let req = new XMLHttpRequest();
    req.open('post','php/get-user-data.php', true);
    req.onload = ()=>{
        if(req.readyState === XMLHttpRequest.DONE){
            if(req.status === 200){
                let data =  req.response;
                userDet.innerHTML = data;
            }
        }

    }
    let formData = new FormData(form);
    req.send(formData);
},500);

formimg.onchange = ()=>{
    addfile("insert-img.php");
};

formvideo.onchange = function(){
    addfile("insert-video.php");
};

formaudio.onchange = function(){
    addfile("insert-audio.php");
};

formfile.onchange = ()=>{
    addfile("insert-file.php");
};

function addfile(direc) {
    let req = new XMLHttpRequest();
    req.open("post","php/"+direc, true);
    req.onload = ()=>{
        if(req.readyState === XMLHttpRequest.DONE){
            if(req.status === 200){
                if(!chatBox.classList.contains("active")){
                    scrollToBottom();
                }
            }
        }

    }
    let formData = new FormData(form);
    req.send(formData);
}

function displaylist() {
    var attachlist = document.getElementById('file-sender'),
    buttondiv = document.getElementById('attachlink');
    if (attachlist.style.display === "none") {
        attachlist.style.display = "block";
    } else {
        attachlist.style.display = "none";
    }
}
var attachbutton = document.getElementById('button-file');
attachbutton.onclick = displaylist;
