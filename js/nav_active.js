document.addEventListener("DOMContentLoaded", function () {
    const navLinks = document.querySelectorAll(".navbar-nav .nav-item.nav-link");
    const currentPath = window.location.pathname + window.location.hash;
    
    navLinks.forEach(link => {
        link.classList.remove("active"); 
        if (link.href.includes(currentPath)) {
            link.classList.add("active");
        }
    });
});
