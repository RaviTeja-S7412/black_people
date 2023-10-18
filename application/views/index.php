<?php
  $this->load->view('includes/header')
?>


  <div class="content">
    <div class="search-bar">
      <a href="<? echo base_url('home/search') ?>"><button type="submit">Search</button></a>
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

    <? 
      $articles =  $this->db->order_by('rand()')->limit(3)->get_where('tbl_pdfs')->result(); 
      foreach($articles as $a){
        $text = json_decode($a->extracted_text);
    ?>

      <div class="link-container">
        <a href="<? echo base_url().$a->pdf_file ?>" target="_blank"><? echo $a->title ?></a>
      </div>

      <div class="description-container">
          <p style="font-style: italic;"><? echo $a->author ?> - <?echo $a->year ?></p>
        <p><? echo $text[1] ? substr($text[1], 0, 400) : substr($text[0], 0, 400) ?></p>
      </div>
      <hr>

    <? } ?>  
      
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