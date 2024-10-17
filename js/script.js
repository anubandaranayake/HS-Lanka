document.getElementById('searchIcon').onclick = function() {
    const searchBox = document.getElementById('searchBox');
    // Toggle the visibility of the search box
    searchBox.style.display = searchBox.style.display === 'none' || searchBox.style.display === '' ? 'flex' : 'none';
};

// Perform the search when the search button is clicked
document.getElementById('searchButton').onclick = function() {
    const query = document.getElementById('searchInput').value.trim();
    
    // Check if the search input is empty
    if (query === '') {
        alert('Please enter a product name to search.');
        return;
    }

    // Fetch search results
    fetch(`search.php?query=${encodeURIComponent(query)}`)
        .then(response => response.json())
        .then(data => {
            const resultsDiv = document.getElementById('results');
            resultsDiv.innerHTML = ''; // Clear previous results
            if (data.length === 0) {
                resultsDiv.innerHTML = '<p>No products found.</p>';
            } else {
                data.forEach(product => {
                    resultsDiv.innerHTML += `
                        <div class="result-item">
                            <h3>${product.name}</h3>
                            <p>${product.description}</p>
                            <p>Price: ₹${product.Price}</p>
                        </div>
                    `;
                });
            }
        })
        .catch(error => console.error('Error fetching data:', error));
};
