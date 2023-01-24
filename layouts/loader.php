<style>
    * {
    margin: 0;
    padding: 0;
}
.loader {
    position: fixed;
    top: 0;
    left: 0;
    background: #fff;
    height: 100%;
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
}
.disppear {
    animation: vanish 0.6s forwards;
}
@keyframes vanish {
    100% {
        opacity: 0;
        visibility: hidden;
    }
}
</style>

<div class="loader">
    <div class="spinner-border text-payreto-darkblue-900" style="width: 5rem; height: 5rem;" role="status" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>

<script>
    var loader = document.querySelector(".loader")
    window.addEventListener("load", vanish);
    function vanish() {
        loader.classList.add("disppear");
    }
</script>