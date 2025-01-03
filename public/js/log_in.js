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

    try {
        const response = await fetch('http://127.0.0.1:8000/api/users/login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ username, password }),
        });

        const data = await response.json();

        if (response.ok) {
            // Xử lý khi đăng nhập thành công
            console.log("Đăng nhập thành công:", data);
            document.getElementById('loginFrame').classList.add('hidden');
            usernameInput.value = '';
            passwordInput.value = '';

        } else {
            // Xử lý lỗi từ server
            if (data.message.includes('User not found')) {
                usernameError.style.display = 'block';
            } else if (data.message.includes('Invalid password')) {
                passwordError.style.display = 'block';
            }
        }
    } catch (error) {
        console.error('Lỗi khi gọi API đăng nhập:', error);
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
        const response = await fetch('http://127.0.0.1:8000/api/users/create', {
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
        } else {
            // Tạo khung thông báo lỗi
            const errorMessage = data.message || "Có lỗi xảy ra.";
            const frame = document.createElement('div');
            frame.id = 'notificationFrame';
            frame.style.color = 'red';
            frame.style.marginTop = '10px';
            frame.textContent = errorMessage;
            // registerForm.appendChild(frame);
            confirmPasswordError.innerText = "User name or email already exists";
            confirmPasswordError.style.display = 'block';
            // Hiển thị lỗi cụ thể
            if (data.errors?.email) {
                emailError.style.display = 'block';
            }
            if (data.errors?.user_name) {
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
