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

| ID      | Requirement                | Mô tả (Description)                                                                                    | User Stories liên quan |
| ------- | -------------------------- | ------------------------------------------------------------------------------------------------------- | ---------------------- |
| **FR-01** | **Request Management**     | Quản lý yêu cầu thiết kế: Khách hàng gửi yêu cầu, Designer xem và báo giá, Admin theo dõi              | US-C01, US-C02, US-C03, US-D01, US-D02, US-A02 |
| FR-01.1 | Create Design Request      | Khách hàng tạo yêu cầu thiết kế với thông tin chi tiết                                                 | US-C01, US-C02 |
| FR-01.2 | View & Filter Requests     | Designer xem danh sách yêu cầu và lọc theo chuyên môn                                                  | US-D01 |
| FR-01.3 | Create & Submit Quote      | Designer tạo và gửi báo giá cho yêu cầu                                                                 | US-D02 |
| FR-01.4 | Track Request Status       | Khách hàng và Designer theo dõi trạng thái yêu cầu                                                    | US-C03, US-D05 |
| FR-01.5 | Admin Request Monitoring   | Admin theo dõi và quản lý tất cả yêu cầu trong hệ thống                                                | US-A02 |
| **FR-02** | **Catalog Management**     | Quản lý danh mục Portfolio: Designer upload tác phẩm, Khách hàng xem và lọc, Admin duyệt nội dung     | US-C04, US-D03, US-A03 |
| FR-02.1 | Upload Portfolio           | Designer upload và quản lý Portfolio của mình                                                          | US-D03 |
| FR-02.2 | Browse & Filter Portfolio  | Khách hàng xem và lọc Portfolio theo loại sản phẩm, phong cách                                          | US-C04 |
| FR-02.3 | Search Portfolio           | Tìm kiếm Portfolio theo từ khóa                                                                        | US-C04 |
| FR-02.4 | Approve Portfolio          | Admin duyệt Portfolio trước khi hiển thị công khai                                                      | US-A03 |
| **FR-03** | **Communication** ⭐       | Hệ thống giao tiếp: Chat, comment trên bản nháp, thông báo tự động                                    | US-C05, US-C06, US-D04, US-D05 |
| FR-03.1 | Upload Draft Design        | Designer upload bản nháp thiết kế                                                                      | US-D04 |
| FR-03.2 | View Draft & Comment       | Khách hàng xem bản nháp và phản hồi trực tiếp                                                          | US-C06 |
| FR-03.3 | Draft Version Management   | Lưu trữ và quản lý lịch sử các version bản nháp                                                       | US-D04 |
| FR-03.4 | Real-time Notifications    | Thông báo tự động khi có bản nháp mới hoặc phản hồi mới                                                | US-C05, US-D04 |
| **FR-04** | **Review & Rating**        | Đánh giá và xếp hạng: Khách hàng đánh giá Designer sau khi hoàn thành dự án                           | US-C07, US-D06 |
| FR-04.1 | Submit Review              | Khách hàng đánh giá Designer (1-5 sao) và viết nhận xét                                                | US-C07 |
| FR-04.2 | View Reviews & Statistics  | Designer xem tổng hợp đánh giá và thống kê                                                              | US-D06 |
| **FR-05** | **User Profile Management**| Quản lý hồ sơ người dùng: Thông tin cá nhân, lịch sử giao dịch, thống kê                              | US-C08 |
| FR-05.1 | Manage Personal Info       | Người dùng quản lý thông tin cá nhân                                                                   | US-C08 |
| FR-05.2 | View History               | Xem lịch sử yêu cầu, dự án đã thực hiện                                                                | US-C08 |
| FR-05.3 | View Statistics            | Xem thống kê cá nhân (số dự án, tỷ lệ thành công...)                                                   | US-C08 |
| **FR-06** | **Admin Interface**        | Giao diện quản trị: Quản lý Designer, theo dõi yêu cầu, duyệt nội dung                                | US-A01, US-A02, US-A03 |
| FR-06.1 | Manage Designers           | Quản lý danh sách Designer (thêm, sửa, xóa, khóa tài khoản)                                            | US-A01 |
| FR-06.2 | Approve Content            | Duyệt Portfolio và nội dung khác                                                                       | US-A03 |
| FR-06.3 | System Overview            | Theo dõi tổng quan hệ thống                                                                            | US-A02 |
| **FR-07** | **Promotion Management**   | Quản lý khuyến mãi: Tạo và quản lý mã giảm giá, chương trình khuyến mãi                               | US-A04 |
| FR-07.1 | Create Coupon Codes        | Tạo và quản lý mã khuyến mãi                                                                          | US-A04 |
| FR-07.2 | Manage Promotions          | Thiết lập chương trình khuyến mãi theo thời gian                                                       | US-A04 |
| FR-07.3 | Track Promotion Effectiveness | Theo dõi hiệu quả khuyến mãi                                                                        | US-A04 |
| **FR-08** | **Analytics & Reporting**  | Phân tích và báo cáo: Thống kê yêu cầu, tỷ lệ chuyển đổi, hiệu suất Designer                          | US-A05 |
| FR-08.1 | Request Statistics         | Thống kê số lượng yêu cầu mới                                                                          | US-A05 |
| FR-08.2 | Conversion Analytics       | Tỷ lệ chuyển đổi (từ yêu cầu sang báo giá được chấp nhận)                                             | US-A05 |
| FR-08.3 | Designer Performance       | Hiệu suất Designer                                                                                     | US-A05 |
| FR-08.4 | Revenue Reports            | Báo cáo doanh thu                                                                                       | US-A05 |
| **FR-09** | **Payment Processing**    | Xử lý thanh toán: Thanh toán khi báo giá được chấp nhận, hoàn tiền nếu cần                             | - |
| FR-09.1 | Process Payment            | Thanh toán khi báo giá được chấp nhận                                                                   | - |
| FR-09.2 | Escrow System             | Hệ thống giữ tiền để bảo vệ cả hai bên                                                                  | - |
| FR-09.3 | Refund Processing          | Hoàn tiền nếu có tranh chấp                                                                            | - |
| **FR-10** | **Notification System**    | Hệ thống thông báo: Email, in-app notification cho các sự kiện quan trọng                              | US-C05, US-A06 |
| FR-10.1 | Email Notifications        | Gửi email notification cho các sự kiện quan trọng                                                      | US-C05, US-A06 |
| FR-10.2 | In-app Notifications      | Hiển thị thông báo trong ứng dụng                                                                       | US-C05 |
| FR-10.3 | Notification Settings      | Cài đặt tùy chọn thông báo                                                                              | US-C05 |
| **FR-11** | **Automation**             | Tự động hóa: Gửi email tự động, cập nhật trạng thái, nhắc nhở                                         | US-A06 |
| FR-11.1 | Automated Emails           | Gửi email tự động (chào mừng, nhắc nhở)                                                                | US-A06 |
| FR-11.2 | Auto Status Update         | Tự động cập nhật trạng thái                                                                            | US-A06 |
| FR-11.3 | Reminder System            | Tự động nhắc nhở khi quá hạn                                                                            | US-A06 |

### **Chi tiết các Functional Requirements:**

#### **FR-01: Request Management**

**FR-01.1: Create Design Request**
* Khách hàng có thể tạo yêu cầu thiết kế với thông tin chi tiết:
  - Tiêu đề yêu cầu (required, 5-100 ký tự)
  - Mô tả chi tiết (required, tối thiểu 50 ký tự, hỗ trợ rich text)
  - Loại thiết kế (Logo, Banner, Website, Packaging...)
  - Ngân sách dự kiến (required, tối thiểu 100,000 VND)
  - Deadline (required, tối thiểu 3 ngày từ hôm nay)
  - Upload file tham khảo (optional, tối đa 10 files, 50MB/file)
* Validation form real-time
* Preview trước khi submit

**FR-01.2: View & Filter Requests**
* Designer có thể xem danh sách yêu cầu:
  - Tất cả yêu cầu mới
  - Yêu cầu đã báo giá
  - Yêu cầu đang thực hiện
* Lọc theo:
  - Chuyên môn/Category
  - Ngân sách (min-max)
  - Deadline
  - Trạng thái
* Sort theo: Mới nhất, Deadline, Ngân sách

**FR-01.3: Create & Submit Quote**
* Designer có thể tạo báo giá:
  - Giá đề xuất (required)
  - Số ngày dự kiến hoàn thành (required)
  - Mô tả báo giá (optional)
  - Terms & conditions (optional)
* Preview báo giá trước khi gửi
* Gửi báo giá cho khách hàng
* Khách hàng có thể chấp nhận/từ chối báo giá

**FR-01.4: Track Request Status**
* Trạng thái yêu cầu:
  - `pending_quote` - Chờ báo giá
  - `quote_sent` - Đã gửi báo giá
  - `quote_accepted` - Báo giá được chấp nhận
  - `in_progress` - Đang thiết kế
  - `waiting_feedback` - Chờ phản hồi
  - `approved` - Đã duyệt
  - `completed` - Đã hoàn thành
  - `cancelled` - Đã hủy
* Timeline hiển thị lịch sử thay đổi trạng thái
* Thông báo khi trạng thái thay đổi

**FR-01.5: Admin Request Monitoring**
* Admin dashboard hiển thị:
  - Tổng số yêu cầu
  - Yêu cầu theo trạng thái
  - Yêu cầu mới trong 24h/7 ngày/30 ngày
* Filter và search yêu cầu
* Xem chi tiết từng yêu cầu
* Có thể can thiệp nếu cần (hủy, chuyển Designer...)

---

#### **FR-02: Catalog Management**

**FR-02.1: Upload Portfolio**
* Designer có thể:
  - Upload hình ảnh Portfolio (JPG, PNG, tối đa 50MB)
  - Thêm tiêu đề, mô tả
  - Chọn category và tags
  - Thêm thông tin dự án (nếu có)
* Quản lý Portfolio:
  - Edit, Delete
  - Sắp xếp thứ tự hiển thị
  - Set featured portfolio

**FR-02.2: Browse & Filter Portfolio**
* Khách hàng có thể:
  - Xem grid layout của Portfolio
  - Lọc theo:
    * Category (Logo, Banner, Website...)
    * Style (Minimalist, Modern, Vintage...)
    * Designer
    * Rating
  - Sort theo: Mới nhất, Phổ biến, Rating cao nhất

**FR-02.3: Search Portfolio**
* Tìm kiếm Portfolio theo:
  - Từ khóa (title, description, tags)
  - Designer name
  - Category
* Autocomplete suggestions
* Highlight kết quả tìm kiếm

**FR-02.4: Approve Portfolio**
* Admin có thể:
  - Xem danh sách Portfolio chờ duyệt
  - Preview Portfolio
  - Approve hoặc Reject với lý do
  - Bulk approve/reject

---

#### **FR-03: Communication** ⭐ (Phân tích chi tiết trong Chương 3)

**FR-03.1: Upload Draft Design**
* Designer có thể:
  - Upload file bản nháp (JPG, PNG, PDF, PSD, AI)
  - Thêm mô tả cho bản nháp (optional)
  - Version tự động tăng (v1.0, v2.0...)
* Validation file (format, size)
* Preview trước khi upload
* Progress bar khi uploading

**FR-03.2: View Draft & Comment**
* Khách hàng có thể:
  - Xem bản nháp với image viewer (zoom, pan)
  - Comment trực tiếp trên bản nháp
  - Attach file reference
  - Markup tools (draw, highlight)
  - Approve hoặc Request changes

**FR-03.3: Draft Version Management**
* Lưu trữ tất cả các version:
  - Version number
  - Upload date
  - File info (name, size, type)
  - Status (Pending, Approved, Rejected)
* Timeline view các version
* Compare versions
* Download version cũ

**FR-03.4: Real-time Notifications**
* Thông báo khi:
  - Designer upload bản nháp mới
  - Khách hàng comment/phản hồi
  - Bản nháp được approve/reject
* Email + In-app notification
* Notification center với unread count

---

#### **FR-04: Review & Rating**

**FR-04.1: Submit Review**
* Khách hàng có thể:
  - Đánh giá Designer (1-5 sao)
  - Viết nhận xét chi tiết (optional)
  - Upload hình ảnh sản phẩm cuối cùng (optional)
* Chỉ có thể review sau khi dự án hoàn thành
* Một dự án chỉ review một lần
* Có thể edit review trong 7 ngày

**FR-04.2: View Reviews & Statistics**
* Designer có thể xem:
  - Tổng hợp đánh giá (trung bình sao)
  - Danh sách tất cả reviews
  - Thống kê:
    * Số lượng reviews
    * Phân bố điểm (1-5 sao)
    * Reviews theo thời gian
* Filter reviews theo rating, thời gian

---

#### **FR-05: User Profile Management**

**FR-05.1: Manage Personal Info**
* Người dùng có thể:
  - Cập nhật thông tin cá nhân (tên, email, phone, avatar)
  - Đổi mật khẩu
  - Cài đặt privacy
  - Xác thực email/phone

**FR-05.2: View History**
* Xem lịch sử:
  - Yêu cầu đã tạo (Customer)
  - Dự án đã thực hiện (Designer)
  - Giao dịch thanh toán
  - Portfolio đã upload (Designer)

**FR-05.3: View Statistics**
* Thống kê cá nhân:
  - Số dự án đã hoàn thành
  - Tỷ lệ thành công
  - Tổng doanh thu (Designer)
  - Average rating (Designer)
  - Charts và graphs

---

#### **FR-06: Admin Interface**

**FR-06.1: Manage Designers**
* Admin có thể:
  - Xem danh sách tất cả Designer
  - Thêm Designer mới (manual)
  - Edit thông tin Designer
  - Khóa/Mở khóa tài khoản
  - Xóa Designer (soft delete)
  - Xem thống kê Designer

**FR-06.2: Approve Content**
* Duyệt:
  - Portfolio mới
  - Nội dung khác (nếu có)
* Bulk operations
* Reject với lý do

**FR-06.3: System Overview**
* Dashboard hiển thị:
  - Tổng số users (Customer, Designer)
  - Tổng số requests
  - Revenue (nếu có)
  - Active projects
  - System health

---

#### **FR-07: Promotion Management**

**FR-07.1: Create Coupon Codes**
* Tạo mã khuyến mãi:
  - Code (unique)
  - Discount type (% hoặc fixed amount)
  - Discount value
  - Minimum order value
  - Usage limit (per user, total)
  - Valid from/to dates

**FR-07.2: Manage Promotions**
* Thiết lập chương trình:
  - Flash sale
  - Seasonal promotions
  - New user discount
* Schedule promotions
* Auto enable/disable

**FR-07.3: Track Promotion Effectiveness**
* Thống kê:
  - Số lần sử dụng
  - Tổng discount đã áp dụng
  - Conversion rate
  - Revenue từ promotion

---

#### **FR-08: Analytics & Reporting**

**FR-08.1: Request Statistics**
* Thống kê:
  - Số lượng yêu cầu mới (daily, weekly, monthly)
  - Requests theo category
  - Requests theo status
  - Trends và charts

**FR-08.2: Conversion Analytics**
* Tỷ lệ chuyển đổi:
  - Request → Quote sent
  - Quote sent → Quote accepted
  - Quote accepted → Completed
  - Funnel visualization

**FR-08.3: Designer Performance**
* Metrics:
  - Số dự án hoàn thành
  - Average rating
  - Response time
  - Completion rate
  - Revenue

**FR-08.4: Revenue Reports**
* Báo cáo:
  - Total revenue
  - Revenue theo thời gian
  - Revenue theo Designer
  - Commission (nếu có)
  - Export reports (PDF, Excel)

---

#### **FR-09: Payment Processing**

**FR-09.1: Process Payment**
* Thanh toán khi:
  - Báo giá được chấp nhận
  - Hoặc theo milestone
* Payment methods:
  - Credit/Debit card
  - Bank transfer
  - E-wallet (nếu có)
* Payment confirmation
* Receipt generation

**FR-09.2: Escrow System**
* Giữ tiền trong escrow:
  - Khách hàng thanh toán → tiền giữ trong escrow
  - Designer hoàn thành → tiền chuyển cho Designer
  - Bảo vệ cả hai bên
* Escrow balance tracking

**FR-09.3: Refund Processing**
* Hoàn tiền khi:
  - Tranh chấp (Admin quyết định)
  - Dự án bị hủy
  - Designer không hoàn thành
* Refund workflow
* Refund history

---

#### **FR-10: Notification System**

**FR-10.1: Email Notifications**
* Gửi email cho:
  - Yêu cầu mới
  - Báo giá mới
  - Bản nháp mới
  - Phản hồi mới
  - Dự án hoàn thành
  - Payment updates
* Email templates
* HTML email với branding

**FR-10.2: In-app Notifications**
* Notification center:
  - Danh sách notifications
  - Mark as read/unread
  - Filter notifications
  - Real-time updates (WebSocket)
* Badge count
* Toast notifications

**FR-10.3: Notification Settings**
* User có thể:
  - Bật/tắt từng loại notification
  - Chọn email hoặc in-app
  - Set quiet hours
  - Unsubscribe

---

#### **FR-11: Automation**

**FR-11.1: Automated Emails**
* Tự động gửi email:
  - Welcome email khi đăng ký
  - Email nhắc nhở (deadline, feedback)
  - Weekly digest
  - Birthday wishes (optional)

**FR-11.2: Auto Status Update**
* Tự động cập nhật:
  - Status khi deadline đến
  - Status khi không có phản hồi sau X ngày
  - Auto-complete sau khi approve

**FR-11.3: Reminder System**
* Tự động nhắc nhở:
  - Designer: deadline sắp đến
  - Customer: cần phản hồi bản nháp
  - Admin: có nội dung cần duyệt
* Escalation (nếu không phản hồi)

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

