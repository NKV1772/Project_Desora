# 📚 **BÁO CÁO ĐỒ ÁN: THIẾT KẾ HỆ THỐNG DESORA**

> **Thiết kế hệ thống Thương Mại điện tử cho Desora: Dịch vụ thiết kế theo yêu cầu của khách hàng**

---

## 📋 **Mục lục**

1. [Trang bìa](00-Trang-Bia.md)
2. [Chương 1 - Giới thiệu](01-Gioi-Thieu.md)
3. [Chương 2 - Phân tích yêu cầu](02-Phan-Tich-Yeu-Cau.md)
4. [Chương 3 - Mô hình hóa hệ thống](03-Mo-Hinh-Hoa-He-Thong.md) ⭐
5. [Chương 4 - Thiết kế hệ thống](04-Thiet-Ke-He-Thong.md)
6. [Chương 5 - Demo & Báo cáo](05-Demo-Bao-Cao.md)
7. [Chương 6 - Kết luận và hướng phát triển](06-Ket-Luan-Huong-Phat-Trien.md)
8. [Chương 7 - Tài liệu tham khảo](07-Tai-Lieu-Tham-Khao.md)
9. [Phụ lục](Phu-Luc.md)

---

## 🎯 **Tổng quan**

Báo cáo này trình bày việc phân tích và thiết kế hệ thống **Desora** - một nền tảng Thương mại điện tử chuyên biệt cho dịch vụ thiết kế theo yêu cầu, kết nối Khách hàng với các Designer chuyên nghiệp.

### **Điểm nổi bật:**

* ✅ Phân tích đầy đủ 11 Functional Requirements và 8 Non-functional Requirements
* ✅ Mô hình hóa chi tiết với các biểu đồ UML (Activity, Use Case, Class, Sequence)
* ✅ Phân tích chi tiết **US-D04: Upload Draft & Receive Feedback**
* ✅ Thiết kế Database với ERD đầy đủ
* ✅ Kiến trúc Layered Architecture phù hợp với quy mô dự án

---

## 👥 **Thông tin nhóm**

**Nhóm**: 4 sinh viên

| Thành viên | Vai trò            | Chức năng phụ trách        |
| ---------- | ------------------ | -------------------------- |
| SV1        | Nhóm trưởng        | FR-03: Communication       |
| SV2        | Thành viên         | FR-01: Request Management  |
| SV3        | Thành viên         | FR-02: Catalog Management  |
| SV4        | Thành viên         | FR-04: Review & Rating     |

---

## 📖 **Cấu trúc tài liệu**

Báo cáo được chia thành các file markdown riêng biệt để dễ quản lý và chỉnh sửa:

```
Project_Desora/
├── README.md                    # File này
├── 00-Trang-Bia.md              # Trang bìa và mục lục
├── 01-Gioi-Thieu.md             # Chương 1: Giới thiệu
├── 02-Phan-Tich-Yeu-Cau.md      # Chương 2: Phân tích yêu cầu
├── 03-Mo-Hinh-Hoa-He-Thong.md   # Chương 3: Mô hình hóa (⭐ US-D04)
├── 04-Thiet-Ke-He-Thong.md      # Chương 4: Thiết kế hệ thống
├── 05-Demo-Bao-Cao.md           # Chương 5: Demo & Báo cáo
├── 06-Ket-Luan-Huong-Phat-Trien.md  # Chương 6: Kết luận
├── 07-Tai-Lieu-Tham-Khao.md     # Chương 7: Tài liệu tham khảo
└── Phu-Luc.md                   # Phụ lục
```

---

## ⭐ **Chức năng được phân tích chi tiết: US-D04**

**User Story**: "Là một Designer, tôi muốn tải lên các phiên bản bản nháp thiết kế và nhận phản hồi trực tiếp từ Khách hàng để quản lý quy trình chỉnh sửa có hệ thống."

**Các biểu đồ đã thiết kế:**
* ✅ Activity Diagram (BPMN)
* ✅ Use Case Diagram
* ✅ Use Case Specification (Main Flow, Alternate Flow, Exception Flow)
* ✅ Class Diagram
* ✅ Sequence Diagram

**Xem chi tiết tại**: [Chương 3 - Mô hình hóa hệ thống](03-Mo-Hinh-Hoa-He-Thong.md)

---

## 🛠️ **Công nghệ đề xuất**

### **Frontend:**
* React.js + TypeScript
* Tailwind CSS
* Redux Toolkit

### **Backend:**
* Node.js + Express hoặc Laravel
* PostgreSQL
* JWT Authentication

### **File Storage:**
* AWS S3 hoặc Cloudinary
* CDN cho static files

### **Deployment:**
* Vercel/Netlify (Frontend)
* Railway/Heroku (Backend)

---

## 📊 **Kiến trúc hệ thống**

Hệ thống được thiết kế theo **Layered Architecture (3-Tier)**:

```
Presentation Layer (Frontend)
    ↓
Business Logic Layer (Backend API)
    ↓
Data Layer (Database + Storage)
```

**Xem chi tiết tại**: [Chương 4 - Thiết kế hệ thống](04-Thiet-Ke-He-Thong.md)

---

## 📝 **Cách sử dụng tài liệu**

1. **Đọc tuần tự**: Bắt đầu từ [Trang bìa](00-Trang-Bia.md) và đọc theo thứ tự các chương
2. **Tham khảo nhanh**: Sử dụng mục lục để jump đến phần cần thiết
3. **Xem chi tiết US-D04**: Tập trung vào [Chương 3](03-Mo-Hinh-Hoa-He-Thong.md)
4. **Tham khảo kỹ thuật**: Xem [Phụ lục](Phu-Luc.md) cho PlantUML code, API endpoints, SQL schema

---

## 🔗 **Liên kết nhanh**

* [Trang bìa](00-Trang-Bia.md)
* [Giới thiệu](01-Gioi-Thieu.md)
* [Phân tích yêu cầu](02-Phan-Tich-Yeu-Cau.md)
* [Mô hình hóa hệ thống](03-Mo-Hinh-Hoa-He-Thong.md) ⭐
* [Thiết kế hệ thống](04-Thiet-Ke-He-Thong.md)
* [Demo & Báo cáo](05-Demo-Bao-Cao.md)
* [Kết luận](06-Ket-Luan-Huong-Phat-Trien.md)
* [Tài liệu tham khảo](07-Tai-Lieu-Tham-Khao.md)
* [Phụ lục](Phu-Luc.md)

---

## 📄 **License**

Tài liệu này được tạo cho mục đích học tập và nghiên cứu.

---

**Bắt đầu đọc**: [Trang bìa](00-Trang-Bia.md) →

