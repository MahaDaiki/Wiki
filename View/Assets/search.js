// document.addEventListener("DOMContentLoaded", function() {
//     const searchBox = document.querySelector(".search-box");
//     const searchInput = searchBox.querySelector("input[type='text']");
//     const searchResults = document.getElementById("search-results");

//     searchInput.addEventListener("input", function() {
//         const query = searchInput.value.trim();

//         if (query.length === 0) {
//             searchResults.innerHTML = ""; // Clear results if the search box is empty
//             return;
//         }

//         // Send an AJAX request to your server
//     });
// });
// function search(query){
// const xhr = new XMLHttpRequest();
// xhr.open("GET", `index.php?action=Search&query=${query}`, true);
// xhr.onreadystatechange = function() {
//     if (xhr.readyState === 4 && xhr.status === 200) {
//         // Update the search results div with the response
//         let search = JSON.parse(xhr.responseText);
//         console.log(search);
//     }
// }

// xhr.send();
// }
// let hihhi = "My first Wiki";
// search(hihhi);

search = document.getElementById('input-search');

wikis = document.querySelectorAll('.wikis');

search.addEventListener('input', function() {
    let xhr = new XMLHttpRequest();
    xhr.open("GET", 'index.php?action=Search&query=' + search.value, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            wikis_id = JSON.parse(this.responseText);
            wikis.forEach(function(wiki) {
                if(!wikis_id.includes(Number(wiki.id))) {
                    wiki.style.display = 'none';
                } else {
                    wiki.style.display = 'block';
                }
            });
            
        }
    }
xhr.send();

});