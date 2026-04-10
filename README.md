# 📚 Hệ Thống Quản Lý Khóa Học & Bài Học (Laravel CMS)

Hệ thống quản trị (Admin Panel) cho phép quản lý danh sách khóa học, nội dung bài học chi tiết và học viên đăng ký. Dự án được xây dựng trên nền tảng Laravel với cấu trúc tối ưu, tách biệt component và giao diện hiện đại.

## ✨ Tính năng nổi bật

- **Quản lý Khóa học (CRUD):** Thêm, Sửa, Xóa và Tìm kiếm khóa học.
- **Quản lý Bài học:** Thêm bài học trực tiếp trong trang chi tiết khóa học, hỗ trợ sắp xếp thứ tự.
- **Tối ưu hóa UI/UX:**
  - Sidebar điều hướng chuyên nghiệp.
  - Tách biệt Blade Components (Alert, Badge, Table).
  - Giao diện Responsive (Bootstrap 5).
- **Xử lý Dữ liệu:** Tự động sinh Slug, Upload hình ảnh, Validation dữ liệu chặt chẽ qua Form Request.

## 🛠 Công nghệ sử dụng

- **Framework:** Laravel 10/11
- **Ngôn ngữ:** PHP 8.1+
- **Cơ sở dữ liệu:** MySQL
- **Frontend:** Bootstrap 5, Blade Template, Bootstrap Icons

## 🚀 Hướng dẫn cài đặt và chạy dự án

Làm theo các bước sau để thiết lập môi trường chạy dự án trên máy cục bộ của bạn:

### 1. Clone dự án
```bash
git clone [https://github.com/ten-cua-ban/ten-repository.git](https://github.com/ten-cua-ban/ten-repository.git)
cd ten-repository
### 2. Cài đặt các thư viện phụ thuộc (Dependencies)
composer install
npm install && npm run dev
### 3. Cấu hình môi trường (.env)
Mở file .env và cập nhật thông tin kết nối Cơ sở dữ liệu của bạn:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ten_database_cua_ban
DB_USERNAME=root
DB_PASSWORD=
### 4. Khởi tạo dự án
Chạy các lệnh Artisan sau để tạo khóa ứng dụng và cấu trúc bảng dữ liệu:
# Tạo khóa bảo mật cho ứng dụng
php artisan key:generate

# Chạy migration để tạo bảng trong database
php artisan migrate

# Tạo liên kết thư mục để hiển thị hình ảnh upload
php artisan storage:link
5. Chạy ứng dụng
Khởi động máy chủ ảo của Laravel:
php artisan serve