"use strict";

const menu = document.querySelector(".js-menu");
const mobileBtn = document.querySelector(".js-mobile-btn");
const mobileBtnBurger = document.querySelector(".js-mobile-burger");
const mobileBtnCross = document.querySelector(".js-mobile-cross");

mobileBtn.addEventListener("click", () => {
    mobileBtnBurger.classList.toggle("hidden");
    mobileBtnCross.classList.toggle("hidden");
    menu.classList.toggle("hidden");
});
