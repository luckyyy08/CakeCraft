let currentSlide = 0;
    const slides = document.querySelectorAll('.slide');
    const dots = document.querySelectorAll('.dot');
    let slideInterval;

    function showSlide(index) {
        slides.forEach(slide => {
            slide.classList.remove('active');
            slide.classList.remove('prev');
        });
        
        // Mark former current slide as 'prev'
        slides[currentSlide].classList.add('prev');
        
        dots.forEach(dot => dot.classList.remove('active'));
        
        slides[index].classList.add('active');
        dots[index].classList.add('active');
        currentSlide = index;
    }

    function changeSlide(direction) {
        let newSlide = currentSlide + direction;
        if(newSlide >= slides.length) newSlide = 0;
        if(newSlide < 0) newSlide = slides.length - 1;
        
        showSlide(newSlide);
        resetInterval();
    }

    function goToSlide(index) {
        showSlide(index);
        resetInterval();
    }

    function startInterval() {
        slideInterval = setInterval(() => { changeSlide(1); }, 5000); // Change slide every 5 seconds
    }

    function resetInterval() {
        clearInterval(slideInterval);
        startInterval();
    }

    // Start auto slide on load
    startInterval();