<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!--=============== REMIXICONS ===============-->
  <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet" />

  <!-- ===============FOR ICONS=============== -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!--=============== FAVICON ===============-->
  <link rel="shortcut icon" href="images/flowerIcon.ico" type="image/x-icon" />
  <!-- ==============Link for google icons=================================  -->
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded" rel="stylesheet" />

  <link rel="stylesheet" href="css/style.css">
  <script src="https://unpkg.com/scrollreveal"></script>
  <title>Web Design Mastery | Yoga</title>
</head>

<body>
  <div id="modalContainer"></div>
  <header class="header" id="header">
    <nav class="nav container">
      <div class="nav__logo">
        <img src="images/logo.png" alt="logo" />
        <span>SwasthaYoga</span>
      </div>
      <div class="nav__menu" id="nav-menu">
        <ul class="nav__links">
          <li class="link"><a href="#home" class="nav__link active-link">Home</a></li>
          <li class="link"><a href="#info" class="nav__link">About</a></li>
          <li class="link"><a href="#posts" class="nav__link">Classes</a></li>
          <li class="link"><a href="#contact" class="nav__link">Contact</a></li>

          <?php if (!isset($_SESSION['email'])): ?>
            <!-- Not logged in -->
            <li class="link"><a href="login.php" id="authLink">Login / Sign Up</a></li>
          <?php else: ?>
            <!-- Logged in -->
            <li class="link"><a
                href="<?php echo $_SESSION['role'] === 'Trainer' ? 'trainer_dashboard.php' : 'user_dashboard.php'; ?>"
                id="profileLink">Profile</a></li>
            <li class="link"><a href="#" onclick="showLogoutModal()">Logout</a></li>
          <?php endif; ?>
        </ul>

        <!-- close button -->
        <div class="nav__close" id="nav-close">
          <i class="fa-solid fa-circle-xmark"></i>
        </div>
      </div>

      <div class="nav__buttons">
        <!-- Theme change button -->
        <i class="ri-moon-line change-theme" id="theme-button"></i>

        <!-- toggle button  -->
        <div class="nav__toggle" id="nav-toggle">
          <i class="ri-apps-fill"></i>
        </div>
      </div>
    </nav>
    <!-- <?php if (isset($_SESSION['name'])): ?>
      <script>
        alert("Welcome, <?php echo $_SESSION['name']; ?>!");
      </script>
    <?php endif; ?> -->

  </header>

  <section class="section__container main__container" id="home">
    <div class="section__container header__container">
      <div class="header__content">
        <h1>Effective YOGA</h1>
        <h2>Do yoga today for better tomorrow</h2>
        <a href="https://www.youtube.com/channel/UC84HQ5b3ndD88gXybaW5U0g" target="_blank"><button class="btn">Get
            Started Free<i class="fa-solid fa-arrow-right"></i></button></a>
      </div>
      <div class="header__image">
        <img src="images/home-yoga.png" alt="header" />
      </div>
    </div>
  </section>

  <section class="section__container why__container">
    <div class="why__image">
      <img src="images/list-yoga.png" alt="why yoga" />
    </div>
    <div class="why__content">
      <h2 class="section__header">Why You Should Go To Yoga</h2>
      <p>
        Engaging in yoga offers a holistic approach to wellness, encompassing
        both physical and mental benefits. Through a series of poses,
        stretches, and muscle strength. Its meditative aspects encourage
        mindfulness, reducing stress and anxiety while promoting a sense of
        inner peace.
      </p>
      <ul>
        <li>
          <span><i class="ri-checkbox-circle-fill"></i></span>
          Yoga boosts brain power
        </li>
        <li>
          <span><i class="ri-checkbox-circle-fill"></i></span>
          Yoga helps you to breathe better
        </li>
        <li>
          <span><i class="ri-checkbox-circle-fill"></i></span>
          Yoga improves your strength
        </li>
        <li>
          <span><i class="ri-checkbox-circle-fill"></i></span>
          Yoga helps you to focus
        </li>
        <li>
          <span><i class="ri-checkbox-circle-fill"></i></span>
          Yoga helps give meaning to your day
        </li>
      </ul>
    </div>
  </section>

  <section class="hero" id="hero">
    <div class="section__container hero__container">
      <div class="hero__card">
        <span><img src="images/icon-1.png" alt="hero" /></span>
        <h4>Healthy Lifestyle</h4>
        <p>
          Embrace a healthy lifestyle through the transformative power of yoga
          and cultivate physical vitality and inner peace.
        </p>
      </div>
      <div class="hero__card">
        <span><img src="images/icon-2.png" alt="hero" /></span>
        <h4>Body & Mind Balance</h4>
        <p>
          Through purposeful poses and mindful breathing, yoga cultivates a
          strong, flexible body while nurturing inner calm.
        </p>
      </div>
      <div class="hero__card">
        <span><img src="images/icon-3.png" alt="hero" /></span>
        <h4>Meditation Practice</h4>
        <p>
          Discover inner serenity and mindfulness as you cultivate a profound
          connection with the present moment.
        </p>
      </div>
      <div class="hero__card">
        <span><img src="images/icon-4.png" alt="hero" /></span>
        <h4>Self-Care</h4>
        <p>
          Discover the transformative power of self-care through yoga and
          embrace moments of tranquility and mindfulness.
        </p>
      </div>
    </div>
  </section>

  <section class="section__container classes__container">
    <p class="section__subheader">Breathe In Peace, Breathe Out Stress </p>
    <h2 class="section__header">with SwasthaYoga</h2>
    <div class="classes__grid">
      <div class="classes__image">
        <img src="images/classes-1.jpg" alt="classes" />
        <div class="classes__content">
        </div>
      </div>
      <div class="classes__image">
        <img src="images/classes-2.jpg" alt="classes" />
        <div class="classes__content">
        </div>
      </div>
      <div class="classes__image">
        <img src="images/classes-3.jpg" alt="classes" />
        <div class="classes__content">
        </div>
      </div>
      <div class="classes__image">
        <img src="images/classes-4.jpg" alt="classes" />
        <div class="classes__content">
        </div>
      </div>
      <div class="classes__image">
        <img src="images/classes-5.jpg" alt="classes" />
        <div class="classes__content">
        </div>
      </div>
      <div class="classes__image">
        <img src="images/classes-6.jpg" alt="classes" />
        <div class="classes__content">
        </div>
      </div>
    </div>
  </section>

  <section class="section__container info__container" id="info">
    <p class="section__subheader">INFORMATION</p>
    <h2 class="section__header">Benefits Of Yoga</h2>
    <div class="info__grid">
      <div class="info__card">
        <div class="info__content">
          <span>#1</span>
          <p>
            Yoga stretches your muscles and increases your range of motion, reducing stiffness and improving
            flexibility.
            Regular practice can lead to improved posture, balance, and overall body awareness.
          </p>
        </div>
        <div class="info-info">
          <div class="info-info__details">
            <h4>Improves Flexibility</h4>
          </div>
        </div>
      </div>
      <div class="info__card">
        <div class="info__content">
          <span>#2</span>
          <p>
            Calm your mind with breathing and meditation techniques integrated into yoga. This practice helps reduce
            stress, anxiety, and depression, promoting emotional well-being and mental clarity.
          </p>
        </div>
        <div class="info-info">
          <div class="info-info__details">
            <h4>Reduces Stress</h4>
          </div>
        </div>
      </div>
      <div class="info__card">
        <div class="info__content">
          <span>#3</span>
          <p>
            Holding yoga poses improves muscle strength across your whole body. This strength-building aspect of yoga
            enhances endurance, stability, and overall physical performance.
          </p>
        </div>
        <div class="info-info">
          <div class="info-info__details">
            <h4>Builds Strength</h4>
          </div>
        </div>
      </div>
      <div class="info__card">
        <div class="info__content">
          <span>#4</span>
          <p>
            Yoga strengthens the back and core, helping you maintain better posture daily. Improved posture can lead to
            less
            back pain and discomfort, enhancing your overall physical well-being.
          </p>
        </div>
        <div class="info-info">
          <div class="info-info__details">
            <h4>Corrects Posture</h4>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="banner">
    <div class="section__container banner__container">
      <div class="banner__card">
        <h4>Online Yoga Classes</h4>
        <p>Join live sessions from anywhere, anytime with expert trainers.</p>
      </div>
      <div class="banner__card">
        <h4>Personalized Programs</h4>
        <p>Customized plans based on your body goals and flexibility level.</p>
      </div>
      <div class="banner__card">
        <h4>Free Video Library</h4>
        <p>Explore beginner to advanced yoga tutorials anytime for free.</p>
      </div>
      <div class="banner__card">
        <h4>Trainer Guidance</h4>
        <p>Get personal feedback and progress tracking from certified trainers.</p>
      </div>
    </div>
  </section>


  <section class="posts" id="posts">
    <div class="section__container posts__container">
      <p class="section__subheader">CLASSES</p>
      <h2 class="section__header">Choose Your Level & Focus</h2>
      <div class="posts__grid">
        <div class="card-container">
          <div class="yoga-card">
            <img class="images" src="images/AshtangaYoga.jpg" alt="post" />
            <div class="posts__content">
              <div class="posts__date">
                <div>
                  <p>Ashtanga Yoga</p>
                </div>
              </div>
              <h4>Structured, Intense</h4>
              <p>
                A structured and intense yoga with fixed sequences. Good for building strength, flexibility, and
                discipline.
              </p>
              <button class="learn-now-btn learn" data-yoga-type="AshtangaYoga" onclick="openEnrollModal(this)">Learn
                Now
                <i class="fa-solid fa-arrow-right"></i></button>
            </div>
          </div>
          <div class="yoga-card">
            <img class="images" src="images/HathaYoga.jpg" alt="post" />
            <div class="posts__content">
              <div class="posts__date">
                <div>
                  <p>Hatha Yoga</p>
                </div>
              </div>
              <h4>Gentle, Beginner-friendly</h4>
              <p>
                A gentle, beginner-friendly yoga focused on physical postures and breathing techniques. Great for stress
                relief and flexibility.
              </p>
              <button class="learn-now-btn learn" data-yoga-type="HathaYoga" onclick="openEnrollModal(this)">Learn Now
                <i class="fa-solid fa-arrow-right"></i></button>
            </div>
          </div>
          <div class="yoga-card">
            <img class="images" src="images/PowerYoga.jpg" alt="post" />
            <div class="posts__content">
              <div class="posts__date">
                <div>
                  <p>Power Yoga</p>
                </div>
              </div>
              <h4>High-intensity, Strength</h4>
              <p>
                A fast-paced and high-intensity variation of Vinyasa. Targets strength, endurance, and weight loss.
              </p>
              <button class="learn-now-btn learn" data-yoga-type="PowerYoga" onclick="openEnrollModal(this)">Learn Now
                <i class="fa-solid fa-arrow-right"></i></button>
            </div>
          </div>
          <div class="yoga-card">
            <img class="images" src="images/chairYoga.jpg" alt="post" />
            <div class="posts__content">
              <div class="posts__date">
                <div>
                  <p>Chair Yoga</p>
                </div>
              </div>
              <h4>Gentle, Supportive</h4>
              <p>
                A gentle and supportive yoga practice using a chair for stability. Ideal for seniors or those with
                mobility issues.
              </p>
              <button class="learn-now-btn learn" data-yoga-type="ChairYoga" onclick="openEnrollModal(this)">Learn Now
                <i class="fa-solid fa-arrow-right"></i></button>
            </div>
          </div>
          <div class="yoga-card">
            <img class="images" src="images/pranayama.jpg" alt="post" />
            <div class="posts__content">
              <div class="posts__date">
                <div>
                  <p>Pranayama</p>
                </div>
              </div>
              <h4> Breathing, Control</h4>
              <p>
                A practice focused on breath control and techniques. Enhances lung capacity, relaxation, and
                mindfulness.
              </p>
              <button class="learn-now-btn learn" data-yoga-type="Pranayama" onclick="openEnrollModal(this)">Learn Now
                <i class="fa-solid fa-arrow-right"></i></button>
            </div>
          </div>
          <div class="yoga-card">
            <img class="images" src="images/VinyasaYoga.jpg" alt="post" />
            <div class="posts__content">
              <div class="posts__date">
                <div>
                  <p>Vinyasa Yoga</p>
                </div>
              </div>
              <h4>Dynamic, Fluid</h4>
              <p>
                A dynamic and fluid yoga style linking breath with movement. Offers a variety of poses and sequences for
                strength and flexibility.
              </p>
              <button class="learn-now-btn learn" data-yoga-type="VinyasaYoga" onclick="openEnrollModal(this)">Learn
                Now
                <i class="fa-solid fa-arrow-right"></i></button>
            </div>
          </div>
          <div class="yoga-card">
            <img class="images" src="images/YinYoga.jpg" alt="post" />
            <div class="posts__content">
              <div class="posts__date">
                <div>
                  <p>Yin Yoga</p>
                </div>
              </div>
              <h4>Slow-paced, Deep Stretch</h4>
              <p>
                A slow-paced yoga focusing on deep stretching and relaxation. Targets connective tissues and promotes
                flexibility.
              </p>
              <button class="learn-now-btn learn" data-yoga-type="YinYoga" onclick="openEnrollModal(this)">Learn Now
                <i class="fa-solid fa-arrow-right"></i></button>
            </div>
          </div>
          <div class="yoga-card">
            <img class="images" src="images/restorativeYoga.jpg" alt="post" />
            <div class="posts__content">
              <div class="posts__date">
                <div>
                  <p>Restorative Yoga</p>
                </div>
              </div>
              <h4>Relaxation, Recovery</h4>
              <p>
                A gentle and restorative yoga practice using props for support. Focuses on relaxation, recovery, and
                stress relief.
              </p>
              <button class="learn-now-btn learn" data-yoga-type="RestorativeYoga" onclick="openEnrollModal(this)">Learn
                Now
                <i class="fa-solid fa-arrow-right"></i></button>
            </div>
          </div>
          <div class="yoga-card">
            <img class="images" src="images/kundaliniYoga.jpeg" alt="post" />
            <div class="posts__content">
              <div class="posts__date">
                <div>
                  <p>Kundalini Yoga</p>
                </div>
              </div>
              <h4>Spiritual, Awakening</h4>
              <p>
                A spiritual and awakening yoga practice combining postures, breathwork, and meditation. Aims to awaken
                the Kundalini energy at the base of the spine.
              </p>
              <button class="learn-now-btn learn" data-yoga-type="KundaliniYoga" onclick="openEnrollModal(this)">Learn
                Now
                <i class="fa-solid fa-arrow-right"></i></button>
            </div>
          </div>
          <div class="yoga-card">
            <img class="images" src="images/iyengeryoga.jpg" alt="post" />
            <div class="posts__content">
              <div class="posts__date">
                <div>
                  <p>Iyengar Yoga</p>
                </div>
              </div>
              <h4>Precision, Alignment</h4>
              <p>
                A precision-focused yoga emphasizing alignment and posture. Uses props for support and accessibility.
              </p>
              <button class="learn-now-btn learn" data-yoga-type="IyengarYoga" onclick="openEnrollModal(this)">Learn
                Now
                <i class="fa-solid fa-arrow-right"></i></button>
            </div>
          </div>
          <div class="yoga-card">
            <img class="images" src="images/bikramYoga.jpg" alt="post" />
            <div class="posts__content">
              <div class="posts__date">
                <div>
                  <p>Bikram Yoga</p>
                </div>
              </div>
              <h4>Hot Room, Detox</h4>
              <p>
                A sequence of 26 poses done in a hot room. Helps in detoxification and deep stretching — but not
                suitable for everyone.
              </p>
              <button class="learn-now-btn learn" data-yoga-type="BikramYoga" onclick="openEnrollModal(this)">Learn Now
                <i class="fa-solid fa-arrow-right"></i></button>
            </div>
          </div>
          <div class="yoga-card">
            <img class="images" src="images/prenatalYoga.jpg" alt="post" />
            <div class="posts__content">
              <div class="posts__date">
                <div>
                  <p>Prenatal Yoga</p>
                </div>
              </div>
              <h4>Pregnancy, Flexibility</h4>
              <p>
                A gentle and supportive yoga, Specifically designed for pregnant women to improve flexibility,
                breathing, and reduce stress.
              </p>
              <button class="learn-now-btn learn" data-yoga-type="PrenatalYoga" onclick="openEnrollModal(this)">Learn
                Now
                <i class="fa-solid fa-arrow-right"></i></button>
            </div>
          </div>
        </div>
        <div class="slider-scrollbar">
          <div class="scrollbar-track">
            <div class="scrollbar-thumb"></div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Enrollment Modal -->
  <div id="enrollModal" class="modal hidden">
    <div class="modal-overlay" onclick="closeEnrollModal()"></div>
    <div class="enroll-modal-box">
      <button class="close-btn" onclick="closeEnrollModal()">×</button>
      <h2>Enroll in Yoga Course</h2>

      <form id="enrollForm" method="POST" action="enroll.php">
        <!-- <label for="yogaType">Select Yoga Type:</label> -->
        <input type="text" name="yogaType" id="yogaType" readonly required>

        <!-- <label for="trainerSelect">Choose Trainer:</label> -->
        <select name="trainer" id="trainerSelect" required>
          <option value="">Select Trainer</option>
          <button type="button" id="learnMoreBtn" class="enroll_submit" style="display:none;">Learn More About
            Trainer</button>
        </select>
        <div id="trainerDetails" class="hidden">
          <p class="trainer_name_enroll tr">Trainer Name: <span id="trainerName"></span></p>
          <p class="trainer_email_enroll tr">Email: <span id="trainerEmail"></span></p>
          <p class="about_enroll tr">About: <span id="trainerAbout"></span></p>
          <p class="experi_enroll tr">Experience: <span id="trainerExperience"></span> years</p>
          <!-- <p class="whatsapp_enroll tr">WhatsApp Group: <a id="trainerWhatsapp" href="#" target="_blank">Join Group</a> -->
          <!-- <p class="link_enroll tr">Contact: <a id="whatsappLink" href="#" target="_blank">Join WhatsApp -->

          <p class="linkedin_enroll tr">
            LinkedIn: <a id="trainerLinkedIn" href="#" target="_blank">Click Here</a>
          </p>
          <p class="instagram_enroll tr">
            Instagram: <a id="trainerInstagram" href="#" target="_blank">Click Here</a>
          </p>
        </div>

        <button class="enroll_submit" type="submit">Submit</button>
      </form>
    </div>
  </div>

  <section class="section__container photos__container">
    <p class="section__subheader">GALLERY</p>
    <h2 class="section__header">See The Latest Photos</h2>
    <div class="photos__grid">
      <div class="photos__card">
        <img src="images/photos-1.jpg" alt="photo" />
      </div>
      <div class="photos__card">
        <img src="images/photos-2.jpg" alt="photo" />
      </div>
      <div class="photos__card">
        <img src="images/photos-3.jpg" alt="photo" />
      </div>
      <div class="photos__card">
        <img src="images/photos-4.jpg" alt="photo" />
      </div>
    </div>
  </section>

  <!-- Logout Confirmation Modal -->
  <!-- Logout Modal -->
  <div id="logoutModal" class="top-modal hidden">
    <div class="top-modal-box">
      <p>Are you sure you want to logout?</p>
      <div class="modal-actions">
        <button onclick="proceedLogout()" class="btn-confirm">Yes</button>
        <button onclick="closeLogoutModal()" class="btn-cancel">Cancel</button>
      </div>
    </div>
  </div>


  <script>
    function showLogoutModal() {
      document.getElementById("logoutModal").classList.remove("hidden");
    }

    function closeLogoutModal() {
      document.getElementById("logoutModal").classList.add("hidden");
    }

    function proceedLogout() {
      window.location.href = "logout.php";
    }

  </script>


  <footer class="footer" id="contact">
    <div class="section__container footer__container">
      <div class="footer__col">
        <div class="footer__logo"><a href="#">SwasthaYoga</a></div>
      </div>
      <div class="footer__col">
        <p>Follow us</p>
      </div>
      <ul class="footer__socials">
        <li>
          <a href="https://www.facebook.com/profile.php?id=61575178363146" target="_blank" class="footer__social-link">
            <i class="fa-brands fa-facebook"></i>
          </a>
        </li>

        <li>
          <a href="https://www.instagram.com/swasthyoga012/" target="_blank" class="footer__social-link">
            <i class="fa-brands fa-instagram"></i>
          </a>
        </li>

        <li>
          <a href="https://x.com/SwasthYoga012" target="_blank" class="footer__social-link">
            <i class="fa-brands fa-twitter"></i>
          </a>
        </li>

        <li>
          <a href="https://www.youtube.com/channel/UC84HQ5b3ndD88gXybaW5U0g" target="_blank"
            class="footer__social-link">
            <i class="fa-brands fa-youtube"></i>
          </a>
        </li>
      </ul>
    </div>
    <!-- <div class="section__container footer__bar">
      Copyright © 2023 Web Design Mastery. All rights reserved.
    </div> -->
  </footer>
  <script>
    function openModal() {
      fetch("login.html")
        .then(res => res.text())
        .then(html => {
          document.getElementById("modalContainer").innerHTML = html;
        });
    }
  </script>
  <script>
    function fetchTrainers(yogaType) {
      fetch(`get_trainers.php?yogaType=${encodeURIComponent(yogaType)}`)
        .then(res => res.json())
        .then(trainers => {
          const select = document.getElementById('trainerSelect');
          select.innerHTML = '<option value="">Select Trainer</option>';
          trainers.forEach(trainer => {
            const opt = document.createElement('option');
            opt.value = trainer.email;
            opt.textContent = `${trainer.name}`;
            select.appendChild(opt);
          });
        });
    }

    function openEnrollModal(button) {
      const yogaType = button.getAttribute('data-yoga-type');
      console.log("select yogaType:", yogaType);
      document.getElementById('yogaType').value = yogaType;
      fetchTrainers(yogaType);
      document.getElementById('enrollModal').classList.remove('hidden');
    }

    function closeEnrollModal() {
      document.getElementById('enrollModal').classList.add('hidden');
      // Show trainer info when selected
      document.getElementById('trainerSelect').addEventListener('change', () => {
        const email = document.getElementById('trainerSelect').value;
        if (!email) return;

        trainerSelect.addEventListener('change', () => {
          const email = trainerSelect.value;
          if (!email) return;

          fetch(`get_trainer_profile.php?email=${encodeURIComponent(email)}`)
            .then(res => res.json())
            .then(data => {
              document.getElementById('trainerAbout').textContent = data.bio || 'N/A';
              document.getElementById('trainerExperience').textContent = data.experience_years || '0';

              fetch('check_login.php')
                .then(res => res.json())
                .then(status => {
                  const link = document.getElementById('whatsappLink');
                  if (status.logged_in) {
                    link.href = data.whatsapp_group || '#';
                    link.textContent = 'Join WhatsApp Group';
                  } else {
                    link.href = '#';
                    link.textContent = 'Login to access group';
                  }
                  document.getElementById('trainerDetails').classList.remove('hidden');
                });
            });
        });
      });
    }

    const trainerSelect = document.getElementById('trainerSelect');
    const learnMoreBtn = document.getElementById('learnMoreBtn');

    // Store trainer details in a JS object
    let trainerDataMap = {};

    function fetchTrainers(yogaType) {
      fetch(`get_trainers.php?yoga_type=${yogaType}`)
        .then(res => res.json())
        .then(data => {
          trainerSelect.innerHTML = '<option value="">Select Trainer</option>';
          data.forEach(trainer => {
            const option = document.createElement('option');
            option.value = trainer.email;
            option.textContent = trainer.name;
            trainerSelect.appendChild(option);

            // Save trainer info
            trainerDataMap[trainer.email] = trainer;
          });
        });
    }

    trainerSelect.addEventListener('change', function () {
      const selectedTrainer = trainerDataMap[this.value];
      if (selectedTrainer) {
        // Show brief info
        document.getElementById('trainerName').textContent = selectedTrainer.name;
        document.getElementById('trainerEmail').textContent = selectedTrainer.email;
        document.getElementById('trainerAbout').textContent = selectedTrainer.bio;
        document.getElementById('trainerExperience').textContent = selectedTrainer.experience_years;
        // document.getElementById('whatsappLink').href = selectedTrainer.whatsapp_group;
        document.getElementById('trainerLinkedIn').href = selectedTrainer.linkedin || '#';
        document.getElementById('trainerInstagram').href = selectedTrainer.instagram || '#';
        document.getElementById('trainerDetails').classList.remove('hidden');

        // Show Learn More button
        learnMoreBtn.style.display = 'inline-block';

        // Fill data for modal
        document.getElementById('modalTrainerName').textContent = selectedTrainer.name;
        document.getElementById('modalTrainerExperience').textContent = selectedTrainer.experience_years;
        document.getElementById('modalTrainerBio').textContent = selectedTrainer.bio;
        // document.getElementById('modalTrainerWhatsapp').href = selectedTrainer.whatsapp_group;
      } else {
        document.getElementById('trainerDetails').classList.add('hidden');
        learnMoreBtn.style.display = 'none';
      }
    });

    learnMoreBtn.addEventListener('click', function () {
      document.getElementById('trainerInfoModal').classList.remove('hidden');
    });

    function closeTrainerInfoModal() {
      document.getElementById('trainerInfoModal').classList.add('hidden');
    }

    //-------------------Your enrollment modal and other HTML--------------------------
    document.getElementById('yogaType').addEventListener('change', function () {
      const yogaType = this.value;

      fetch('get_trainers.php?yoga_type=' + encodeURIComponent(yogaType))
        .then(res => res.json())
        .then(data => {
          const trainerSelect = document.getElementById('trainerSelect');
          trainerSelect.innerHTML = '<option value="">Select Trainer</option>';

          data.forEach(trainer => {
            const option = document.createElement('option');
            option.value = trainer.email;
            option.textContent = trainer.name;
            trainerSelect.appendChild(option);
          });
        });
    });

  </script>
</body>

</html>


<script src="js/main.js"></script>
</body>

</html>