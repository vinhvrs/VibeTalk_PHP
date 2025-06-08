# VibeTalk

[![Java](https://img.shields.io/badge/Java-EE-orange.svg)](https://jakarta.ee/)
[![JSP](https://img.shields.io/badge/Frontend-JSP-blueviolet.svg)](https://www.oracle.com/java/technologies/jspt.html)
[![WebSocket](https://img.shields.io/badge/Realtime-WebSocket-blue.svg)]()
[![HTML5](https://img.shields.io/badge/HTML5-CSS3-JS-yellow.svg)]()
[![License: MIT](https://img.shields.io/badge/License-MIT-lightgrey.svg)](LICENSE)

---

## 💬 Overview

**VibeTalk** là một ứng dụng chat realtime đơn giản, sử dụng **JSP/Servlet**, **WebSocket API** thuần Java, và frontend **HTML, CSS, JavaScript**.

![VibeTalk](https://github.com/user-attachments/assets/20a7657b-be74-4ad2-a04a-cdae20f14648)

* Không dùng Spring, không dùng framework backend phức tạp
* Chạy trên Tomcat hoặc server Java EE bất kỳ
* Giao diện viết bằng HTML/CSS/JS và JSP thuần
* Đăng ký, đăng nhập, chat 1-1 realtime (WebSocket)
* Lưu user/message có thể dùng file hoặc in-memory (nếu chưa có DB)

---

## 🚀 Features

* Đăng ký, đăng nhập tài khoản (session cookie)
* Chat realtime giữa hai user (WebSocket)
* Xem danh sách user online
* Giao diện chat động (HTML+JS)
* Không có group chat, không upload file (practice version)
* Lưu lịch sử có thể là file hoặc memory (nếu cần)

---

## 🏗️ Architecture

```
[Browser (JSP/HTML/JS)] ←→ [Servlet Java, WebSocket endpoint] ←→ [In-memory store/File]
```

* JSP render giao diện, JS mở WebSocket, gửi/nhận tin nhắn
* Servlet xử lý login/register, WebSocket endpoint xử lý message
* Dữ liệu user/message có thể chỉ lưu memory hoặc file

---

## 📂 Folder Structure

```
src/
├── main/
│   ├── java/
│   │   ├── controller/      # Servlet & WebSocket endpoint
│   │   ├── model/           # User, Message POJO
│   │   └── util/            # Helper (nếu có)
│   └── webapp/
│       ├── css/
│       ├── js/
│       └── WEB-INF/views/   # JSP files (login.jsp, chat.jsp, userlist.jsp)
```

---

## ⚡ Quick Start

1. **Clone repo**

   ```bash
   git clone https://github.com/vinhvrs/VibeTalk.git
   cd VibeTalk
   ```

2. **Mở bằng IDE hỗ trợ Java EE (IntelliJ, Eclipse...)**

   * Cấu hình project dạng **Dynamic Web Project** hoặc Maven Webapp

3. **Chạy trên Tomcat/Glassfish...**

   * Deploy folder `src/main/webapp` lên Tomcat
   * Hoặc dùng Maven plugin:

     ```bash
     mvn clean package
     mvn tomcat7:run
     ```
   * Truy cập: [http://localhost:8080/VibeTalk/](http://localhost:8080/VibeTalk/)

4. **Đăng ký, đăng nhập, chat realtime**

---

## 👨‍💻 Technical Notes

* **WebSocket endpoint:** `/ws/chat` (có thể config lại)
* **JSP pages:** login.jsp, chat.jsp, userlist.jsp
* **Servlet chính:** LoginServlet, ChatServlet, WebSocketEndpoint
* **Không sử dụng framework backend (Spring, Hibernate, v.v.)**
* **Lưu dữ liệu:**

  * Tạm thời in-memory (HashMap, List)
  * Có thể mở rộng lưu file text hoặc tích hợp DB sau

---

## 🔒 Security

* Xác thực session bằng HttpSession Java EE
* Không có JWT/OAuth (practice)
* Các servlet kiểm tra session cho page cần bảo vệ

---

## 📄 License

MIT License © [VinhVRS](https://github.com/vinhvrs)

---

> **Project này phục vụ học tập, trình diễn kỹ thuật cơ bản JSP/Servlet/WebSocket! Nếu muốn nâng cấp hãy fork hoặc góp ý nhé!**

