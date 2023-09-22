const btnModify = document.querySelector(".modify");
const form = document.querySelector(".form");
const msgErr = document.querySelector(".error");

btnModify.addEventListener("click", function(){
    if(form.classList.contains("notVisible")){
        form.classList.toggle("isVisible");
        form.classList.remove("notVisible");

        
    }else if(form.classList.contains("isVisible")){
        form.classList.toggle("notVisible");
        form.classList.remove("isVisible");
        //msgError.classList.toggle("is_visible");
        //msgError.classList.remove("not_visbible");
    }
});