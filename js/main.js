const scrollRevealOption = {
  distance: "50px",
  origin: "bottom",
  duration: 1000,
};

/*=============== SHOW MENU ===============*/
const navMenu = document.getElementById("nav-menu"),
  navToggle = document.getElementById("nav-toggle"),
  navClose = document.getElementById("nav-close")

// ========MENU SHOW=========
/*validate if constant exists*/
if (navToggle) {
  navToggle.addEventListener("click", () => {
    navMenu.classList.add("show-menu")
  })
}

// ========MENU HIDDEN=========
/*validates if constant exists */
if (navClose) {
  navClose.addEventListener("click", () => {
    navMenu.classList.remove("show-menu")
  })
}

/*=============== REMOVE MENU MOBILE ===============*/
const navLink = document.querySelectorAll(".nav__link");

const linkAction = () => {
  const navMenu = document.getElementById("nav-menu");
  //when we click on each nav__link, we remove the show-menu class
  navMenu.classList.remove("show-menu");
}


// Show the modal
function openModal() {
  const modal = document.getElementById('loginModal');
  modal.style.display = 'block';

  const content = modal.querySelector('.modal-content');
  content.classList.remove('fade');
  void content.offsetWidth; // Restart animation
  content.classList.add('fade');
}

// Hide the modal
function closeModal() {
  document.getElementById('loginModal').style.display = 'none';
}

navLink.forEach(n => n.addEventListener("click", linkAction));


/*=============== ADD BLUR TO HEADER ===============*/
const blurHeader = () => {
  const header = document.getElementById("header");
  //when the scroll is greater than 50 viewport height, add the scroll-header class to the header tag 
  this.scrollY >= 50 ? header.classList.add("blur-header")
    : header.classList.remove("blur-header");
}
window.addEventListener("scroll", blurHeader)

/*=============== DARK LIGHT THEME ===============*/
const themeButton = document.getElementById("theme-button");
const darkTheme = "dark-theme";
const iconTheme = "ri-sun-line";

//previously selected topic(if user selected)
const selectedtheme = localStorage.getItem("selected-theme");
const selectedIcon = localStorage.getItem("selected-icon");

//we obtain the current theme that interface has by validating tha dark-theme class
const getCurrentTheme = () => {
  document.body.classList.contains(darkTheme) ? "dark" : "light";
};
const getCurrentIcon = () => {
  themeButton.classList.contains(iconTheme) ? "ri-moon-line" : "ri-sun-line";
};

//we validate if the user previously choose a topic
if (selectedtheme) {
  //If the validation is fulfilled, we ask what the issue was to know if we activated or deactivated
  document.body.classList[selectedtheme === "dark" ? "add" : "remove"](darkTheme);
  themeButton.classList[selectedIcon === "ri-moon-line" ? "add" : "remove"](iconTheme);
}

//activate / deactivate the theme manually with the moon
themeButton.addEventListener("click", () => {
  //add or remove the dark / icon theme
  document.body.classList.toggle(darkTheme);
  themeButton.classList.toggle(iconTheme);
  //we save the theme and the current icon that the user choose
  localStorage.setItem("selected-theme", getCurrentTheme());
  localStorage.setItem("selected-icon", getCurrentIcon());
});

/*=============== SCROLL REVEAL ANIMATION ===============*/
const initSlider = () => {
  const imageList = document.querySelector(".posts__grid .card-container");
  const scrollbar = document.querySelector(".slider-scrollbar");
  const scrollbarThumb = scrollbar.querySelector(".scrollbar-thumb");
  const slideButtons = document.querySelectorAll(".slider-btn");

  const maxScrollLeft = imageList.scrollWidth - imageList.clientWidth;
  const maxThumbLeft = scrollbar.offsetWidth - scrollbarThumb.offsetWidth;

  //thumb position based on scroll
  const updateThumbPosition = () => {
    const scrollPercentage = imageList.scrollLeft / maxScrollLeft;
    const thumbPosition = scrollPercentage * maxThumbLeft;
    scrollbarThumb.style.left = `${thumbPosition}px`;
  };

  //Scroll content when dragging the thumb
  scrollbarThumb.addEventListener("mousedown", (e) => {
    const startX = e.clientX;
    const thumbStartLeft = scrollbarThumb.offsetLeft;

    const handleMouseMove = (e) => {
      const deltaX = e.clientX - startX;
      let newLeft = thumbStartLeft + deltaX;

      // Clamp the thumb within scrollbar
      newLeft = Math.max(0, Math.min(newLeft, maxThumbLeft));
      scrollbarThumb.style.left = `${newLeft}px`;

      // Scroll content proportionally
      const scrollPercentage = newLeft / maxThumbLeft;
      imageList.scrollLeft = scrollPercentage * maxScrollLeft;
    };

    const handleMouseUp = () => {
      document.removeEventListener("mousemove", handleMouseMove);
      document.removeEventListener("mouseup", handleMouseUp);
    };

    document.addEventListener("mousemove", handleMouseMove);
    document.addEventListener("mouseup", handleMouseUp);
  });

  //  Scroll thumb when user scrolls content
  imageList.addEventListener("scroll", updateThumbPosition);

  // Next/Prev button scroll logic
  slideButtons.forEach(button => {
    button.addEventListener("click", () => {
      const direction = button.id === "prev-slide" ? -1 : 1;
      const scrollAmount = imageList.clientWidth * 0.6; // 60% of visible width
      imageList.scrollBy({
        left: direction * scrollAmount,
        behavior: "smooth"
      });
    });
  });

  // Initial setup
  updateThumbPosition();
};

window.addEventListener("load", initSlider);

// =======================for log in page ============================

// Function to open login/signup modal
function openModal() {
  fetch("login_modal.php")
    .then(response => response.text())
    .then(data => {
      document.getElementById("modalContainer").innerHTML = data;
      document.getElementById("authModal").classList.remove("hidden");
      setupModalEvents(); // Attach event listeners inside modal after loading
    });
}

// Function to close modal
function closeModal() {
  const modal = document.getElementById("authModal");
  if (modal) modal.classList.add("hidden");
}

// Attach form toggle logic and additional handlers after modal content is loaded
function setupModalEvents() {
  const loginToggle = document.getElementById("loginToggle");
  const signupToggle = document.getElementById("signupToggle");
  const loginForm = document.getElementById("loginForm");
  const signupForm = document.getElementById("signupForm");
  const roleSelect = document.getElementById("roleSelect");
  const trainerFields = document.getElementById("trainerFields");

  if (loginToggle && signupToggle && loginForm && signupForm) {
    loginToggle.addEventListener("click", () => {
      loginForm.classList.remove("hidden");
      signupForm.classList.add("hidden");
      loginToggle.classList.add("active");
      signupToggle.classList.remove("active");
    });

    signupToggle.addEventListener("click", () => {
      loginForm.classList.add("hidden");
      signupForm.classList.remove("hidden");
      loginToggle.classList.remove("active");
      signupToggle.classList.add("active");
    });
  }

  // Show trainer-specific fields on role selection
  if (roleSelect) {
    roleSelect.addEventListener("change", () => {
      if (roleSelect.value === "Trainer") {
        trainerFields.classList.remove("hidden");
      } else {
        trainerFields.classList.add("hidden");
      }
    });
  }
}


function setupModalEvents() {
  const loginToggle = document.getElementById("loginToggle");
  const signupToggle = document.getElementById("signupToggle");
  const loginForm = document.getElementById("loginForm");
  const signupForm = document.getElementById("signupForm");

  loginToggle.addEventListener("click", () => {
    loginToggle.classList.add("active");
    signupToggle.classList.remove("active");
    loginForm.classList.remove("hidden");
    signupForm.classList.add("hidden");
  });

  signupToggle.addEventListener("click", () => {
    signupToggle.classList.add("active");
    loginToggle.classList.remove("active");
    signupForm.classList.remove("hidden");
    loginForm.classList.add("hidden");
  });
  // Trainer-specific field logic
  const roleSelect = document.getElementById("roleSelect");
  const trainerFields = document.getElementById("trainerFields");

  if (roleSelect) {
    roleSelect.addEventListener("change", () => {
      if (roleSelect.value.toLowerCase() === "trainer") {
        trainerFields.classList.remove("hidden");
      } else {
        trainerFields.classList.add("hidden");
      }
    });
  }
  // Close modal
  document.querySelector(".close-btn").addEventListener("click", () => {
    document.getElementById("authModal").classList.add("hidden");
  });
}


// header container
ScrollReveal().reveal(".header__container h1", {
  ...scrollRevealOption,
  delay: 500,
});


ScrollReveal().reveal(".header__container h2", {
  ...scrollRevealOption,
  delay: 1000,
});

ScrollReveal().reveal(".header__container .btn", {
  ...scrollRevealOption,
  delay: 1500,
});
ScrollReveal().reveal(".header__container img", {
  ...scrollRevealOption,
  origin: "right",
});

// why container
ScrollReveal().reveal(".why__container .section__header", {
  ...scrollRevealOption,
  delay: 500,
});

ScrollReveal().reveal(".why__container p", {
  ...scrollRevealOption,
  delay: 1000,
});

ScrollReveal().reveal(".why__container li", {
  ...scrollRevealOption,
  delay: 1500,
  interval: 500,
});

ScrollReveal().reveal(".why__container img", {
  ...scrollRevealOption,
  origin: "left",
});

// hero container
ScrollReveal().reveal(".hero__card", {
  ...scrollRevealOption,
  interval: 500,
});

// classes container
ScrollReveal().reveal(".classes__image", {
  duration: 1000,
  interval: 500,
});

// membership container
ScrollReveal().reveal(".membership__card", {
  ...scrollRevealOption,
  interval: 500,
});

// info container
ScrollReveal().reveal(".info__container .info__grid", {
  ...scrollRevealOption,
  interval: 500,
});

// posts container
ScrollReveal().reveal(".card-container", {
  ...scrollRevealOption,
  interval: 500,
});

// photos container
ScrollReveal().reveal(".photos__card", {
  duration: 1000,
  interval: 500,
});
