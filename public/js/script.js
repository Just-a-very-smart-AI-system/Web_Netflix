window.onload = () => {
  getOriginals()
  getTrendingNow()
  getTopRated()
  getActionMovies()
  getAdventureMovies()
  getAnimationMovies()
  getCrimeMovies()
  getComedyMovies()
  getDocumentaryMovies()
  getDramaMovies()
  getFamilyMovies()
  getFantasyMovies()
  getHistoryMovies()
  getHorrorMovies()
  getMusicMovies()
  getMysteryMovies()
  getScienceFictionMovies()
  getThrillerMovies()
  getTVMovies()
  getWarMovies()
  getWesternMovies()
}

// fetchMovies('https://api.themoviedb.org/3/movie/top_rated?api_key=19f84e11932abbc79e6d83f82d6d1045&language=en-US&page=1', 'top_rated', 'backdrop_path')
function fetchMovies(url, dom_element, path_type) {
  fetch(url)
    .then(response => {
      if (response.ok) {
        
        return response.json()
      } else {
        throw new Error('something went wrong')
      }
    })
    .then(data => {
      console.log(data);
      showMovies(data, dom_element, path_type)
    })
    .catch(error_data => {
      console.log(error_data)
    })
}

const showMovies = (movies, dom_element, path_type) => {
  if (!movies || !movies.results || movies.results.length === 0) return;

  const moviesEl = document.querySelector(dom_element);
  if (!moviesEl) return;

  movies.results.forEach(movie => {
    // Tạo thẻ chứa phim
    const movieCard = document.createElement('div');
    movieCard.classList.add('movie-card');

    // Tạo thẻ ảnh
    const imageElement = document.createElement('img');
    imageElement.setAttribute('data-id', movie.id);
    imageElement.src = `https://image.tmdb.org/t/p/original${movie[path_type]}`;
    
    // Tạo container cho các nút
    const buttonContainer = document.createElement('div');
    buttonContainer.classList.add('button-container');

    // Tạo nút Play
    const playButton = document.createElement('button');
    playButton.classList.add('play-btn');
    playButton.innerHTML = '&#9658;'; // Mã HTML cho hình tam giác
    // Truyền trực tiếp movie.id vào hàm handleMovieSelection
    playButton.addEventListener('click', () => handleMovieSelection(movie.id));

    // Tạo nút Trái Tim
    const heartButton = document.createElement('button');
    heartButton.classList.add('heart-btn');
    heartButton.addEventListener('click', () => {
      console.log(`Added movie ID: ${movie.id} to wishlist`);
    });

    // Thêm các nút vào container
    buttonContainer.appendChild(playButton);
    buttonContainer.appendChild(heartButton);

    // Thêm ảnh và nút vào thẻ phim
    movieCard.appendChild(imageElement);
    movieCard.appendChild(buttonContainer);

    // Thêm thẻ phim vào DOM
    moviesEl.appendChild(movieCard);
  });
};




// ** Function that fetches Netflix Originals **
function getOriginals() {
  var url =
    'https://api.themoviedb.org/3/discover/tv?api_key=19f84e11932abbc79e6d83f82d6d1045&with_networks=213&page=1'
  fetchMovies(url, '.original__movies', 'poster_path'); 
}

// ** Function that fetches Trending Movies **
function getTrendingNow() {
  var url =
    'https://api.themoviedb.org/3/trending/movie/week?api_key=19f84e11932abbc79e6d83f82d6d1045&language=en-US&page=1'
  fetchMovies(url, '#trending', 'backdrop_path')
}

// ** Function that fetches Top Rated Movies **
function getTopRated() {
  var url =
    'https://api.themoviedb.org/3/movie/top_rated?api_key=19f84e11932abbc79e6d83f82d6d1045&language=en-US&page=1'
  fetchMovies(url, '#top_rated', 'backdrop_path')
}

// ** Function that fetches Action Movies **
function getActionMovies() {
  var url =
    'https://api.themoviedb.org/3/discover/movie?api_key=19f84e11932abbc79e6d83f82d6d1045&with_genres=28'
  fetchMovies(url, '#action', 'backdrop_path')
}

// ** Function that fetches Adventure Movies **
function getAdventureMovies() {
  var url =
    'https://api.themoviedb.org/3/discover/movie?api_key=19f84e11932abbc79e6d83f82d6d1045&with_genres=12'
  fetchMovies(url, '#adventure', 'backdrop_path')
}

// ** Function that fetches Animation Movies **
function getAnimationMovies() {
  var url =
    'https://api.themoviedb.org/3/discover/movie?api_key=19f84e11932abbc79e6d83f82d6d1045&with_genres=16'
  fetchMovies(url, '#animation', 'backdrop_path')
}

// ** Function that fetches Thriller Movies **
function getThrillerMovies() {
  var url =
    'https://api.themoviedb.org/3/discover/movie?api_key=19f84e11932abbc79e6d83f82d6d1045&with_genres=53'
  fetchMovies(url, '#thriller', 'backdrop_path')
}

// ** Function that fetches Science Fiction Movies **
function getScienceFictionMovies() {
  var url =
    'https://api.themoviedb.org/3/discover/movie?api_key=19f84e11932abbc79e6d83f82d6d1045&with_genres=878'
  fetchMovies(url, '#science_fiction', 'backdrop_path')
}

// ** Function that fetches Crime Movies **
function getCrimeMovies() {
  var url =
    'https://api.themoviedb.org/3/discover/movie?api_key=19f84e11932abbc79e6d83f82d6d1045&with_genres=80'
  fetchMovies(url, '#crime', 'backdrop_path')
}

// ** Function that fetches Comedy Movies **
function getComedyMovies() {
  var url =
    'https://api.themoviedb.org/3/discover/movie?api_key=19f84e11932abbc79e6d83f82d6d1045&with_genres=35'
  fetchMovies(url, '#comedy', 'backdrop_path')
}

// ** Function that fetches Documentary Movies **
function getDocumentaryMovies() {
  var url =
    'https://api.themoviedb.org/3/discover/movie?api_key=19f84e11932abbc79e6d83f82d6d1045&with_genres=99'
  fetchMovies(url, '#documentary', 'backdrop_path')
}

// ** Function that fetches Drama Movies **
function getDramaMovies() {
  var url =
    'https://api.themoviedb.org/3/discover/movie?api_key=19f84e11932abbc79e6d83f82d6d1045&with_genres=18'
  fetchMovies(url, '#drama', 'backdrop_path')
}

// ** Function that fetches Family Movies **
function getFamilyMovies() {
  var url =
    'https://api.themoviedb.org/3/discover/movie?api_key=19f84e11932abbc79e6d83f82d6d1045&with_genres=10751'
  fetchMovies(url, '#family', 'backdrop_path')
}

// ** Function that fetches Fantasy Movies **
function getFantasyMovies() {
  var url =
    'https://api.themoviedb.org/3/discover/movie?api_key=19f84e11932abbc79e6d83f82d6d1045&with_genres=14'
  fetchMovies(url, '#fantasy', 'backdrop_path')
}

// ** Function that fetches History Movies **
function getHistoryMovies() {
  var url =
    'https://api.themoviedb.org/3/discover/movie?api_key=19f84e11932abbc79e6d83f82d6d1045&with_genres=36'
  fetchMovies(url, '#history', 'backdrop_path')
}

// ** Function that fetches Horror Movies **
function getHorrorMovies() {
  var url =
    'https://api.themoviedb.org/3/discover/movie?api_key=19f84e11932abbc79e6d83f82d6d1045&with_genres=27'
  fetchMovies(url, '#horror', 'backdrop_path')
}

// ** Function that fetches Music Movies **
function getMusicMovies() {
  var url =
    'https://api.themoviedb.org/3/discover/movie?api_key=19f84e11932abbc79e6d83f82d6d1045&with_genres=10402'
  fetchMovies(url, '#music', 'backdrop_path')
}

// ** Function that fetches Mystery Movies **
function getMysteryMovies() {
  var url =
    'https://api.themoviedb.org/3/discover/movie?api_key=19f84e11932abbc79e6d83f82d6d1045&with_genres=9648'
  fetchMovies(url, '#mystery', 'backdrop_path')
}

// ** Function that fetches TV Movies **
function getTVMovies() {
  var url =
    'https://api.themoviedb.org/3/discover/movie?api_key=19f84e11932abbc79e6d83f82d6d1045&with_genres=10770'
  fetchMovies(url, '#tv_movies', 'backdrop_path')
}

// ** Function that fetches War Movies **
function getWarMovies() {
  var url =
    'https://api.themoviedb.org/3/discover/movie?api_key=19f84e11932abbc79e6d83f82d6d1045&with_genres=10752'
  fetchMovies(url, '#war', 'backdrop_path')
}

// ** Function that fetches Western Movies **
function getWesternMovies() {
  var url =
    'https://api.themoviedb.org/3/discover/movie?api_key=19f84e11932abbc79e6d83f82d6d1045&with_genres=37'
  fetchMovies(url, '#western', 'backdrop_path')
}

// ** Get Movies Trailers **

async function getMovieTrailer(id) {
  var url = `https://api.themoviedb.org/3/movie/${id}/videos?api_key=19f84e11932abbc79e6d83f82d6d1045&language=en-US&page=1`
  return await fetch(url).then(response => {
    if (response.ok) {
      return response.json()
    } else {
      throw new Error('Something went wrong!')
    }
  })
}

const setTrailer = trailers => {
  const iframe = document.getElementById('movieTrailer')
  const movieNotFound = document.querySelector('.movieNotFound')
  if (trailers.length > 0) {
    movieNotFound.classList.add('d-none')
    iframe.classList.remove('d-none')
    iframe.src = `https://www.youtube.com/embed/${trailers[0].key}`
  } else {
    iframe.classList.add('d-none')
    movieNotFound.classList.remove('d-none')
  }
}

const handleMovieSelection = id => {
  const iframe = document.getElementById('movieTrailer')
  getMovieTrailer(id).then(data => {
    const results = data.results
    const youtubeTrailers = results.filter(result => {
      if (result.site == 'YouTube' && result.type == 'Trailer') {
        return true
      } else {
        return false
      }
    })
    setTrailer(youtubeTrailers)
  })

  $('#trailerModal').modal('show')
}

