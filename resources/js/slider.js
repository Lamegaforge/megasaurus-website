"use strict";

import "@splidejs/splide/css/core";
import Splide from "@splidejs/splide";

for (const slide of document.getElementsByClassName("splide")) {
    new Splide(slide, {
        type: "slide",
        padding: "1rem",
        gap: "2rem",
        mediaQuery: "min",
        perPage: 2,
        breakpoints: {
            640: {
                perPage: 4,
                perMove: 4,
            },
            1024: {
                padding: 0,
                perPage: 6,
                perMove: 6,
            }
        },
        classes: {
            prev: "arrow arrow--prev",
            next: "arrow arrow--next"
        },
        pagination: false,
    }).mount();
}
