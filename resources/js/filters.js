"use strict";

document.addEventListener("DOMContentLoaded", () => {
    const filtersBtn = document.querySelector(".js-filters-btn");
    const filtersList = document.querySelector(".js-filters-list");

    createSelectedSvg("views");

    filtersBtn.addEventListener("click", () => {
        filtersList.classList.toggle("is-open");
    });

    filtersList.addEventListener("click", ({ target }) => {
        const clickedFilterBtn = target.closest("button");
        
        if (clickedFilterBtn.classList.contains("js-selected")) {
            return;
        } else {
            clearSelected();
            clickedFilterBtn.classList.add("js-selected");
            createSelectedSvg(clickedFilterBtn.dataset.filter);
        }
    });

    function createSelectedSvg (filter) {
        const parentSelector = `[data-filter=${filter}]`;
        const selectedSvg = document.createElement("span");
        selectedSvg.className = "js-has-svg";
        selectedSvg.innerHTML = `
            <svg
                class="w-5 h-5"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20"
                fill="currentColor
            ">
                <path
                    fill-rule="evenodd"
                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                    clip-rule="evenodd"
                ></path>
            </svg>
        `;

        document.querySelector(parentSelector).appendChild(selectedSvg);
    }

    function clearSelected () {
        Array.from(filtersList.querySelectorAll("button")).map((button) => {
            button.classList.remove("js-selected");

            const hasButtonSvg = button.querySelector(".js-has-svg");
            
            if (hasButtonSvg) {
                button.removeChild(hasButtonSvg);
            }
        });
    }
});