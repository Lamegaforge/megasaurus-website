"use strict";

const menu = document.querySelector(".js-menu");
const mobileBtn = document.querySelector(".js-mobile-btn");

mobileBtn.addEventListener("click", () => {
    mobileBtn.classList.toggle("is-open");
    menu.classList.toggle("is-open");
});
