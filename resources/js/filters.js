"use strict";

document.addEventListener("DOMContentLoaded", () => {
    const filtersBtn = document.querySelector(".js-filters-btn");
    const filtersList = document.querySelector(".js-filters-list");
    const searchInput = document.querySelector(".js-search-input");
    const resetSearch = document.querySelector(".js-reset-search");

    /**
     * A more proper solution would be to call that file
     * only in /clips view.
     */
    if (searchInput && resetSearch) {
        searchInput.addEventListener("input", ({ target }) => {
            if (target.value && target.value.length) {
                resetSearch.classList.remove("hidden");
                searchInput.classList.remove("pr-2");
                searchInput.classList.add("has-reset");
            } else {
                resetSearch.classList.add("hidden");
                searchInput.classList.add("pr-2");
                searchInput.classList.remove("has-reset");
            }
        });

        resetSearch.addEventListener("click", () => {
            searchInput.classList.remove("has-reset");
            searchInput.value = "";
            window.location.href="/clips";
        });
    }

    if (filtersBtn && filtersList) {
        if (window.localStorage.getItem("selected-filter") === null) {
            createSelectedSvg("views");
        } else {
            createSelectedSvg(window.localStorage.getItem("selected-filter"));
        }

        document.addEventListener("click", ({ target }) => {
            if (!filtersList.contains(target) && !filtersBtn.contains(target) && filtersList.classList.contains("is-open")) {
                filtersList.classList.remove("is-open");
            }
        });

        filtersBtn.addEventListener("click", () => {
            filtersList.classList.toggle("is-open");
        });

        filtersList.addEventListener("click", ({ target }) => {
            const clickedFilterBtn = target.closest("button");


            if (clickedFilterBtn === null) {
                return;
            }
            
            if (clickedFilterBtn.classList.contains("js-selected")) {
                return;
            } else {
                clickedFilterBtn.classList.add("js-selected");

                window.localStorage.setItem("selected-filter", clickedFilterBtn.dataset.filter);
                window.location.reload();
            }
        });

        function createSelectedSvg (filter) {
            const buttonSelector = document.querySelector(`[data-filter=${filter}]`);
            buttonSelector.classList.add("js-selected");

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

            buttonSelector.appendChild(selectedSvg);
        }
    }
});