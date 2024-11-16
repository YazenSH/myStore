<?php include '../includes/header.php'; ?>

<div class="gallery-container">
    <h2>Our Photography Equipment</h2>
    <div class="gallery">
        <div class="main-image">
            <img id="featured" src="../Images/canon-eos-r5.jpg" alt="Featured Image">
        </div>
        <div class="thumbnails">
            <img class="thumb" src="../Images/canon-eos-r5.jpg" alt="Canon EOS R5"/>
            <img class="thumb" src="../Images/Nikon70-200.jpg" alt="Nikon 70-200"/>
            <img class="thumb" src="../Images/sony-alpha-a7-iii.jpg" alt="Sony Alpha"/>
            <img class="thumb" src="../Images/tripod.jpg" alt="Tripod"/>
            <img class="thumb" src="../Images/insta360.jpg" alt="Insta360"/>
            <img class="thumb" src="../Images/micro128GB.jpg" alt="Memory Card"/>
        </div>
    </div>
</div>

<script type="text/javascript">
document.addEventListener('DOMContentLoaded', () => {
    const featured = document.getElementById('featured');
    const thumbnails = document.querySelectorAll('.thumb');
    
    thumbnails.forEach(thumb => {
        thumb.addEventListener('click', () => {
            featured.src = thumb.src;
            featured.alt = thumb.alt;
        });
    });
});
</script>

<?php include '../includes/footer.php'; ?>