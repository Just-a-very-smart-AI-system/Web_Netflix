<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/favicon_package/apple-touch-icon.png') }}">
    <link rel="android-chrome-512x512" href="{{ asset('images/favicon_package/android-chrome-512x512.png') }}">
    <link rel="android-chrome-192x192" href="{{ asset('images/favicon_package/android-chrome-192x192.png') }}">
    <title>Netflax</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" 
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" 
          crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('public/css/style.css') }}">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.0/flowbite.min.css" rel="stylesheet">
    <script>
        window.onload = function() {
        loadMovies();  // Gọi hàm loadMovies ngay khi tải trang
        // Sử dụng Blade để nhúng giá trị $user_id vào JavaScript
        // const userId = @json(session('user_id'));
        // console.log("User ID: ", userId);
    };
  </script>
</head>
<body>
<header>
    <div class="container mb-3 my-4" style="top: 10px">
        <a href="#" target="_self">
            <img class="header__img" src="{{ asset('images/logo.png') }}" alt="logo">
        </a>
        <a href="#" class="btn btn-rounded" id="logoutBtn">Log out</a>
    </div>
</header>
<main>
    <div class="hero">
        <div class="featured">
            <h1 class="featured__title">Dark</h1>
            <div class="featured__buttons container mx-1 mt-6">
                <div class="container mt-1" onclick="displayMsg()">
                    <button class="button__play my-3">
                        <i class="fas fa-play mx-1"></i>Play
                    </button>
                    <button class="button__list mx-2 my-3">
                        <i class="fas fa-list"></i> My List
                    </button>
                </div>
                <p class="featured__description">
                    When two children go missing in a small German town, its sinful past is exposed along with the 
                    double lives and fractured relationships...
                </p>
            </div>
        </div>
    </div>
    <div class="showcase-content">
        <h1>See what's next</h1>
        <p>Watch anywhere. Cancel Anytime</p>
    </div>
    <div class="netflixOriginals">
        <div class="original__header">
            <h2 class="headings">NETFLIX ORIGINALS</h2>
        </div>
        <div class="original__movies" style="width: max-content">
            <!-- Original Movies List Here -->
        </div>
    </div>
    <div id="wishlist"></div>
    <div class="movies__header">
        <h2 class="headings">Trending Now</h2>
    </div>
    <div id="trending" class="movies__container">
        <!-- Trending Movies List Here -->
    </div>
    <div class="movies__header">
        <h2 class="headings">Top Rated</h2>
    </div>
    <div id="top_rated" class="movies__container">
        <!-- Top Rated Movies List Here -->
    </div>
    <div class="showcase-content" style="height: 250px; margin: auto;">
        <h1>Genres</h1>
    </div>
    <div class="movies__header">
        <h2 class="headings">Action</h2>
    </div>
    <div id="action" class="movies__container">
        <!-- Action Movies List Here -->
    </div>
    <div class="movies__header">
        <h2 class="headings">Adventure</h2>
    </div>
    <div id="adventure" class="movies__container">
        <!-- Adventure Movies List Here -->
    </div>
    <div class="movies__header">
        <h2 class="headings">Animation</h2>
    </div>
    <div id="animation" class="movies__container">
        <!-- Animation Movies List Here -->
    </div>
    <div class="movies__header">
        <h2 class="headings">Crime</h2>
    </div>
    <div id="crime" class="movies__container">
        <!-- Crime Movies List Here -->
    </div>
    <div class="movies__header">
        <h2 class="headings">Comedy</h2>
    </div>
    <div id="comedy" class="movies__container">
        <!-- Comedy Movies List Here -->
    </div>
    <div class="movies__header">
        <h2 class="headings">Documentary</h2>
    </div>
    <div id="documentary" class="movies__container">
        <!-- Documentary Movies List Here -->
    </div>
    <div class="movies__header">
        <h2 class="headings">Drama</h2>
    </div>
    <div id="drama" class="movies__container">
        <!-- Drama Movies List Here -->
    </div>
    <div class="movies__header">
        <h2 class="headings">Family</h2>
    </div>
    <div id="family" class="movies__container">
        <!-- Family Movies List Here -->
    </div>
    <div class="movies__header">
        <h2 class="headings">Fantasy</h2>
    </div>
    <div id="fantasy" class="movies__container">
        <!-- Fantasy Movies List Here -->
    </div>
    <div class="movies__header">
        <h2 class="headings">History</h2>
    </div>
    <div id="history" class="movies__container">
        <!-- History Movies List Here -->
    </div>
    <div class="movies__header">
        <h2 class="headings">Horror</h2>
    </div>
    <div id="horror" class="movies__container">
        <!-- Horror Movies List Here -->
    </div>
    <div class="movies__header">
        <h2 class="headings">Music</h2>
    </div>
    <div id="music" class="movies__container">
        <!-- Music Movies List Here -->
    </div>
    <div class="movies__header">
        <h2 class="headings">Mystery</h2>
    </div>
    <div id="mystery" class="movies__container">
        <!-- Mystery Movies List Here -->
    </div>
    <div class="movies__header">
        <h2 class="headings">Science Fiction</h2>
    </div>
    <div id="science_fiction" class="movies__container">
        <!-- Science Fiction Movies List Here -->
    </div>
    <div class="movies__header">
        <h2 class="headings">Thriller</h2>
    </div>
    <div id="thriller" class="movies__container">
        <!-- Thriller Movies List Here -->
    </div>
    <div class="movies__header">
        <h2 class="headings">TV Movies</h2>
    </div>
    <div id="tv_movies" class="movies__container">
        <!-- TV Movies List Here -->
    </div>
    <div class="movies__header">
        <h2 class="headings">War</h2>
    </div>
    <div id="war" class="movies__container">
        <!-- War Movies List Here -->
    </div>
    <div class="movies__header">
        <h2 class="headings">Western</h2>
    </div>
    <div id="western" class="movies__container">
        <!-- Western Movies List Here -->
    </div>
    <div class="showcase-content" style="height: 250px; margin: auto;">
        <h1>My List</h1>
    </div>
    <div class="netflixOriginals">
        <div class="original__header">
            <h2 class="headings">FAVORITE</h2>
        </div>
        <div id="favorite"  class="original__movies" style="width: max-content">
            <!-- FAVORITE Movies List Here -->
        </div>
    </div>
    <div class="netflixOriginals">
        <div class="original__header">
            <h2 class="headings">HISTORY</h2>
        </div>
        <div id="my_history"  class="original__movies" style="width: max-content">
            <!-- HISTORY Movies List Here -->
        </div>
    </div>
</main>

<!-- Modal -->
<div class="modal fade" id="trailerModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <span class="movieNotFound">Trailer Not Found</span>
                <iframe id="movieTrailer" height="400" src="" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</div>

<footer class="text-gray-600 body-font" style="background-color: #000; margin-bottom: -5rem; margin-top: 1rem; background: linear-gradient(360deg, transparent, rgba(37, 37, 37, 0.61), #111 );">
    <div class="container px-5 py-8 mx-auto flex items-center sm:flex-row flex-col">
        <a class="flex title-font font-medium items-center md:justify-start justify-center text-gray-900">
            <img src="{{ asset('images/favicon_package/favicon-32x32.png') }}" alt="Footer logo" width="30" height="24" 
                 class="d-inline-block align-text-top" style="height: 50px; width: 50px; border-radius: 5px;">
            <span class="ml-3 text-xl" style="color: antiquewhite; font-size: larger; font-weight: bold; text-decoration: none;">
                Netflax
            </span>
        </a>
        <p class="text-sm text-gray-500 sm:ml-4 sm:pl-4 sm:border-l-2 sm:border-gray-200 sm:py-2 sm:mt-0 mt-4">
            © 2024 Netflax
        </p>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" 
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" 
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" 
        crossorigin="anonymous"></script>
<script src="{{ asset('js/script.js') }}"></script>
<!-- <script src="{{ asset('js/log_in.js') }}"></script> -->
<script src="https://kit.fontawesome.com/c939d0e917.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.0/flowbite.min.js"></script>
</body>
</html>
