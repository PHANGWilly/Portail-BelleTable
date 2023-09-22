const btn = document.querySelector(".btn__add_employe");
const form = document.querySelector(".form__ajout_employe");
const msgErr = document.querySelector(".error");

btn.addEventListener("click", function(){
    if(form.classList.contains("not_visible")){
        form.classList.toggle("is_visible");
        form.classList.remove("not_visible");

        
    }else if(form.classList.contains("is_visible")){
        form.classList.toggle("not_visible");
        form.classList.remove("is_visible");
        //msgError.classList.toggle("is_visible");
        //msgError.classList.remove("not_visbible");
    }
});