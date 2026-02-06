/* ================= MEGA MENU DESKTOP ================= */
const trigger = document.querySelector('.has-mega');
const mega = document.querySelector('.mega-menu');

if (trigger && mega) {
  const DESKTOP_WIDTH = 992;

  function isDesktop() {
    return window.innerWidth >= DESKTOP_WIDTH;
  }

  // Mouse hover (desktop only)
  trigger.addEventListener('mouseenter', () => {
    if (isDesktop()) mega.classList.add('open');
  });

  trigger.addEventListener('mouseleave', () => {
    if (isDesktop()) mega.classList.remove('open');
  });

  // Click (mobile + fallback)
  trigger.addEventListener('click', (e) => {
    if (!isDesktop()) {
      e.preventDefault();
      mega.classList.toggle('open');
    }
  });
}

/* ================= MOBILE MENU ================= */
const burger = document.getElementById("burgerBtn");
const mobileMenu = document.getElementById("mobileMenu");

if (burger) {
  burger.addEventListener("click", () => {
    mobileMenu.classList.toggle("open");
  });
}
const closeMobileBtn = document.getElementById("closeMobileMenu");

if (closeMobileBtn) {
  closeMobileBtn.addEventListener("click", () => {
    mobileMenu.classList.remove("open");
  });
}
document.querySelectorAll('.mobile-menu a').forEach(link => {
  link.addEventListener('click', () => {
    mobileMenu.classList.remove('open');
  });
});
/* MOBILE GALAXY TOGGLE */
const galaxyToggle = document.querySelector(".toggle-galaxy");
const galaxyBlock = document.querySelector(".mobile-galaxy");

if (galaxyToggle) {
  galaxyToggle.addEventListener("click", () => {
    galaxyBlock.classList.toggle("open");
  });
}

/* ================= ORBIT ================= */

const data = [
  {
    title: "Boti School",
    sub: "Plateforme digitale pour écoles élémentaires",
    text: "BOTI School est la solution digitale tout-en-un qui transforme la gestion scolaire au Maroc et en Afrique.",
    logo: "assets/images/boti_demo.svg"
  },
  {
    title: "Boti Campus",
    sub: "Plateforme digitale pour écoles supérieures",
    text: "BOTI Campus accompagne les établissements supérieurs avec des outils avancés de gestion.",
    logo: "assets/images/boti_campus.svg"
  },
  {
    title: "Boti Kinder",
    sub: "Solution pour crèches et maternelles",
    text: "BOTI Kinder facilite la communication et le suivi éducatif des petites enfances.",
    logo: "assets/images/boti_kinder.svg"
  },
  {
    title: "Boti Classroom",
    sub: "Plateforme pour classes numériques",
    text: "BOTI Classroom propose des outils numériques pour les enseignants et élèves.",
    logo: "assets/images/boti_classroom.svg"
  }
];

/* ===== ELEMENTS ===== */
let centerIndex = 0;

const orbitItems = document.querySelectorAll(".orbit-item");
const dots  = document.querySelectorAll(".dot");

const centerLogo  = document.getElementById("center-logo");
const centerTitle = document.getElementById("center-title");
const centerSub   = document.getElementById("center-sub");
const centerText  = document.getElementById("center-text");

/* ===== UPDATE ALL CONTENT (CENTER + ORBIT ITEMS) ===== */
function updateAll(direction = null){
  const current = data[centerIndex];
  
  // If direction specified, rotate the orbit items through positions
  if(direction){
    orbitItems.forEach(item => {
      const currentPos = item.classList.contains('top') ? 'top' :
                        item.classList.contains('right') ? 'right' : 'left';
      
      let nextPos;
      if(direction === 'next'){
        // Clockwise: top -> right -> left -> top
        if(currentPos === 'top') nextPos = 'right';
        else if(currentPos === 'right') nextPos = 'left';
        else nextPos = 'top';
      } else {
        // Counter-clockwise: top -> left -> right -> top
        if(currentPos === 'top') nextPos = 'left';
        else if(currentPos === 'left') nextPos = 'right';
        else nextPos = 'top';
      }
      
      item.classList.remove('top', 'right', 'left');
      item.classList.add(nextPos);
    });
  }
  
  // Add changing class for animation
  centerLogo.classList.add('changing');
  centerTitle.classList.add('changing');
  centerSub.classList.add('changing');
  centerText.classList.add('changing');
  
  // Update center content after animation starts
  setTimeout(() => {
    centerLogo.src = current.logo;
    centerTitle.innerText = current.title;
    centerSub.innerText   = current.sub;
    centerText.innerText  = current.text;
    
    // Remove changing class to fade back in
    setTimeout(() => {
      centerLogo.classList.remove('changing');
      centerTitle.classList.remove('changing');
      centerSub.classList.remove('changing');
      centerText.classList.remove('changing');
    }, 50);
  }, 300);

  // Update orbit items content after rotation animation
  let orbitDataIndices = [];
  for(let i = 0; i < data.length; i++){
    if(i !== centerIndex) orbitDataIndices.push(i);
  }
  
  setTimeout(() => {
    orbitItems.forEach((item, idx) => {
      const dataIndex = orbitDataIndices[idx];
      const itemData = data[dataIndex];
      
      const img = item.querySelector('.orbit-img');
      const label = item.querySelector('.orbit-label');
      
      if(img && label && itemData){
        img.src = itemData.logo;
        label.innerText = itemData.title;
        
        // Store data index for click handling
        item.setAttribute('data-index', dataIndex);
      }
    });
  }, direction ? 350 : 0);

  // Update dots
  dots.forEach((dot, i) => {
    dot.classList.toggle("active", i === centerIndex);
  });
}

/* ===== CLICK ORBIT ITEM TO SELECT ===== */
orbitItems.forEach((item) => {
  item.addEventListener("click", () => {
    const dataIndex = parseInt(item.getAttribute("data-index"));
    if(!isNaN(dataIndex)){
      centerIndex = dataIndex;
      updateAll();
    }
  });
});

/* ===== DOT CLICK ===== */
dots.forEach((dot, index) => {
  dot.addEventListener("click", () => {
    centerIndex = index;
    updateAll();
  });
});

/* ===== ARROW NAVIGATION ===== */
document.getElementById("next")?.addEventListener("click", () => {
  centerIndex = (centerIndex + 1) % data.length;
  updateAll('next');
});

document.getElementById("prev")?.addEventListener("click", () => {
  centerIndex = (centerIndex - 1 + data.length) % data.length;
  updateAll('prev');
});

/* ===== INIT ===== */
updateAll();




/* ================= HERO SELECT ================= */
const toggle = document.getElementById("selectToggle");
const dropdown = document.getElementById("selectDropdown");
const selectedText = document.getElementById("selectedText");
const options = document.querySelectorAll(".option");

toggle?.addEventListener("click",()=>{
  dropdown.classList.toggle("show");
  toggle.classList.toggle("active");
});

options.forEach(opt=>{
  opt.addEventListener("click",()=>{
    selectedText.textContent = opt.textContent;
    dropdown.classList.remove("show");
    toggle.classList.remove("active");
  });
});

document.addEventListener("click",(e)=>{
  if(!e.target.closest(".hero-select-wrapper")){
    dropdown.classList.remove("show");
    toggle.classList.remove("active");
  }
});
const swiper = new Swiper('.press-swiper', {
  loop: true,
  navigation: {
    nextEl: '.next',
    prevEl: '.prev'
  },
  breakpoints: {
    0: {
      slidesPerView: 1,
      spaceBetween: 20
    },
    769: {
      slidesPerView: 1,
      spaceBetween: 40
    }
  }
});
document.querySelectorAll('.partenaires .card_partenaires')
  .forEach(card => {

    card.addEventListener('mouseenter', () => {
      card.classList.add('is-flipped');
    });

    card.addEventListener('mouseleave', () => {
      card.classList.remove('is-flipped');
    });

});
const openBtn = document.getElementById("openVideo");
  const popup = document.getElementById("videoPopup");
  const closeBtn = document.getElementById("closeVideo");

  openBtn.onclick = () => popup.classList.add("active");
  closeBtn.onclick = () => popup.classList.remove("active");

  popup.onclick = e => {
    if (e.target === popup) popup.classList.remove("active");
  };
  const tabs = document.querySelectorAll(".tab");
  const panels = document.querySelectorAll(".tab-panel");

  tabs.forEach(tab => {
    tab.addEventListener("click", () => {
      tabs.forEach(t => t.classList.remove("active"));
      panels.forEach(p => p.classList.remove("active"));

      tab.classList.add("active");
      document.getElementById(tab.dataset.tab).classList.add("active");
    });
  });

const header = document.getElementById('mainHeader');
const logoHeader = document.getElementById('logo_header');

window.addEventListener('scroll', () => {
if (window.scrollY > 50) {
    header.classList.add('scrolled');
    logoHeader.src = "assets/images/logo_boti_purple.png";
} else {
    header.classList.remove('scrolled');
    logoHeader.src = "assets/images/logo_white.svg";
}
});


// Contact Section Mobile Tabs
document.addEventListener('DOMContentLoaded', function() {
  const contactButtons = document.querySelectorAll('.mobile-contact-btn');
  const contactCards = document.querySelectorAll('.contact-card');
  
  if (contactButtons.length > 0 && contactCards.length > 0) {
    function initMobileContactTabs() {
      if (window.innerWidth <= 767) {
        contactCards.forEach((card, index) => {
          if (index === 0) {
            card.classList.add('active-mobile');
          } else {
            card.classList.remove('active-mobile');
          }
        });
      } else {
        // On desktop, show all cards
        contactCards.forEach(card => {
          card.classList.add('active-mobile');
        });
      }
    }
    
    // Handle button clicks
    contactButtons.forEach((button) => {
      button.addEventListener('click', function() {
        if (window.innerWidth <= 767) {
          contactButtons.forEach(btn => btn.classList.remove('active'));
          
          this.classList.add('active');
          
          contactCards.forEach(card => card.classList.remove('active-mobile'));
          
          const cardIndex = parseInt(this.getAttribute('data-card'));
          if (contactCards[cardIndex]) {
            contactCards[cardIndex].classList.add('active-mobile');
          }
        }
      });
    });
    
    initMobileContactTabs();
    
    window.addEventListener('resize', initMobileContactTabs);
  }
});


  