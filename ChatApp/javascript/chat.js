const form = document.querySelector(".typing-area"),
incoming_id = form.querySelector(".incoming_id"),
group_id = form.querySelector(".group_id"),
inputField = form.querySelector(".input-field"),
sendBtn = form.querySelector("button"),
chatBox = document.querySelector(".chat-box");

form.onsubmit = (e) => {
    e.preventDefault();
};

sendBtn.onclick = () => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/insertChat.php", true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                inputField.value = "";
                chatBox.scrollTop = chatBox.scrollHeight;
            }
        }
    };
    let formData = new FormData(form);
    xhr.send(formData);
};

setInterval(() => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/getChat.php", true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                chatBox.innerHTML = xhr.response;
            }
        }
    };
    let formData = new FormData(form);
    xhr.send(formData);
}, 500);
