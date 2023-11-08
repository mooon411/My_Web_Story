hljs.highlightAll();
 
 // 모달
 const modalBtn = document.querySelector(".modal_btn");
 const modalClose = document.querySelector(".modal_close");
 const modalCont = document.querySelector(".modal_cont");

 modalBtn.addEventListener("click", () => {
     modalCont.classList.add("show");
     modalCont.classList.remove("hide");
 });
 modalClose.addEventListener("click", () => {
     modalCont.classList.add("hide");
 });