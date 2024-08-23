document.addEventListener("DOMContentLoaded", function () {
    var searchBtn = document.getElementById('search-icon');
    var searchBox = document.getElementById('search-box');
    var closeBtn = document.getElementById('close-btn');

    searchBtn.addEventListener('click', function () {
        searchBox.classList.toggle('hidden');
    });

    closeBtn.addEventListener('click', function () {
        searchBox.classList.add('hidden');
    });
});
