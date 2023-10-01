<?php
  $this->load->view('includes/header')
?>


  <div class="content">
    <div class="search-bar">
      <form id="search-form" action="UserResult.html" method="GET">
      <button type="submit">Search</button>
    </div>

    <div class="image-slider">
        <div class="slider-container">
          <div class="slider-images">
            <img src="<? echo base_url('assets/images/') ?>rev.jpeg" alt="Image 1" class="active">
            <img src="<? echo base_url('assets/images/') ?>rev2.jpeg" alt="Image 2">
            <img src="<? echo base_url('assets/images/') ?>rev3.jpeg" alt="Image 3">
            <img src="<? echo base_url('assets/images/') ?>rev4.jpeg" alt="Image 4">
            <img src="<? echo base_url('assets/images/') ?>rev5.jpeg" alt="Image 5">
            <img src="<? echo base_url('assets/images/') ?>rev6.jpeg" alt="Image 6">
          </div>
        </div>
        <div class="slider-navigation">
          <span class="dot active" onclick="currentSlide(1)"></span>
          <span class="dot" onclick="currentSlide(2)"></span>
          <span class="dot" onclick="currentSlide(3)"></span>
          <span class="dot" onclick="currentSlide(4)"></span>
        </div>
        <a class="prev" onclick="prevSlide()" >&#10094;</a>
        <a class="next" onclick="nextSlide()" >&#10095;</a>
      </div>

    <h1>Featured Articles</h1>
    <div class="link-container">
      <a href="https://www.semanticscholar.org/paper/CorrAUC%3A-A-Malicious-Bot-IoT-Traffic-Detection-in-Shafiq-Tian/026cbbb91e5a0d5b606917d14b385a2b84fee64e">The Black revolution on campus</a>
    </div>

    <div class="description-container">
        <p style="font-style: italic;">M Biondi - 2019 - degruyter.com</p>
      <p>The Black Revolution on Campus is the definitive account of an extraordinary but forgotten chapter of the black freedom struggle. In the late 1960s and early 1970s, Black students organized hundreds of protests that sparked a period of crackdown, negotiation, and reform that profoundly transformed college life. At stake was the very mission of higher education. Black students demanded that public universities serve their communities; that private universities rethink the mission of elite education; and that black colleges embrace self-determination and resist the threat of integration. Most crucially, black students demanded a role in the definition of scholarly knowledge.</p>
    </div>
<hr>
    <div class="link-container">
        <a href="https://www.semanticscholar.org/paper/CorrAUC%3A-A-Malicious-Bot-IoT-Traffic-Detection-in-Shafiq-Tian/026cbbb91e5a0d5b606917d14b385a2b84fee64e">The Black revolution on campus</a>
      </div>
  
      <div class="description-container">
          <p style="font-style: italic;">M Biondi - 2019 - degruyter.com</p>
        <p>The Black Revolution on Campus is the definitive account of an extraordinary but forgotten chapter of the black freedom struggle. In the late 1960s and early 1970s, Black students organized hundreds of protests that sparked a period of crackdown, negotiation, and reform that profoundly transformed college life. At stake was the very mission of higher education. Black students demanded that public universities serve their communities; that private universities rethink the mission of elite education; and that black colleges embrace self-determination and resist the threat of integration. Most crucially, black students demanded a role in the definition of scholarly knowledge.</p>
      </div>
<hr>
      <div class="link-container">
        <a href="https://www.semanticscholar.org/paper/CorrAUC%3A-A-Malicious-Bot-IoT-Traffic-Detection-in-Shafiq-Tian/026cbbb91e5a0d5b606917d14b385a2b84fee64e">The Black revolution on campus</a>
      </div>
  
      <div class="description-container">
          <p style="font-style: italic;">M Biondi - 2019 - degruyter.com</p>
        <p>The Black Revolution on Campus is the definitive account of an extraordinary but forgotten chapter of the black freedom struggle. In the late 1960s and early 1970s, Black students organized hundreds of protests that sparked a period of crackdown, negotiation, and reform that profoundly transformed college life. At stake was the very mission of higher education. Black students demanded that public universities serve their communities; that private universities rethink the mission of elite education; and that black colleges embrace self-determination and resist the threat of integration. Most crucially, black students demanded a role in the definition of scholarly knowledge.</p>
      </div>
  </div>
</div>

<script>
  let slideIndex = 1;
  showSlide(slideIndex);

  function currentSlide(n) {
    showSlide(slideIndex = n);
  }

  function prevSlide() {
    showSlide(slideIndex -= 1);
  }

  function nextSlide() {
    showSlide(slideIndex += 1);
  }

  function showSlide(n) {
    const slides = document.getElementsByClassName("slider-images")[0].children;
    const dots = document.getElementsByClassName("dot");

    if (n > slides.length) {
      slideIndex = 1;
    } else if (n < 1) {
      slideIndex = slides.length;
    }

    for (let i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
    }

    for (let i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
    }

    slides[slideIndex - 1].style.display = "block";
    dots[slideIndex - 1].className += " active";
  }

  function startSlideshow() {
    setInterval(() => {
      nextSlide();
    }, 2000); // Change slide every 2 seconds
  }

  window.addEventListener("DOMContentLoaded", startSlideshow);
</script>

</body>
</html>

    
<?php
  $this->load->view('includes/footer')
?>