"use strict";

import "@splidejs/splide/css/core";
import Splide from "@splidejs/splide";

/**
 * TODO
 * Make one function
 * Use stack and push to simplify
 * Find a way to import the file once for each slider component
 */

new Splide(".js-latest-clips-slider", {
    type: "slide",
    padding: "3rem",
    mediaQuery: "min",
    breakpoints: {
        640: {
            perPage: 2,
        },
        1024: {
            perPage: 4,
            perMove: 4,
        }
    },
    classes: {
        prev: "arrow arrow--prev",
        next: "arrow arrow--next"
    },
    pagination: false,
}).mount();

new Splide(".js-latest-games-slider", {
    type: "slide",
    padding: "3rem",
    mediaQuery: "min",
    breakpoints: {
        640: {
            perPage: 2,
        },
        1024: {
            perPage: 4,
            perMove: 4,
        }
    },
    classes: {
        prev: "arrow arrow--prev",
        next: "arrow arrow--next"
    },
    pagination: false,
}).mount();

new Splide(".js-popular-games-slider", {
    type: "slide",
    padding: "3rem",
    mediaQuery: "min",
    breakpoints: {
        640: {
            perPage: 2,
        },
        1024: {
            perPage: 4,
            perMove: 4,
        }
    },
    classes: {
        prev: "arrow arrow--prev",
        next: "arrow arrow--next"
    },
    pagination: false,
}).mount();
