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