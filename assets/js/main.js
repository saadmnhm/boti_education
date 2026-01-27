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

const items = document.querySelectorAll(".orbit-item");
const dots  = document.querySelectorAll(".dot");

const centerLogo  = document.getElementById("center-logo");
const centerTitle = document.getElementById("center-title");
const centerSub   = document.getElementById("center-sub");
const centerText  = document.getElementById("center-text");

/* ===== UPDATE CENTER CONTENT ===== */
function updateCenter(){
  const current = data[centerIndex];
  
  centerLogo.src = current.logo;
  centerTitle.innerText = current.title;
  centerSub.innerText   = current.sub;
  centerText.innerText  = current.text;

  dots.forEach((dot, i) => {
    dot.classList.toggle("active", i === centerIndex);
  });
}

/* ===== ROTATE ORBIT ===== */
function rotate(direction){
  items.forEach(item => {
    if(item.classList.contains("top")){
      item.classList.replace("top", direction === "next" ? "right" : "left");
    } else if(item.classList.contains("right")){
      item.classList.replace("right", direction === "next" ? "bottom" : "top");
    } else if(item.classList.contains("bottom")){
      item.classList.replace("bottom", direction === "next" ? "left" : "right");
    } else if(item.classList.contains("left")){
      item.classList.replace("left", direction === "next" ? "top" : "bottom");
    }
  });

  // update index
  if(direction === "next"){
    centerIndex = (centerIndex + 1) % data.length;
  } else {
    centerIndex = (centerIndex - 1 + data.length) % data.length;
  }

  setTimeout(updateCenter, 400); // attendre animation
}

/* ===== EVENTS ===== */
document.getElementById("next")?.addEventListener("click", () => rotate("next"));
document.getElementById("prev")?.addEventListener("click", () => rotate("prev"));

/* ===== INIT ===== */
updateCenter();




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




  