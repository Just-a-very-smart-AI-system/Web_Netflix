// Lấy các phần tử form và nút
const loginForm = document.getElementById('loginForm');
const registerForm = document.getElementById('registerForm');
const closeBtn = document.getElementById('closeBtn');
const closeRegisterBtn = document.getElementById('closeRegisterBtn');

// Các phần tử của form đăng nhập
const usernameInput = document.getElementById('username');
const passwordInput = document.getElementById('password');
const usernameError = document.getElementById('usernameError');
const passwordError = document.getElementById('passwordError');

// Các phần tử của form đăng ký
const userNameInput = document.getElementById('user_name');
const emailInput = document.getElementById('email');
const registerPasswordInput = document.getElementById('register_password');
const confirmPasswordInput = document.getElementById('confirm_password');
const userNameError = document.getElementById('userNameError');
const emailError = document.getElementById('emailError');
const registerPasswordError = document.getElementById('registerPasswordError');
const confirmPasswordError = document.getElementById('confirmPasswordError');

// Định nghĩa các biến cục bộ cho các API
const LOGIN_API_URL = 'https://web-netflix.onrender.com/api/users/login';
const REGISTER_API_URL = 'https://web-netflix.onrender.com/api/users/create';
const HOME_PAGE_API = 'https://web-netflix.onrender.com/home';

// Mở form đăng ký
document.querySelector('.btn').addEventListener('click', () => {
    document.getElementById('loginFrame').classList.add('hidden');
    document.getElementById('registerFrame').classList.remove('hidden');
});

// Mở form đăng nhập
document.querySelector('.btn-red-sn').addEventListener('click', () => {
    document.getElementById('registerFrame').classList.add('hidden');
    document.getElementById('loginFrame').classList.remove('hidden');
});

// Đóng form đăng nhập
closeBtn.addEventListener('click', () => {
    document.getElementById('loginFrame').classList.add('hidden');
});

// Đóng form đăng ký
closeRegisterBtn.addEventListener('click', () => {
    document.getElementById('registerFrame').classList.add('hidden');
});


// Kiểm tra đăng nhập
loginForm.addEventListener('submit', async function (e) {
    e.preventDefault();

    // Lấy dữ liệu từ form
    const username = usernameInput.value.trim();
    const password = passwordInput.value.trim();

    // Reset lỗi
    usernameError.style.display = 'none';
    passwordError.style.display = 'none';


    // Kiểm tra nếu thông tin nhập vào trống
    if (!username || !password) {
        if (!username) {
            usernameError.innerText = "Username không được để trống.";
            usernameError.style.display = 'block';
        }
        if (!password) {
            passwordError.innerText = "Mật khẩu không được để trống.";
            passwordError.style.display = 'block';
        }
        return;
    }

    try {
        const response = await fetch(LOGIN_API_URL, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ username, password }),
        });

        const data = await response.json();

        if (response.ok) {
            console.log("Đăng nhập thành công:", data);
            document.getElementById('loginFrame').classList.add('hidden');
            usernameInput.value = '';
            passwordInput.value = '';
            redirectToHome(data.id);
        } else {
            if (data.error === 'User name or email not found') {
                usernameError.innerText = "Không tìm thấy username/email";
                usernameError.style.display = 'block';
            } else if (data.error === 'Invalid credentials') {
                passwordError.innerText = "Sai mật khẩu";
                passwordError.style.display = 'block';
            } else {
                // Xử lý lỗi khác từ API
                passwordError.innerText = "Không thể đăng nhập";
                passwordError.style.display = 'block';
            }
        }
    } catch (error) {
        console.error('Lỗi khi gọi API đăng nhập:', error);
        const generalError = document.createElement('div');
        generalError.id = 'notificationFrame';
        generalError.innerText = 'Không thể kết nối đến máy chủ. Vui lòng thử lại sau.';
        document.body.appendChild(generalError);
    }
});


// Kiểm tra đăng ký 
registerForm.addEventListener('submit', async function (e) {
    e.preventDefault();

    // Lấy dữ liệu từ form
    const userName = userNameInput.value.trim();
    const email = emailInput.value.trim();
    const password = registerPasswordInput.value.trim();
    const confirmPassword = confirmPasswordInput.value.trim();

    // Reset lỗi
    userNameError.style.display = 'none';
    emailError.style.display = 'none';
    registerPasswordError.style.display = 'none';
    confirmPasswordError.style.display = 'none';

    // Reset thông báo lỗi
    const notificationFrame = document.getElementById('notificationFrame');
    if (notificationFrame) {
        notificationFrame.remove();
    }

    if (password !== confirmPassword) {
        confirmPasswordError.innerText = "Mật khẩu không khớp";
        confirmPasswordError.style.display = 'block';
        return;
    }

    try {
        const response = await fetch(REGISTER_API_URL, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ user_name: userName, email, password }),
        });

        const data = await response.json();

        if (response.ok) {
            // Xử lý khi đăng ký thành công
            console.log("Đăng ký thành công:", data);
            document.getElementById('registerFrame').classList.add('hidden');
            userNameInput.value = '';
            emailInput.value = '';
            registerPasswordInput.value = '';
            confirmPasswordInput.value = '';
            redirectToHome(data.id);
        } else {
            confirmPasswordError.innerText = "Username hoặc email đã tồn tại";
            confirmPasswordError.style.display = 'block';
            // Hiển thị lỗi cụ thể
            if (data.errors == 409) {
                emailError.style.display = 'block';
                userNameError.style.display = 'block';
            }
        }
    } catch (error) {
        console.error('Lỗi khi gọi API đăng ký:', error);

        // Tạo khung thông báo lỗi cho lỗi kết nối
        const frame = document.createElement('div');
        frame.id = 'notificationFrame';
        frame.style.color = 'red';
        frame.style.marginTop = '10px';
        frame.textContent = 'Không thể kết nối đến server. Vui lòng thử lại.';
        registerForm.appendChild(frame);
    }
});

function redirectToHome(user_id) {
    window.location.href = `${HOME_PAGE_API}?user_id=${user_id}`
}
