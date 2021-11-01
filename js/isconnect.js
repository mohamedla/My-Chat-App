setInterval(()=>{
    window.onbeforeunload = function(){
        let req = new XMLHttpRequest();
        req.open("get","php/disconnected.php", true);
        req.onload = ()=>{
            if(req.readyState === XMLHttpRequest.DONE){
                if(req.status === 200){
                }
            }
    
        }
        let formData = new FormData();
        req.send();
    }
},500);