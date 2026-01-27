$(document).ready(function(){
    // Initialize each carousel individually to handle multiple instances
    $('.related-articles-carousel').each(function(){
        $(this).owlCarousel({
            loop: true,
            margin: 20,
            nav: false,
            dots: false,
            autoplay: false,
            autoplayTimeout: 5000,
            autoplayHoverPause: true,
            navText: ['<span>‹</span>', '<span>›</span>'],
            responsive: {
                0: {
                    items: 1,
                    nav: false
                },
                768: {
                    items: 2,
                    nav: false
                },
                992: {
                    items: 3,
                    nav: false
                }
            }
        });
    });
});



  /* ================= ACTIVE NAV LINK ================= */
  document.addEventListener('DOMContentLoaded', () => {
    const currentPage = window.location.pathname.split('/').pop() || 'index.php';
    
    // Skip on index page
    if (currentPage === 'index.php' || currentPage === '') return;

    const logoHeader = document.querySelector('.logo-header');
    const openStepperBtn = document.getElementById('openStepperBtn');
    const navLinks = document.querySelectorAll('.nav-link, .mobile-link');
    const mainHeader = document.getElementById('mainHeader');
    const burger = document.getElementById('burgerBtn'); 


    document.querySelectorAll('.nav-link').forEach(el => el.classList.add('color-change'));
    
    if (openStepperBtn) {
      openStepperBtn.style.color = '#231759';
      openStepperBtn.style.borderColor = '#231759';
    }
    
    if (mainHeader) {
      mainHeader.style.position = 'relative';
    }
    
    if (logoHeader) {
      logoHeader.src = "assets/images/logo_boti_purple.png";
    }

    if(burger){
        burger.style.filter = "invert(48%) sepia(74%) saturate(7493%) hue-rotate(246deg) brightness(58%) contrast(101%)";
    }

    // Find and activate matching link
    navLinks.forEach(link => {
      const href = link.getAttribute('href');
      if (!href) return;

      const linkFile = href.split('/').pop();
      
      if (linkFile === currentPage) {
        link.classList.add('active');
      }
    });
  });




document.addEventListener('DOMContentLoaded', function() {
    const filterButtons = document.querySelectorAll('.filter-btn');
    const blogCards = document.querySelectorAll('.blog-card');

    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            const filterValue = this.getAttribute('data-filter');

            filterButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');

            blogCards.forEach(card => {
                const category = card.getAttribute('data-category');
                
                if (filterValue === 'all') {
                    card.classList.remove('hidden');
                } else if (category === filterValue) {
                    card.classList.remove('hidden');
                } else {
                    card.classList.add('hidden');
                }
            });
        });
    });
});