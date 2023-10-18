<script setup></script>
<template>
    <main>

    </main>
</template>
<script>
export default {
    name:'Rate',
    mounted() {
        const makeStarRating = function (noOfStars = 5) {
        let rating = 0;
        let starComponent;
        function changeRating(newRating) {
            rating = newRating;
        }
        function getStarComponent() {
            if (!starComponent) {
            starComponent = document.createElement("ul");
            starComponent.className = "stcomp";
            for (let i = 0; i < noOfStars; i++) {
                const li = document.createElement("li");
                li.setAttribute("data-rating", i + 1);
                li.className = "star";
                if (i === 0) li.tabIndex = 0;
                starComponent.append(li);
            }
            starComponent.addEventListener("mouseover", onMouseOver);
            starComponent.addEventListener("mouseleave", onMouseLeave);
            starComponent.addEventListener("click", onMouseClick);
            starComponent.addEventListener("keyup", onKeyUp);
            }
            return starComponent;
        }
        function renderChanges(rating) {
            for (let index = 0; index < rating; index++) {
            starComponent.children[index].classList.add("star-filled");
            }
            for (let index = rating; index < noOfStars; index++) {
            starComponent.children[index].classList.remove("star-filled");
            }
        }
        function onMouseOver(e) {
            let isStar = e.target.classList.contains("star");
            if (isStar) {
            const { rating } = e.target.dataset;
            renderChanges(rating);
            }
        }
        function onMouseLeave(e) {
            renderChanges(rating);
        }
        function onMouseClick(e) {
            let star = e.target ?? e;
            let isStar = star.classList.contains("star");
            if (isStar) {
            activate(star);
            let { rating } = star.dataset;
            if(e.key!=='Tab' && rating === getRating()){
                rating = 0;
                resetTabIndex();
                starComponent.firstElementChild.tabIndex = 0;
            }
            changeRating(rating);
            renderChanges(rating);
            }
        }
        function focusPrevStar() {
            let focusedStar = document.activeElement;
            if (focusedStar.previousElementSibling) {
            onMouseClick(focusedStar.previousElementSibling);
            }
        }
        function focusNextStar() {
            let focusedStar = document.activeElement;
            if (focusedStar.nextElementSibling) {
            onMouseClick(focusedStar.nextElementSibling);
            }
        }
        function activate(element) {
            resetTabIndex();
            element.tabIndex = 0;
            element.focus();
        }
        function resetTabIndex() {
            starComponent.childNodes.forEach((star) => {
            star.tabIndex = -1;
            });
        }
        function onKeyUp(e) {
            switch (e.key) {
            case "Tab": {
                onMouseClick(e);
                break;
            }
            case "ArrowLeft": {
                focusPrevStar();
                break;
            }
            case "ArrowRight": {
                focusNextStar();
                break;
            }
            default:
                return;
            }
        }
        function getRating() {
            return rating;
        }
        return { getRating, getStarComponent };
        };
        const ratingModule1 = makeStarRating(10);
        const ratingModule2 = makeStarRating();
        const starComponent1 = ratingModule1.getStarComponent();
        const starComponent2 = ratingModule2.getStarComponent();
        const container = document.querySelector("main");
        container.append(starComponent1, starComponent2);
    },
}

</script>
