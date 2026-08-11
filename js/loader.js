window.addEventListener("load", () => {

    const loader = document.getElementById("loader");
    const bar = document.querySelector(".progress-bar");

    // Espera a barra completar
    setTimeout(() => {

        loader.classList.add("hide");

        setTimeout(() => {
            loader.remove();
        },800);

    },3500);

});


document.addEventListener('DOMContentLoaded',function(){
    const form=document.getElementById('form');
    const loader=document.getElementById('loader');

    form.addEventListener('submit',function(){
        loader.style.display='block';
    });
    const telefone=document.getElementById('telefone'); 
    if(telefone){
        telefone.addEventListener('input',function(e){
            let valor=e.target.value.replace(/\D/g,'');
            valor=valor.substring(0,11);
            let numeroformatado='';
            if(valor.length>0) numeroformatado+='('+valor.substring(0,2);
            if(valor.length>=3) numeroformatado+=')';
            if(valor.length>10){
                numeroformatado+=valor.substring(2,7);
            
            if (valor.length>=8){
                numeroformatado+='-'+ valor.substring(7,11);
            }
        }else if (valor.length>6){
            numeroformatado +=valor.substring(2,6);
            numeroformatado +='-'+valor.substring(6,10);
        }else if (valor.length> 2){
            numeroformatado+=valor.substring(2);
        }

        e.target.value=numeroformatado;
        
    });
    }

});