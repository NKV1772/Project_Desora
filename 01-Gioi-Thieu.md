# **1. Giới thiệu (Introduction)**

---

## **1.1. Lý do chọn đề tài**

Trong bối cảnh số hóa hiện đại, nhu cầu về dịch vụ thiết kế theo yêu cầu ngày càng tăng cao. Các doanh nghiệp, cá nhân và tổ chức thường xuyên cần các sản phẩm thiết kế chuyên nghiệp như logo, banner, website, bao bì sản phẩm, và nhiều loại hình thiết kế khác. Tuy nhiên, việc tìm kiếm và làm việc với các Designer phù hợp vẫn còn nhiều khó khăn:

* **Khó khăn trong tìm kiếm Designer**: Khách hàng khó tìm được Designer có phong cách và kỹ năng phù hợp với nhu cầu
* **Quy trình làm việc không chuẩn hóa**: Quy trình giao tiếp và chỉnh sửa giữa Khách hàng và Designer thiếu hệ thống, dễ gây hiểu lầm
* **Thiếu nền tảng trung gian**: Thiếu nền tảng trung gian để quản lý yêu cầu, báo giá, thanh toán và đánh giá dịch vụ một cách minh bạch

### **Giải pháp: Hệ thống Desora**

**Desora** là một nền tảng Thương mại điện tử (E-commerce) chuyên biệt cho dịch vụ thiết kế theo yêu cầu, kết nối Khách hàng với các Designer chuyên nghiệp. Hệ thống cung cấp:

#### **Giá trị cho Khách hàng:**
* Dễ dàng tìm kiếm và thuê Designer phù hợp
* Theo dõi tiến độ dự án minh bạch
* Giao tiếp trực tiếp và hiệu quả với Designer
* Đánh giá chất lượng dịch vụ để xây dựng cộng đồng chất lượng

#### **Giá trị cho Designer:**
* Quản lý công việc hiệu quả và có hệ thống
* Xây dựng portfolio chuyên nghiệp
* Nhận phản hồi trực tiếp từ khách hàng
* Phát triển danh tiếng và uy tín trong cộng đồng

#### **Giá trị cho nền tảng:**
* Tạo hệ sinh thái minh bạch, đáng tin cậy cho thị trường dịch vụ thiết kế
* Quản lý chất lượng dịch vụ thông qua hệ thống đánh giá
* Tạo môi trường cạnh tranh lành mạnh

### **Đối tượng người dùng:**

* **Khách hàng (Customer)**: Các cá nhân, doanh nghiệp cần dịch vụ thiết kế
* **Designer**: Các nhà thiết kế chuyên nghiệp cung cấp dịch vụ
* **Admin/Marketing**: Quản trị viên và nhân viên marketing quản lý hệ thống

---

## **1.2. Mục tiêu nghiên cứu**

### **Mục tiêu tổng quát:**

Nghiên cứu, phân tích và thiết kế hệ thống Thương mại điện tử Desora nhằm kết nối Khách hàng với Designer, hỗ trợ quy trình từ yêu cầu thiết kế đến hoàn thành dự án, đảm bảo tính minh bạch, hiệu quả và trải nghiệm người dùng tốt.

### **Mục tiêu cụ thể:**

1. **Phân tích yêu cầu hệ thống**: Phân tích yêu cầu người dùng và xác định các chức năng chính của hệ thống Desora dựa trên User Stories
2. **Mô hình hóa hệ thống**: Thiết kế các mô hình Use Case, Class, Sequence, Activity Diagram để mô tả logic nghiệp vụ
3. **Thiết kế cơ sở dữ liệu**: Thiết kế cơ sở dữ liệu quan hệ (ERD) hỗ trợ các nghiệp vụ quản lý yêu cầu, báo giá, giao tiếp và đánh giá
4. **Thiết kế giao diện**: Xây dựng giao diện người dùng (UI) thân thiện cho cả Khách hàng và Designer
5. **Thiết kế kiến trúc**: Trình bày kiến trúc hệ thống (System Architecture) theo hướng Layered Architecture
6. **Phát triển prototype**: Phát triển prototype website để demo các chức năng chính

---

## **1.3. Phạm vi hệ thống**

### **Phạm vi bao gồm:**

* ✅ **Quản lý tài khoản người dùng**: Đăng ký, đăng nhập, quản lý hồ sơ cho Khách hàng, Designer, Admin
* ✅ **Quản lý yêu cầu thiết kế**: Khách hàng gửi yêu cầu, Designer xem và báo giá, Admin theo dõi
* ✅ **Quản lý danh mục Portfolio**: Designer upload tác phẩm, Khách hàng xem và lọc, Admin duyệt
* ✅ **Hệ thống giao tiếp**: Chat, comment trên bản nháp, thông báo tự động
* ✅ **Hệ thống đánh giá**: Khách hàng đánh giá Designer sau khi hoàn thành dự án
* ✅ **Quản lý thanh toán**: Thanh toán khi báo giá được chấp nhận, hoàn tiền nếu cần
* ✅ **Dashboard quản trị**: Quản lý users, duyệt nội dung, analytics
* ✅ **Hệ thống khuyến mãi**: Tạo và quản lý mã giảm giá, chương trình khuyến mãi

### **Phạm vi không bao gồm:**

* ❌ **Công cụ thiết kế trực tuyến**: Designer sử dụng công cụ bên ngoài (Photoshop, Illustrator, Figma...)
* ❌ **Tích hợp thanh toán phức tạp**: Chỉ mô phỏng quy trình thanh toán, không tích hợp thực tế với các cổng thanh toán
* ❌ **Hệ thống AI tự động thiết kế**: Không có chức năng AI tự động tạo thiết kế
* ❌ **Ứng dụng mobile native**: Chỉ tập trung vào website, không phát triển app iOS/Android riêng

---

## **1.4. Cấu trúc báo cáo**

Báo cáo được chia thành các phần chính:

1. **Giới thiệu**: Lý do chọn đề tài, mục tiêu và phạm vi hệ thống
2. **Phân tích yêu cầu**: Bài toán, yêu cầu chức năng và phi chức năng dựa trên User Stories
3. **Mô hình hóa hệ thống**: Activity Diagram, Use Case Diagram, Class Diagram, Sequence Diagram (tập trung vào US-D04)
4. **Thiết kế hệ thống**: Kiến trúc Layered Architecture, Database Design, UI/UX Design
5. **Demo & Báo cáo**: Prototype website và màn hình demo
6. **Kết luận và hướng phát triển**: Tóm tắt kết quả và đề xuất hướng phát triển
7. **Tài liệu tham khảo**: Các nguồn tài liệu đã sử dụng
8. **Phụ lục**: PlantUML code, API endpoints, nhật ký làm việc nhóm

---

**Trang trước**: [Trang bìa](00-Trang-Bia.md) | **Trang tiếp theo**: [Chương 2 - Phân tích yêu cầu](02-Phan-Tich-Yeu-Cau.md)

