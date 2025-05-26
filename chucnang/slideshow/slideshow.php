

<script>
    document.addEventListener("DOMContentLoaded", function() {
    let images = document.querySelectorAll("#slideshow img");
    let currentIndex = 0;

    images[currentIndex].classList.add("active");

    setInterval(function() {
        images[currentIndex].classList.remove("active");
        currentIndex = (currentIndex + 1) % images.length;
        images[currentIndex].classList.add("active");
    }, 3000); // Thời gian giữa các ảnh (ở đây là 3 giây)
});

</script>

<style>
    #slideshow {
    position: relative;
    width: 100%;
    height: auto;
    overflow: hidden;
}

#slideshow img {
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: auto;
    opacity: 0;
    transition: opacity 1s ease-in-out;
}

#slideshow img.active {
    opacity: 1;
}
</style>

<div id="slideshow">
	<img src="anh/sls01.jpg" alt="Slideshow Image 1" />
    <img src="anh/sls02.png" alt="Slideshow Image 2" />
    <img src="anh/sls03.jpg" alt="Slideshow Image 3" />
    <img src="anh/sls04.jpg" alt="Slideshow Image 4" />
    <img src="anh/sls05.jpg" alt="Slideshow Image 5" />
    <img src="anh/sls06.jpg" alt="Slideshow Image 6" />
</div>