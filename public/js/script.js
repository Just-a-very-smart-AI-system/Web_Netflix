let Favorites = []; // Biến toàn cục để lưu danh sách yêu thích
let Histories = [];  // Biến toàn cục để lưu lịch sử
let allMovies = [];
const userId = 2;
const apiUrlFavorite = `http://127.0.0.1:8000/api/favorites/user/${userId}`;
const apiUrlHistory = `http://127.0.0.1:8000/api/history/user/${userId}`;
const apiCreateFavorite = 'http://127.0.0.1:8000/api/favorites/create';
const apiCreateHistory = 'http://127.0.0.1:8000/api/history/create';
const apiDeleteFavorite = `http://127.0.0.1:8000/api/favorites/delete`

loadMovies();

async function main(){
  await loadMovies();
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

window.onload = () => {
  loadAllMovies();
  getFavoritesByUserId(apiUrlFavorite);
  getFavoritesByUserId(apiUrlHistory);
  main();
}

async function loadMovies() {
  try {
    // Lấy danh sách yêu thích trước
    const favoriteData = await getFavoritesByUserId(apiUrlFavorite);
    Favorites = favoriteData;  // Gán kết quả vào biến toàn cục
    console.log('Favorites:', Favorites);
    displayMoviesFromFavorites(Favorites, "#favorite", 'backdrop_path');
  
    // Sau khi lấy danh sách yêu thích, mới lấy danh sách lịch sử
    const historyData = await getFavoritesByUserId(apiUrlHistory);
    Histories = historyData;  // Gán kết quả vào biến toàn cục
    console.log('History:', Histories);
    displayMoviesFromFavorites(Histories, "#my_history", 'backdrop_path');
  } catch (error) {
    console.error("Error loading data:", error);
  }
}

function loadAllMovies(){
  url = 'http://127.0.0.1:8000/api/movies/all';
  return fetch(url,{
    method: 'GET',
    headers: {
      'Content-type' :'application/json',
    },
  })
    .then(response =>{
      if (!response.ok) {
        return response.json().then(errorData => {
          throw new Error(errorData.message || 'Failed to fetch data');
        });
      }
      allMovies = response.json();
      return response.json();
    })
    .catch(error => {
      console.error('Error:', error.message);
      return []; // Trả về mảng rỗng nếu có lỗi
    });
}

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
      // console.log(data);
      showMovies(data, dom_element, path_type)
    })
    .catch(error_data => {
      console.log(error_data)
    })
}

const showMovies = async (movies, dom_element, path_type) => {
  if (!movies || !movies.results || movies.results.length === 0) return;
  if(!Favorites || !Favorites.results || Favorites.results.length === 0){
  }
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
    playButton.addEventListener('click', () => {
      data = {movie_id : movie.id, user_id : userId};
      createMyList(apiCreateHistory, data);        
      // console.log(`Added movie ID: ${movie.id} to History`);
      handleMovieSelection(movie.id)
    });

    // Tạo nút Trái Tim
    const heartButton = document.createElement('button');

    heartButton.classList.add('heart-btn');

    Favorites.forEach(f => {
      if(movie.id == f.id){
        heartButton.classList.add('favorite');
        // console.log("add button:", movie.id);
      }
    });

    // Gắn sự kiện cho nút Trái Tim
    heartButton.addEventListener('click', () => {
      if (!heartButton.classList.contains('favorite')) {
        heartButton.classList.add('favorite');
        console.log(`Added movie ID: ${movie.id} to wishlist`);
        data = {movie_id : movie.id, user_id : userId};
        createMyList(apiCreateFavorite, data);        
      } else {
        heartButton.classList.remove('favorite');
        console.log(`Removed movie ID: ${movie.id} from wishlist`);
        data = {movie_id : movie.id, user_id : userId};
        deleteMyList(apiDeleteFavorite, data);
      }
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


// Hàm gọi API lấy danh sách phim từ URL truyền vào
function getFavoritesByUserId(url) {
  return fetch(url, {
    method: 'GET',
    headers: {
      'Content-Type': 'application/json',
    },
  })
    .then(response => {
      if (!response.ok) {
        return response.json().then(errorData => {
          throw new Error(errorData.message || 'Failed to fetch data');
        });
      }
      return response.json();
    })
    .catch(error => {
      console.error('Error:', error.message);
      return []; // Trả về mảng rỗng nếu có lỗi
    });
}

function displayMoviesFromFavorites(movies, dom_element) {
  if (!movies || movies.length === 0) return;

  const moviesEl = document.querySelector(dom_element);
  if (!moviesEl) return;

  moviesEl.innerHTML = '';

  movies.forEach(movie => {
    const movieCard = document.createElement('div');
    movieCard.classList.add('movie-card');

    const imageElement = document.createElement('img');
    imageElement.setAttribute('data-id', movie.id);
    imageElement.src = movie.url;

    const buttonContainer = document.createElement('div');
    buttonContainer.classList.add('button-container');

    const playButton = document.createElement('button');
    playButton.classList.add('play-btn');
    playButton.innerHTML = '&#9658;';
    playButton.addEventListener('click', () => {
      data = {movie_id : movie.id, user_id : userId};
      createMyList(apiCreateHistory, data);        
      console.log(`Added movie ID: ${movie.id} to wishlist`);
      handleMovieSelection(movie.id)
    });

    const heartButton = document.createElement('button');
    heartButton.classList.add('heart-btn');

    Favorites.forEach(f => {
      if(movie.id == f.id){
        heartButton.classList.add('favorite');
      }
    });
    // Gắn sự kiện cho nút Trái Tim
    heartButton.addEventListener('click', () => {
      if (!heartButton.classList.contains('favorite')) {
        heartButton.classList.add('favorite');
        console.log(`Added movie ID: ${movie.id} to wishlist`);
        data = {movie_id : movie.id, user_id : userId};
        createMyList(apiCreateFavorite, data);        
      } else {
        heartButton.classList.remove('favorite');
        console.log(`Removed movie ID: ${movie.id} from wishlist`);
        data = {movie_id : movie.id, user_id : userId};
        deleteMyList(apiDeleteFavorite, data);
      }
    });

    buttonContainer.appendChild(playButton);
    buttonContainer.appendChild(heartButton);
    movieCard.appendChild(imageElement);
    movieCard.appendChild(buttonContainer);
    moviesEl.appendChild(movieCard);
  });
}

function createMyList(url, data) {
  console.log('Calling createMyList with:', url, data); // Thêm log

  return fetch(url, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify(data),
  })
    .then(response => {
      console.log(response);
      if (!response.ok) {
        return response.text().then(errorData => {
          try {
            const errorJson = JSON.parse(errorData);
            throw new Error(errorJson.message || 'Failed to create my_list');
          } catch (e) {
            // Nếu không thể parse JSON, ném lỗi chung
            throw new Error(errorData || 'Failed to create my_list');
          }
        });
      }
      // Nếu thành công, trả về JSON từ phản hồi
      return response.json();
    })
    .then(result => {
      console.log('My_list created successfully:', result);
      return result;
    })
    .catch(error => {
      console.error('Error:', error.message);
      return null;
    });
}

function deleteMyList(url, data) {
  return fetch(url, {
    method: 'DELETE',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify(data), // Gửi `movie_id` và `user_id` trong body
  })
    .then(response => {
      if (!response.ok) {
        return response.json().then(errorData => {
          throw new Error(errorData.message || 'Failed to delete favorite');
        });
      }
      console.log(`Favorite with movie_id ${data.movie_id} and user_id ${data.user_id} deleted successfully.`);
      return true; // Trả về `true` nếu xóa thành công
    })
    .catch(error => {
      console.error('Error:', error.message);
      return false; // Trả về `false` nếu có lỗi
    });
}



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

