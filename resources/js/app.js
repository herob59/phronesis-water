import './bootstrap';

import * as bootstrap from 'bootstrap';

window.bootstrap = bootstrap;



document.addEventListener("DOMContentLoaded", () => {

    const header = document.getElementById("siteHeader");

    window.addEventListener("scroll", () => {

        if(window.scrollY > 80){

            header.classList.add("scrolled");

        }else{

            header.classList.remove("scrolled");

        }

    });

});