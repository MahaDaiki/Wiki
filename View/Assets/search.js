

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