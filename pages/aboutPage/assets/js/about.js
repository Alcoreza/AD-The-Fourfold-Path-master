document.addEventListener("DOMContentLoaded", () => {
    const observers = document.querySelectorAll(".slide-in");

    const reveal = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add("show");
            }
        });
    }, {
        threshold: 0.3
    });

    observers.forEach(section => {
        reveal.observe(section);
    });
});