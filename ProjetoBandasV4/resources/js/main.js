document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('scrollButton').addEventListener('click', function() {
        document.getElementById('albumSection').scrollIntoView({ behavior: 'smooth' });
    });
});



