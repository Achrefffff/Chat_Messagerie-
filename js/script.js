const _=(element) =>{
  return document.querySelector(element);
}


const label =document.getElementById("label_chat");
label.addEventListener("click",()=>{
    try {
        const inner_panel = _(".inner-left-pannel");
        let ajax = new XMLHttpRequest();
        ajax.onload = () => {
          if (
            ajax.status === 200 ||
            ajax.status === 201 ||
            ajax.readyState === 4
          ) {
            inner_panel.innerHTML = ajax.responseText;
          }
        };
        ajax.open("POST", "file.txt", true);
        ajax.send();
    }
    catch (error) {
        console.log(error, "error");
    }
     
})