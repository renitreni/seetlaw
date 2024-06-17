import './bootstrap';

window.addEventListener('DOMContentLoaded',()=>{
    let sessionNotif = document.getElementById('notif')

    if(sessionNotif){
        setTimeout(()=>{
            sessionNotif.remove();
        },6000);
    }
})
