# **2. Phân tích yêu cầu (Requirement Analysis)**

---

## **2.1. Mô tả bài toán (Problem Statement)**

### **Vấn đề hiện tại:**

Thị trường dịch vụ thiết kế theo yêu cầu đang phát triển mạnh nhưng thiếu một nền tảng trung gian chuyên nghiệp để kết nối Khách hàng và Designer. Các vấn đề chính:

#### **1. Khó khăn trong tìm kiếm Designer**
* Khách hàng phải tìm kiếm thủ công qua mạng xã hội, website cá nhân
* Không có tiêu chuẩn đánh giá rõ ràng
* Khó so sánh chất lượng và giá cả giữa các Designer

#### **2. Quy trình làm việc không chuẩn hóa**
* Giao tiếp qua email, chat riêng lẻ, dễ mất thông tin
* Khó theo dõi tiến độ dự án
* Thiếu hệ thống quản lý version của bản nháp
* Không có cơ chế lưu trữ lịch sử giao tiếp

#### **3. Thiếu minh bạch trong báo giá và thanh toán**
* Không có cơ chế bảo vệ quyền lợi cho cả hai bên
* Rủi ro trong thanh toán (trả trước/trả sau)
* Khó giải quyết tranh chấp

#### **4. Khó quản lý Portfolio**
* Designer khó thể hiện năng lực một cách có hệ thống
* Khách hàng khó tìm kiếm và lọc Designer theo phong cách

### **Giải pháp đề xuất:**

Hệ thống Desora cung cấp nền tảng trung gian với các tính năng:

* **Quản lý yêu cầu tập trung**: Khách hàng gửi yêu cầu chi tiết, Designer xem và báo giá, tất cả được lưu trữ trong hệ thống
* **Giao tiếp có hệ thống**: Chat, comment trên bản nháp, thông báo tự động, lưu trữ lịch sử
* **Quản lý tiến độ**: Trạng thái rõ ràng cho từng giai đoạn dự án (Chờ Báo giá, Đang Thiết kế, Chờ Phản hồi, Đã Duyệt...)
* **Đánh giá và xếp hạng**: Hệ thống đánh giá giúp xây dựng uy tín và giúp khách hàng lựa chọn
* **Quản lý Portfolio**: Designer showcase tác phẩm, Khách hàng tham khảo trước khi quyết định

---

## **2.2. Các yêu cầu chức năng (Functional Requirements)**

Dựa trên User Stories đã phân tích, hệ thống có các yêu cầu chức năng chính:

| ID    | Requirement                | Mô tả (Description)                                                                                    | User Stories liên quan |
| ----- | -------------------------- | ------------------------------------------------------------------------------------------------------- | ---------------------- |
| FR-01 | Request Management         | Quản lý yêu cầu thiết kế: Khách hàng gửi yêu cầu, Designer xem và báo giá, Admin theo dõi              | US-C01, US-C02, US-C03, US-D01, US-D02, US-A02 |
| FR-02 | Catalog Management         | Quản lý danh mục Portfolio: Designer upload tác phẩm, Khách hàng xem và lọc, Admin duyệt nội dung     | US-C04, US-D03, US-A03 |
| FR-03 | Communication              | Hệ thống giao tiếp: Chat, comment trên bản nháp, thông báo tự động                                    | US-C05, US-C06, US-D04, US-D05 |
| FR-04 | Review & Rating            | Đánh giá và xếp hạng: Khách hàng đánh giá Designer sau khi hoàn thành dự án                           | US-C07, US-D06 |
| FR-05 | User Profile Management    | Quản lý hồ sơ người dùng: Thông tin cá nhân, lịch sử giao dịch, thống kê                              | US-C08 |
| FR-06 | Admin Interface            | Giao diện quản trị: Quản lý Designer, theo dõi yêu cầu, duyệt nội dung                                | US-A01, US-A02, US-A03 |
| FR-07 | Promotion Management       | Quản lý khuyến mãi: Tạo và quản lý mã giảm giá, chương trình khuyến mãi                               | US-A04 |
| FR-08 | Analytics & Reporting      | Phân tích và báo cáo: Thống kê yêu cầu, tỷ lệ chuyển đổi, hiệu suất Designer                          | US-A05 |
| FR-09 | Payment Processing         | Xử lý thanh toán: Thanh toán khi báo giá được chấp nhận, hoàn tiền nếu cần                             | - |
| FR-10 | Notification System        | Hệ thống thông báo: Email, in-app notification cho các sự kiện quan trọng                              | US-C05, US-A06 |
| FR-11 | Automation                 | Tự động hóa: Gửi email tự động, cập nhật trạng thái, nhắc nhở                                         | US-A06 |

### **Chi tiết các Functional Requirements:**

#### **FR-01: Request Management**
* Khách hàng có thể tạo yêu cầu thiết kế với thông tin chi tiết (tiêu đề, mô tả, ngân sách, deadline, file tham khảo)
* Designer có thể xem danh sách yêu cầu và lọc theo chuyên môn
* Designer có thể tạo và gửi báo giá cho yêu cầu
* Khách hàng có thể xem trạng thái yêu cầu (Chờ Báo giá, Đang Thiết kế, Chờ Phản hồi, Đã Hoàn thành)
* Admin có thể theo dõi tất cả yêu cầu trong hệ thống

#### **FR-02: Catalog Management**
* Designer có thể upload và quản lý Portfolio của mình
* Khách hàng có thể xem và lọc Portfolio theo loại sản phẩm, phong cách
* Admin có thể duyệt Portfolio trước khi hiển thị công khai
* Hỗ trợ tìm kiếm Portfolio theo từ khóa

#### **FR-03: Communication** ⭐ (Phân tích chi tiết trong Chương 3)
* Designer có thể upload bản nháp thiết kế
* Khách hàng có thể xem bản nháp và phản hồi trực tiếp
* Hệ thống hỗ trợ comment trên bản nháp
* Thông báo tự động khi có bản nháp mới hoặc phản hồi mới
* Lưu trữ lịch sử tất cả các version bản nháp

#### **FR-04: Review & Rating**
* Khách hàng có thể đánh giá Designer sau khi hoàn thành dự án (1-5 sao)
* Khách hàng có thể viết nhận xét chi tiết
* Designer có thể xem tổng hợp đánh giá và thống kê

#### **FR-05: User Profile Management**
* Người dùng có thể quản lý thông tin cá nhân
* Xem lịch sử yêu cầu, dự án đã thực hiện
* Thống kê cá nhân (số dự án, tỷ lệ thành công...)

#### **FR-06: Admin Interface**
* Quản lý danh sách Designer (thêm, sửa, xóa, khóa tài khoản)
* Duyệt Portfolio và nội dung
* Theo dõi tổng quan hệ thống

#### **FR-07: Promotion Management**
* Tạo và quản lý mã khuyến mãi
* Thiết lập chương trình khuyến mãi theo thời gian
* Theo dõi hiệu quả khuyến mãi

#### **FR-08: Analytics & Reporting**
* Thống kê số lượng yêu cầu mới
* Tỷ lệ chuyển đổi (từ yêu cầu sang báo giá được chấp nhận)
* Hiệu suất Designer
* Báo cáo doanh thu

#### **FR-09: Payment Processing**
* Thanh toán khi báo giá được chấp nhận
* Hệ thống escrow (giữ tiền) để bảo vệ cả hai bên
* Hoàn tiền nếu có tranh chấp

#### **FR-10: Notification System**
* Email notification cho các sự kiện quan trọng
* In-app notification
* Cài đặt tùy chọn thông báo

#### **FR-11: Automation**
* Gửi email tự động (chào mừng, nhắc nhở)
* Tự động cập nhật trạng thái
* Tự động nhắc nhở khi quá hạn

---

## **2.3. Các yêu cầu phi chức năng (Non-functional Requirements)**

| ID     | Requirement      | Mô tả chi tiết                                                                                    |
| ------ | ---------------- | ------------------------------------------------------------------------------------------------- |
| NFR-01 | Performance      | Thời gian phản hồi dưới 2 giây cho các thao tác thông thường, upload file dưới 30 giây cho file 50MB |
| NFR-02 | Security         | Mã hóa dữ liệu người dùng (bcrypt cho password), bảo mật thanh toán (HTTPS, token), xác thực 2 lớp cho tài khoản Designer |
| NFR-03 | Availability     | Hệ thống hoạt động 24/7, uptime 99.5%, có cơ chế backup và recovery tự động                      |
| NFR-04 | Scalability      | Hỗ trợ tối thiểu 10,000 người dùng đồng thời, có khả năng mở rộng theo nhu cầu (horizontal scaling) |
| NFR-05 | Usability        | Giao diện thân thiện, dễ sử dụng, hỗ trợ đa ngôn ngữ (Tiếng Việt, Tiếng Anh), responsive design |
| NFR-06 | Compatibility    | Hỗ trợ các trình duyệt phổ biến (Chrome, Firefox, Safari, Edge), responsive cho mobile (iOS, Android) |
| NFR-07 | Data Integrity   | Đảm bảo tính toàn vẹn dữ liệu, có cơ chế rollback khi có lỗi, transaction cho các thao tác quan trọng |
| NFR-08 | File Storage     | Hỗ trợ upload file thiết kế (JPG, PNG, PDF, AI, PSD) tối đa 50MB/file, tổng 5GB/user, hỗ trợ preview |

### **Chi tiết các Non-functional Requirements:**

#### **NFR-01: Performance**
* **Response Time**: 
  - Thao tác thông thường (xem danh sách, tìm kiếm): < 2 giây
  - Upload file: < 30 giây cho file 50MB
  - Download file: < 10 giây cho file 50MB
* **Throughput**: Hỗ trợ ít nhất 1000 requests/giây
* **Database Query**: Tối ưu hóa query, sử dụng index

#### **NFR-02: Security**
* **Authentication**: JWT token, session management
* **Authorization**: Role-based access control (RBAC)
* **Data Encryption**: 
  - Password: bcrypt với salt
  - HTTPS cho tất cả communication
  - Encrypt sensitive data trong database
* **2FA**: Xác thực 2 lớp cho tài khoản Designer
* **Input Validation**: Validate và sanitize tất cả input từ user

#### **NFR-03: Availability**
* **Uptime**: 99.5% (tương đương downtime < 43.8 giờ/năm)
* **Backup**: Tự động backup database hàng ngày
* **Disaster Recovery**: Có kế hoạch recovery trong 24 giờ
* **Monitoring**: Real-time monitoring và alerting

#### **NFR-04: Scalability**
* **Horizontal Scaling**: Có thể thêm server khi cần
* **Load Balancing**: Phân tải request giữa các server
* **Caching**: Sử dụng Redis cache cho dữ liệu thường xuyên truy cập
* **CDN**: Sử dụng CDN cho static files và images

#### **NFR-05: Usability**
* **User Interface**: 
  - Giao diện trực quan, dễ sử dụng
  - Hỗ trợ keyboard shortcuts
  - Tooltips và help text
* **Accessibility**: Tuân thủ WCAG 2.1 Level AA
* **Multi-language**: Tiếng Việt và Tiếng Anh

#### **NFR-06: Compatibility**
* **Browsers**: 
  - Chrome (latest 2 versions)
  - Firefox (latest 2 versions)
  - Safari (latest 2 versions)
  - Edge (latest 2 versions)
* **Mobile**: Responsive design cho iOS và Android
* **Screen Sizes**: Hỗ trợ từ 320px (mobile) đến 4K

#### **NFR-07: Data Integrity**
* **ACID Properties**: Đảm bảo ACID cho database transactions
* **Validation**: Validate dữ liệu ở cả client và server
* **Audit Trail**: Lưu log tất cả các thay đổi quan trọng
* **Backup & Recovery**: Backup định kỳ và có thể restore

#### **NFR-08: File Storage**
* **Supported Formats**: JPG, PNG, PDF, AI, PSD, SVG
* **File Size**: Tối đa 50MB/file
* **Storage Quota**: 5GB/user (có thể nâng cấp)
* **Preview**: Hỗ trợ preview cho images và PDF
* **Compression**: Tự động compress images khi upload

---

**Trang trước**: [Chương 1 - Giới thiệu](01-Gioi-Thieu.md) | **Trang tiếp theo**: [Chương 3 - Mô hình hóa hệ thống](03-Mo-Hinh-Hoa-He-Thong.md)

