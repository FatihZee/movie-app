const searchMovie = async () => {
    const title = document.getElementById("movieTitle").value;
    if (!title) {
        alert("Please enter a movie title.");
        return;
    }

    try {
        const response = await fetch(`http://localhost:5000/api/movie?title=${title}`);
        const data = await response.json();

        if (data.Response === "False") {
            document.getElementById("movieDetails").innerHTML = `<p class="text-danger">Movie not found!</p>`;
            return;
        }

        document.getElementById("movieDetails").innerHTML = `
            <div class="movie-card">
                <h2>${data.Title} (${data.Year})</h2>
                <p><strong>Rated:</strong> ${data.Rated}</p>
                <p><strong>Released:</strong> ${data.Released}</p>
                <p><strong>Runtime:</strong> ${data.Runtime}</p>
                <p><strong>Genre:</strong> ${data.Genre}</p>
                <p><strong>Director:</strong> ${data.Director}</p>
                <p><strong>Writer:</strong> ${data.Writer}</p>
                <p><strong>Actors:</strong> ${data.Actors}</p>
                <p><strong>Plot:</strong> ${data.Plot}</p>
                <p><strong>Language:</strong> ${data.Language}</p>
                <p><strong>Country:</strong> ${data.Country}</p>
                <p><strong>Awards:</strong> ${data.Awards}</p>
                <img src="${data.Poster}" class="img-fluid my-3" alt="Movie Poster">
                <p><strong>IMDB Rating:</strong> ${data.imdbRating} (${data.imdbVotes} votes)</p>
                <p><strong>Metascore:</strong> ${data.Metascore}</p>
                <p><strong>Box Office:</strong> ${data.BoxOffice}</p>
                <p><strong>Production:</strong> ${data.Production}</p>
                <h4>Ratings:</h4>
                <ul>
                    ${data.Ratings.map(rating => `<li><strong>${rating.Source}:</strong> ${rating.Value}</li>`).join("")}
                </ul>
            </div>
        `;
    } catch (error) {
        document.getElementById("movieDetails").innerHTML = `<p class="text-danger">Error fetching data.</p>`;
    }
};
