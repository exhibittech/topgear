const copyBtn = document.querySelector(".tg-copy");
const facebookBtn = document.querySelector(".tg-fb");
const twitterBtn = document.querySelector(".tg-tw");
const whatsappBtn = document.querySelector(".tg-wa");

function init(){
    let postUrl = encodeURI(document.location.href);
    let postTitle = encodeURI("BBC TopGear Magazine India");

    facebookBtn.setAttribute(
        "href",
        `https://www.facebook.com/sharer.php?u=${postUrl}`
      );
    
      twitterBtn.setAttribute(
        "href",
        `https://twitter.com/share?url=${postUrl}&text=${postTitle}`
      );

      whatsappBtn.setAttribute(
        "href",
        `https://wa.me/?text=${postTitle} ${postUrl}`
      );
}
init();