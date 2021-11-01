const searchbar = document.querySelector('.user .search input'),
      searchbutton = document.querySelector('.user .search button'),
      userslist = document.querySelector('.user .users-list');
searchbutton.onclick = ()=>{
    searchbar.classList.toggle('active');
    searchbar.focus();
    searchbutton.classList.toggle('active');
    searchbar.value = "";
}

searchbar.onkeyup = ()=>{
    let searchCond = searchbar.value;
    if(searchCond != ''){
        searchbar.classList.add('active');
        let req = new XMLHttpRequest();
        req.open('post','php/search.php', true);
        req.onload = ()=>{
            if(req.readyState === XMLHttpRequest.DONE){
                if(req.status === 200){
                    let data =  req.response;
                    userslist.innerHTML = data;
                }
            }

        }
        req.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        req.send("searchCond=" + searchCond);
    }else{
        searchbar.classList.remove('active');
    }
}

setInterval(()=>{
    let req = new XMLHttpRequest();
    req.open('GET','php/user.php', true);
    req.onload = ()=>{
        if(req.readyState === XMLHttpRequest.DONE){
            if(req.status === 200){
                let data =  req.response;
                if(!searchbar.classList.contains('active')){
                    userslist.innerHTML = data;
                }
                
            }
        }
    }
    req.send();
},500);