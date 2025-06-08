# VibeTalk\_PHP

[![PHP](https://img.shields.io/badge/Backend-PHP-777bb4.svg)](https://www.php.net/)
[![HTML5](https://img.shields.io/badge/HTML5-CSS3-JS-yellow.svg)]()
[![WebSocket](https://img.shields.io/badge/Realtime-WebSocket%20or%20AJAX-blue.svg)]()
[![License: MIT](https://img.shields.io/badge/License-MIT-lightgrey.svg)](LICENSE)

---

## 💬 Overview

**VibeTalk\_PHP** là ứng dụng chat realtime đơn giản, sử dụng PHP thuần kết hợp HTML/CSS/JS ở frontend.
![image](https://github.com/user-attachments/assets/32d459c8-42f2-41cf-a2ae-1717a3221275)

* **Không dùng framework phức tạp**
* Đăng ký, đăng nhập bằng session PHP
* Chat realtime 1-1 (bằng WebSocket nếu có, hoặc AJAX polling)
* Giao diện responsive bằng HTML + CSS
* Lưu user/message trong MySQL hoặc file (tùy version)
* Dễ deploy trên mọi hosting hỗ trợ PHP

---

## 🚀 Features

* Đăng ký, đăng nhập tài khoản
* Chat 1-1 realtime (AJAX hoặc WebSocket)
* Hiển thị danh sách user online
* Giao diện động bằng HTML, CSS, JavaScript
* Lưu lịch sử tin nhắn (MySQL/file)
* Không group chat, không upload file (phiên bản practice)

---

## 🏗️ Architecture

```
[ Browser (HTML/CSS/JS) ]
     ↑         ↓
 WebSocket* hoặc AJAX polling
     ↑         ↓
[ PHP backend (session, REST endpoint, hoặc Ratchet WS) ] ←→ [ MySQL hoặc file ]
```

> (\*) Nếu bạn dùng Ratchet hoặc Swoole thì có WebSocket thật. Nếu chưa, dùng AJAX polling lấy tin nhắn mới.

---

## 📂 Folder Structure

```
VibeTalk_PHP/
├── css/            # Giao diện
├── js/             # Logic chat, AJAX/WebSocket
├── includes/       # PHP helper (connect db, auth...)
├── chat.php        # Trang chat chính
├── login.php       # Trang login
├── register.php    # Trang đăng ký
├── message_api.php # Endpoint AJAX lấy/gửi tin nhắn
└── ...             # Các file khác
```

---

## ⚡ Quick Start

1. **Clone repo**

   ```bash
   git clone https://github.com/vinhvrs/VibeTalk_PHP.git
   cd VibeTalk_PHP
   ```

2. **Cấu hình MySQL** (nếu dùng DB)

   * Import file `vibetalk.sql` (nếu có)
   * Sửa `includes/config.php` hoặc file kết nối DB cho đúng user/pass

3. **Chạy trên localhost hoặc upload lên hosting hỗ trợ PHP**

   * Start Apache/nginx + PHP, truy cập `http://localhost/VibeTalk_PHP/login.php`

4. **Đăng ký tài khoản, đăng nhập và chat**

---

## 👨‍💻 Technical Notes

* Nếu dùng WebSocket:

  * Backend có thể chạy Ratchet/Swoole (PHP WebSocket server), JS connect bằng native WebSocket
* Nếu dùng AJAX polling:

  * JS sẽ gọi `message_api.php` để lấy tin nhắn mới mỗi X giây
* Các file PHP chính:

  * `login.php`, `register.php`, `chat.php`
  * `includes/auth.php`, `includes/db.php`
  * `message_api.php`: endpoint gửi/nhận message dạng JSON

---

## 🔒 Security

* Xác thực session PHP (bảo vệ chat.php không cho user chưa login)
* Escape dữ liệu (chống XSS), kiểm tra quyền gửi/nhận message
* Không có OAuth, JWT (practice version)

---

## 📄 License

MIT License © [VinhVRS](https://github.com/vinhvrs)

---

> **Đây là project practice PHP thuần, phục vụ học tập về chat realtime & session! Nếu muốn nâng cấp hoặc gặp vấn đề hãy mở issue hoặc star repo nhé!**

