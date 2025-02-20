<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/favicon_package/apple-touch-icon.png') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/Log_in.css') }}">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.0/flowbite.min.css" rel="stylesheet">
    <script src="{{ asset('js/log_in.js') }}" defer></script>
    <title>Netflax</title>
</head>



<body>
    <div class="main">
        <nav>
            <span><img width="180" src="{{asset('images/logo.svg') }}" alt=""></span>
            <div>
                <button class="btn">Sign up</button>
                <button class="btn btn-red-sn">Sign In</button>
            </div>
        </nav>

        <!-- Frame Đăng Nhập -->
        <div id="loginFrame" class="hidden">
            <div class="frame-content">
                <p>Đăng Nhập</p>
                <form id="loginForm">
                    <div class="form-group">
                        <label for="username">Email hoặc Username:</label>
                        <input type="text" id="username" class="form-control" name="username" placeholder="Nhập email hoặc username" required>
                        <div id="usernameError" class="error-message hidden">Không tìm thấy username/email</div>
                    </div>
                    <div class="form-group">
                        <label for="password">Mật khẩu:</label>
                        <input type="password" id="password" class="form-control" name="password" placeholder="Nhập mật khẩu" required>
                        <div id="passwordError" class="error-message hidden">Sai mật khẩu</div>
                    </div>
                    <button type="submit" class="btn1 btn1-red btn-block">Đăng Nhập</button>
                    <button type="button" id="closeBtn" class="btn1 btn1-secondary btn-block">Đóng</button>
                </form>
            </div>
        </div>

        <!-- Frame Đăng Ký -->
        <div id="registerFrame" class="hidden">
            <div class="frame-content">
                <p>Đăng Ký</p>
                <form id="registerForm">
                    <div class="form-group">
                        <label for="user_name">Tên Người Dùng:</label>
                        <input type="text" id="user_name" class="form-control" name="user_name" placeholder="Nhập tên người dùng" required>
                        <div id="userNameError" class="error-message hidden">Tên người dùng không hợp lệ</div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" class="form-control" name="email" placeholder="Nhập email" required>
                        <div id="emailError" class="error-message hidden">Email không hợp lệ</div>
                    </div>
                    <div class="form-group">
                        <label for="register_password">Mật khẩu:</label>
                        <input type="password" id="register_password" class="form-control" name="register_password" placeholder="Nhập mật khẩu" required>
                        <div id="registerPasswordError" class="error-message hidden">Mật khẩu không hợp lệ</div>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Nhập lại Mật khẩu:</label>
                        <input type="password" id="confirm_password" class="form-control" name="confirm_password" placeholder="Nhập lại mật khẩu" required>
                        <div id="confirmPasswordError" class="error-message hidden">Mật khẩu không khớp</div>
                    </div>
                    <button type="submit" class="btn1 btn1-red btn-block">Đăng Ký</button>
                    <button type="button" id="closeRegisterBtn" class="btn1 btn1-secondary btn-block">Đóng</button>
                </form>
            </div>
        </div>

        <div class="box"></div>
        <div class="hero" style="background-image: url('{{ asset('images/bg_img.jpg') }}');">
            <h1>Unlimited movies, TV shows and more</h1>
            <p>Watch anywhere. Cancel anytime.</p>
            <span>Ready to watch? Enter your email to create or restart your membership.</span>

            <div class="hero-btns">
                <input type="text" placeholder="Email address" style="color: white;">
                <button class="btn btn-red">Get Started &gt;</button>
            </div>
        </div>

        <div class="separation"></div>
    </div>

    <section class="first">
        <div>
            <h1>Enjoy on your TV</h1>
            <p>Watch on smart TVs, PlayStation, Xbox, Chromecast, Apple TV, Blu-ray players and more.</p>
        </div>
        <div class="sec-img">
            <img src="{{ asset('images/tv.jpg') }}" alt="">
            <video src="{{ asset('images/video2.m4v') }}" autoplay loop muted></video>
        </div>
    </section>

    <div class="separation"></div>

    <section class="first second">
        <div class="sec-img">
            <img src="{{ asset('images/img3.jpg') }}" alt="">
        </div>
        <div>
            <h1>Download your shows to watch offline</h1>
            <p>Save your favourites easily and always have something to watch.</p>
        </div>
    </section>

    <div class="separation"></div>

    <section class="first third">
        <div>
            <h1>Watch everywhere</h1>
            <p>Stream unlimited movies and TV shows on your phone, tablet, laptop, and TV.</p>
        </div>
        <div class="sec-img3">
            <img src="{{ asset('images/img1.jpg') }}" alt="">
            <video src="{{ asset('images/video1.m4v') }}" autoplay loop muted></video>
        </div>
    </section>

    <div class="separation"></div>

    <section class="first forth">
        <div class="sec-img">
            <img src="{{ asset('images/img2.jpg') }}" alt="">
        </div>
        <div>
            <h1>Create profiles for kids</h1>
            <p>Send children on adventures with their favourite characters in a space made just
                for them—free with your membership.</p>
        </div>
    </section>

    <div class="separation"></div>

    <section class="faq">
        <h1>Frequently Asked Questions</h1>
        <div class="faq-box">
            <span>What is Netflax?</span>
        </div>
        <div class="faq-box">
            <span>How much does Netflax cost?</span>
        </div>
        <div class="faq-box">
            <span>Where can I watch?</span>
        </div>
        <div class="faq-box">
            <span>How do I cancel?</span>
        </div>
        <div class="faq-box">
            <span>What can I watch on Netflax?</span>
        </div>
        <div class="faq-box">
            <span>Is Netflax good for kids?</span>
        </div>

        <p>Ready to watch? Enter your email to create or restart your membership</p>
    </section>

    <div class="separation"></div>

    <footer>
        <div class="call">
            Questions? Call 000-800-919-1694
        </div>
        <div class="footer">
            <div class="footer-item">
                <a href="faq">FAQ</a>
                <a href="faq">Investor Relations</a>
                <a href="faq">Privacy</a>
                <a href="faq">Speed Test</a>
                <p>Netflax</p>
            </div>
            <div class="footer-item">
                <a href="faq">Help Centre</a>
                <a href="faq">Jobs</a>
                <a href="faq">Cookie Preferences</a>
                <a href="faq">Legal Notices</a>
            </div>
            <div class="footer-item">
                <a href="faq">Account</a>
                <a href="faq">Ways to Watch</a>
                <a href="faq">Corporate Information</a>
                <a href="faq">Only on Netflax</a>
            </div>
            <div class="footer-item">
                <a href="faq">Media Centre</a>
                <a href="faq">Terms of Use</a>
                <a href="faq">Contact Us</a>
            </div>
        </div>
    </footer>
</body>

</html>
