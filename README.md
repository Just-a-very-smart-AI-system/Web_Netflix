Ứng dụng xem traller trực tuyến Netflax
Link: https://web-netflix.onrender.com
1.	Giao diện trang đăng nhập

 
![image](https://github.com/user-attachments/assets/38d7c36d-8760-4d91-9cca-e77b8f529dac)

- Header (Thanh điều hướng trên cùng)
+ Logo "NETFLIX" nổi bật màu đỏ ở góc trái, giúp nhận diện thương hiệu.
+ Hai nút "Sign up" và "Sign In" ở góc phải, giúp người dùng dễ dàng đăng ký hoặc đăng nhập.
+ Nền đen giúp tạo sự tương phản với nội dung và giữ giao diện tối giản, hiện đại.
- Phần chính (Hero Section - Phần trung tâm)
+ Hình nền là một tập hợp các poster phim nổi bật, tạo cảm giác phong phú về nội dung.
+ Tiêu đề lớn: "Unlimited movies, TV shows and more", nhấn mạnh lợi ích chính của Netflix.
+ Dòng mô tả nhỏ: "Watch anywhere. Cancel anytime.", giúp người dùng hiểu rằng dịch vụ có thể sử dụng linh hoạt.
+ Một lời kêu gọi hành động: "Ready to watch? Enter your email to create or restart your membership.", hướng người dùng đến bước đăng ký.
- Form nhập email và nút "Get Started >"
+ Ô nhập email có placeholder "Email address" giúp người dùng biết cần nhập gì.
+ Nút "Get Started >" màu đỏ nổi bật, kêu gọi hành động mạnh mẽ.
2.	Đăng ký và đăng nhập
  
 
![image](https://github.com/user-attachments/assets/35bfae09-98f6-4be7-a28e-503239ad5e52)






- Cấu trúc đăng nhập:
+ Email hoặc Username: Người dùng có thể nhập tài khoản của mình bằng email hoặc tên đăng nhập.
+ Mật khẩu: Dữ liệu được ẩn dưới dạng dấu • để đảm bảo bảo mật.
- Nút hành động:
+ "Đăng Nhập" (màu đỏ) là nút chính để gửi thông tin đăng nhập.
+ "Đóng" (màu tối) giúp người dùng thoát khỏi form mà không cần đăng nhập.
- Khi đăng nhập nếu người dùng nhập sai mật khẩu hoặc username thì sẽ được thông báo là '‘sai mật khẩu hoặc username'’. Nếu không tìm thấy username thì hiển thị thông báo '‘không tồn tại username'’.
- Cấu trúc đăng ký:
+ Tên Người Dùng: Nhập username cá nhân.
+ Email: Địa chỉ email để liên kết tài khoản.
+ Mật khẩu: Nhập mật khẩu an toàn.
+ Nhập lại Mật khẩu: Đảm bảo người dùng nhập đúng mật khẩu mong muốn.
-  Nút hành động:
+ "Đăng Ký" (màu đỏ) là nút chính để tạo tài khoản.
+ "Đóng" giúp thoát khỏi form mà không cần đăng ký.
- Trong phần đăng ký tài khoản cũng hoạt động tương tự với đăng nhập. Khi người dùng nhập 1 username hoặc email đã được dùng thì sẽ nhận 1 thông báo '‘trùng username hoặc email'’ và khi nhập mật khẩu không khớp cũng sẽ nhận lại 1 thông báo là '‘mật khẩu không trùng khớp'’. Điều này giúp người dùng có trải nghiệm tốt hơn và không bị trùng tài khoản với người khác.
 
3.	Giao diện trang chủ:
  
  ![image](https://github.com/user-attachments/assets/b38bf4c0-f904-4696-a6a2-91a86eb86cd7)

 
 - Giao diện trang chủ được chia thành các thể loại phim hiển thị theo chiều ngang. Mỗi phim được thể hiện dưới dạng 1 banner của phim đó và khi người dùng di chuyển chuột vào sẽ hiện ra 1 nút xem và 1 nút trái tim để thêm vào danh sách yêu thích.
- Các thể loại phim rất đa dạng như trending, top rate, action, adventure,… Và ở cuối trang có danh sách phim đã xem và phim yêu thích của người dùng.
 
 
- Khi chúng ta ấn vào nút xem trên phim thì sẽ hiển thị ra 1 cửa sổ pop-up chứa traller của phim được lấy từ youtube.
- 
![image](https://github.com/user-attachments/assets/9f6c99a7-3cff-474d-a93b-63d4cab21460)

4. 	Mô hình cơ sở dữ liệu

 
- Hệ thống cơ sở dữ liệu của dự án "Netflax" được thiết kế nhằm hỗ trợ quản lý thông tin người dùng, phim và các hoạt động tương tác của người dùng trên nền tảng. Mô hình này bao gồm các bảng chính sau:
+ users: Lưu trữ thông tin tài khoản người dùng (username, password, email).
+ movies: Chứa thông tin về các bộ phim, bao gồm tên và đường dẫn URL trailer.
+ categories: Danh mục các thể loại phim.
+ movie_category: Liên kết giữa phim và danh mục, thể hiện một bộ phim có thể thuộc nhiều thể loại.
+ history: Lưu lịch sử xem phim của người dùng.
+ favorite: Quản lý danh sách yêu thích của người dùng đối với các bộ phim.
+ sessions: Lưu trữ thông tin phiên làm việc của người dùng, phục vụ việc xác thực.
- Mô hình cơ sở dữ liệu được thiết kế theo chuẩn hóa nhằm đảm bảo tính toàn vẹn dữ liệu, hỗ trợ mở rộng và truy vấn hiệu quả trong quá trình vận hành hệ thống.
![image](https://github.com/user-attachments/assets/14a9b197-9755-491d-a5f4-9434f4b641c8)


5.	Biểu đồ hoạt động

 ![image](https://github.com/user-attachments/assets/7826fef1-04c5-4b1f-8554-e204e5c8cf44)

-  Người dùng chọn "Tạo tài khoản".
+ Nhập thông tin tài khoản.
+  Hệ thống kiểm tra tài khoản đã tồn tại chưa.
- Nếu đã tồn tại, hiển thị thông báo "Trùng tài khoản" → Quay lại bước nhập thông tin.
- Nếu chưa tồn tại, tiếp tục bước tiếp theo.
+ Hệ thống kiểm tra mật khẩu nhập vào có đúng không.
+Nếu mật khẩu nhập lại không khớp, hiển thị thông báo lỗi "Nhập không trùng mật khẩu" → Quay lại bước nhập thông tin.
- Nếu đúng, tài khoản được tạo thành công, chuyển đến trang chủ.
- Người dùng chọn "Đăng nhập".
+ Nhập thông tin tài khoản (tên đăng nhập & mật khẩu).
+ Hệ thống kiểm tra thông tin đăng nhập.
- Nếu đúng, chuyển đến trang chủ.
+ Nếu sai, hiển thị thông báo "Sai thông tin đăng nhập" → Quay lại nhập thông tin.
- Từ trang chủ, người dùng có thể:
+ Xem trailer phim.
+ Xem danh sách yêu thích và lịch sử xem
6. Sơ đồ UseCase
  
![image](https://github.com/user-attachments/assets/471c168e-1de5-4ce2-9d50-6bc943e8dcd0)


- Hệ thống là một trang web xem trailer phim, có hai loại người dùng chính:
+ Người dùng (User): Có thể đăng ký, đăng nhập, xem trailer và lưu danh sách yêu thích.
+ Quản trị viên (Admin): Quản lý trailer, chỉnh sửa nội dung, xóa trailer và quản lý tài khoản người dùng.
7.	Cách triển khai hệ thống web online
- Render Nền tảng triển khai web:
+ Render là một nền tảng PaaS (Platform as a Service) giúp triển khai ứng dụng web một cách dễ dàng. So với các nền tảng khác như Heroku, Render cung cấp hosting miễn phí cho web services, databases và có hỗ trợ tích hợp CI/CD.
+ Mặc dù vậy Render lại không hỗ trợ trực tiếp php nên chúng ta sẽ phải cài đặt các môi trường cần thiết cho php thông quan Docker. Ở đây việc sử dụng dockerfile là 1 cách tốt nhất để render có thể hiểu và cài đặt môi trường như vendor, artisan, blade, ...
- Lợi ích khi sử dụng Render:
+ Triển khai đơn giản: Chỉ cần push code lên GitHub, Render tự động build và deploy.
+ Hỗ trợ nhiều công nghệ: PHP, Node.js, Python, Docker, PostgreSQL, MySQL, v.v.
+ Miễn phí với tài khoản cá nhân: Render cho phép deploy miễn phí với hạn mức nhất định.
- Cách triển khai Laravel trên Render:
+ Push mã nguồn lên GitHub.
+ Tạo một dịch vụ web mới trên Render, chọn framework PHP.
+ Cấu hình các biến môi trường (.env) như database, API keys.
+ Kết nối với database (MySQL trên Freesqldatabase hoặc PostgreSQL trên Render).
+ Render tự động build và chạy ứng dụng.

8.	Công cụ lưu trữ database online- Freesqldatabase:
- Freesqldatabase là một dịch vụ MySQL hosting miễn phí giúp lưu trữ dữ liệu mà không cần phải tự cấu hình server. Điều này rất tiện lợi khi triển khai ứng dụng trên các nền tảng như Render.
- Sau khi đăng ký thành công, bạn sẽ nhận được các thông tin sau:
+ Hostname: (ví dụ: sql12.freesqldatabase.com)
+ Database name: (ví dụ: sql12345678)
+ Username: (ví dụ: sqluser1234)
+ Password: (được cấp khi đăng ký)
+ Port: 3306 (mặc định của MySQL)
- Các thông tin trên sẽ được dùng để chỉnh sửa các biến môi trường liên quan đến cơ sở sữ liệu của project. Khi kết nối thành công trang web của chúng ta có thể hoạt động online một cách trơn chu và hiệu quả nhất.

 

