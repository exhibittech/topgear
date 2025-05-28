var tg_event = document.querySelectorAll('.tg-search');
tg_event.forEach(search => {
    search.addEventListener("click",  function(){
        document.querySelector(".tg-dropdown-wrap").classList.toggle("active");
        document.querySelector(".tg-searchform").classList.toggle("show");
    });        
});