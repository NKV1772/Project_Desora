# **4. Thiết kế hệ thống (System Design)**

---

## **4.1. Kiến trúc hệ thống (System Architecture)**

### **Mô hình kiến trúc: Layered Architecture (3-Tier)**

Hệ thống Desora được thiết kế theo mô hình **Layered Architecture** với 3 tầng chính:

```
┌─────────────────────────────────────────────────────────────┐
│                    Presentation Layer                         │
│  (Frontend - React/Vue.js)                                   │
│  - Customer Portal                                           │
│  - Designer Dashboard                                        │
│  - Admin Panel                                               │
└─────────────────────────────────────────────────────────────┘
                            │
                            ▼
┌─────────────────────────────────────────────────────────────┐
│                    Business Logic Layer                      │
│  (Backend API - Node.js/Express hoặc Laravel)               │
│  - Request Management Service                                │
│  - Communication Service                                     │
│  - Catalog Management Service                                │
│  - Review & Rating Service                                   │
│  - Notification Service                                      │
│  - File Storage Service                                      │
│  - Payment Service                                           │
└─────────────────────────────────────────────────────────────┘
                            │
                            ▼
┌─────────────────────────────────────────────────────────────┐
│                      Data Layer                               │
│  (Database - PostgreSQL/MySQL)                               │
│  - User Database                                             │
│  - Request Database                                          │
│  - File Storage (AWS S3 / Cloud Storage)                     │
│  - Notification Queue (Redis)                                │
└─────────────────────────────────────────────────────────────┘
```

### **Mô tả các thành phần:**

#### **1. Presentation Layer (Frontend)**

**Công nghệ đề xuất:**
* **Framework**: React.js với TypeScript hoặc Vue.js
* **UI Library**: Tailwind CSS, Material-UI, hoặc Ant Design
* **State Management**: Redux (React) hoặc Vuex (Vue)
* **Routing**: React Router hoặc Vue Router
* **HTTP Client**: Axios

**Các module chính:**

* **Customer Portal**:
  - Homepage với showcase Portfolio
  - Catalog browsing và filtering
  - Request submission form
  - Draft viewing và feedback interface
  - Profile management

* **Designer Dashboard**:
  - Request management (view, quote, upload draft)
  - Portfolio management
  - Feedback viewing và response
  - Statistics và analytics

* **Admin Panel**:
  - User management
  - Content approval
  - System analytics
  - Promotion management

#### **2. Business Logic Layer (Backend API)**

**Công nghệ đề xuất:**
* **Framework**: Node.js + Express hoặc Laravel (PHP)
* **API Style**: RESTful API hoặc GraphQL
* **Authentication**: JWT (JSON Web Token)
* **Validation**: Joi (Node.js) hoặc Laravel Validation
* **File Upload**: Multer (Node.js) hoặc Laravel Storage

**Các Service Module:**

* **Request Management Service**:
  - `POST /api/requests` - Tạo yêu cầu mới
  - `GET /api/requests` - Lấy danh sách yêu cầu
  - `GET /api/requests/:id` - Lấy chi tiết yêu cầu
  - `PUT /api/requests/:id/status` - Cập nhật trạng thái

* **Communication Service**:
  - `POST /api/drafts` - Upload bản nháp
  - `GET /api/drafts/:id` - Lấy bản nháp
  - `POST /api/drafts/:id/feedback` - Gửi phản hồi
  - `GET /api/drafts/:id/feedback` - Lấy phản hồi

* **Catalog Management Service**:
  - `GET /api/portfolios` - Lấy danh sách Portfolio
  - `POST /api/portfolios` - Upload Portfolio
  - `PUT /api/portfolios/:id` - Cập nhật Portfolio
  - `DELETE /api/portfolios/:id` - Xóa Portfolio

* **Notification Service**:
  - `POST /api/notifications` - Gửi thông báo
  - `GET /api/notifications` - Lấy danh sách thông báo
  - `PUT /api/notifications/:id/read` - Đánh dấu đã đọc

* **File Storage Service**:
  - `POST /api/files/upload` - Upload file
  - `GET /api/files/:id` - Lấy file
  - `DELETE /api/files/:id` - Xóa file

#### **3. Data Layer**

**Database:**
* **RDBMS**: PostgreSQL (khuyến nghị) hoặc MySQL
* **ORM**: Sequelize (Node.js) hoặc Eloquent (Laravel)
* **Migration**: Database migration tools

**File Storage:**
* **Cloud Storage**: AWS S3, Google Cloud Storage, hoặc Cloudinary
* **CDN**: CloudFront (AWS) hoặc Cloudflare

**Cache & Queue:**
* **Cache**: Redis cho session và cache
* **Queue**: Redis Queue hoặc RabbitMQ cho background jobs
* **Search**: Elasticsearch (optional) cho tìm kiếm nâng cao

### **Lý do chọn Layered Architecture:**

* ✅ **Phù hợp với quy mô dự án**: Không quá phức tạp cho đồ án sinh viên
* ✅ **Dễ phát triển và bảo trì**: Tách biệt rõ ràng giữa các tầng
* ✅ **Có thể mở rộng**: Dễ dàng thêm tính năng mới
* ✅ **Dễ test**: Có thể test từng tầng độc lập
* ✅ **Có thể nâng cấp**: Có thể chuyển đổi sang Microservices sau này nếu cần

### **So sánh với các kiến trúc khác:**

| Kiến trúc              | Ưu điểm                                    | Nhược điểm                          | Phù hợp cho Desora? |
| ---------------------- | ------------------------------------------ | ------------------------------------ | -------------------- |
| **Monolithic**         | Đơn giản, dễ phát triển                    | Khó mở rộng, khó bảo trì khi lớn     | ✅ Có (cho prototype) |
| **Layered**           | Tách biệt rõ ràng, dễ test                 | Có thể có bottleneck giữa các tầng   | ✅ **Đã chọn**       |
| **Microservices**     | Mở rộng tốt, độc lập                       | Phức tạp, khó quản lý                | ❌ Quá phức tạp      |
| **Microkernel**        | Linh hoạt, dễ thêm plugin                  | Phức tạp, khó thiết kế               | ❌ Không cần         |

---

## **4.2. Thiết kế cơ sở dữ liệu (Database Design)**

### **ERD (Entity Relationship Diagram) - Các bảng chính:**

#### **Bảng Users:**

| Field        | Type         | Constraints | Description                |
| ------------ | ------------ | ----------- | -------------------------- |
| user_id      | VARCHAR(50)  | PK          | ID người dùng (UUID)       |
| email        | VARCHAR(255) | UNIQUE, NN  | Email đăng nhập            |
| password     | VARCHAR(255) | NN          | Mật khẩu (hashed bcrypt)   |
| full_name    | VARCHAR(100) |             | Họ tên                     |
| phone        | VARCHAR(20)  |             | Số điện thoại              |
| avatar_url   | VARCHAR(500) |             | URL avatar                 |
| role         | ENUM         | NN          | Customer/Designer/Admin    |
| is_verified  | BOOLEAN      | DEFAULT 0   | Đã xác thực email chưa     |
| is_active    | BOOLEAN      | DEFAULT 1   | Tài khoản đang hoạt động   |
| created_at   | TIMESTAMP    | DEFAULT NOW | Ngày tạo                   |
| updated_at   | TIMESTAMP    | DEFAULT NOW | Ngày cập nhật               |

**Indexes:**
* `idx_users_email` trên `email`
* `idx_users_role` trên `role`

#### **Bảng DesignRequests:**

| Field         | Type         | Constraints | Description                    |
| ------------- | ------------ | ----------- | ------------------------------ |
| request_id    | VARCHAR(50)  | PK          | ID yêu cầu (UUID)              |
| customer_id   | VARCHAR(50)  | FK → Users  | ID khách hàng                 |
| designer_id   | VARCHAR(50)  | FK → Users | ID designer (nullable)         |
| title         | VARCHAR(255) | NN          | Tiêu đề yêu cầu                |
| description   | TEXT         |             | Mô tả chi tiết                 |
| category      | VARCHAR(50)  |             | Loại thiết kế (Logo, Banner...)|
| budget        | DECIMAL(10,2)|             | Ngân sách dự kiến              |
| deadline      | DATE         |             | Hạn hoàn thành                 |
| status        | ENUM         | NN          | Trạng thái yêu cầu             |
| created_at    | TIMESTAMP    | DEFAULT NOW | Ngày tạo                       |
| updated_at    | TIMESTAMP    | DEFAULT NOW | Ngày cập nhật                   |

**Status Values:**
* `pending_quote` - Chờ báo giá
* `quote_sent` - Đã gửi báo giá
* `quote_accepted` - Báo giá được chấp nhận
* `in_progress` - Đang thiết kế
* `waiting_feedback` - Chờ phản hồi
* `approved` - Đã duyệt
* `completed` - Đã hoàn thành
* `cancelled` - Đã hủy

**Indexes:**
* `idx_requests_customer` trên `customer_id`
* `idx_requests_designer` trên `designer_id`
* `idx_requests_status` trên `status`

#### **Bảng Quotes:**

| Field         | Type         | Constraints | Description                    |
| ------------- | ------------ | ----------- | ------------------------------ |
| quote_id      | VARCHAR(50)  | PK          | ID báo giá (UUID)              |
| request_id    | VARCHAR(50)  | FK → DesignRequests | ID yêu cầu          |
| designer_id   | VARCHAR(50)  | FK → Users  | ID designer                    |
| price         | DECIMAL(10,2)| NN          | Giá đề xuất                    |
| estimated_days| INTEGER      |             | Số ngày dự kiến hoàn thành     |
| description   | TEXT         |             | Mô tả báo giá                  |
| status        | ENUM         | NN          | Pending/Accepted/Rejected      |
| created_at    | TIMESTAMP    | DEFAULT NOW | Ngày tạo                       |
| updated_at    | TIMESTAMP    | DEFAULT NOW | Ngày cập nhật                   |

**Indexes:**
* `idx_quotes_request` trên `request_id`
* `idx_quotes_designer` trên `designer_id`

#### **Bảng DraftVersions:**

| Field         | Type         | Constraints | Description                    |
| ------------- | ------------ | ----------- | ------------------------------ |
| draft_id      | VARCHAR(50)  | PK          | ID bản nháp (UUID)             |
| request_id    | VARCHAR(50)  | FK → DesignRequests | ID yêu cầu          |
| version_number| INTEGER      | NN          | Số phiên bản                   |
| file_url      | VARCHAR(500) | NN          | URL file trên storage          |
| file_name     | VARCHAR(255) |             | Tên file                       |
| file_size     | BIGINT       |             | Kích thước file (bytes)        |
| file_type     | VARCHAR(50)  |             | Loại file (JPG, PNG, PDF...)   |
| description   | TEXT         |             | Mô tả bản nháp                 |
| status        | ENUM         | NN          | Pending/Approved/Rejected       |
| uploaded_at   | TIMESTAMP    | DEFAULT NOW | Ngày upload                    |
| approved_at   | TIMESTAMP    |             | Ngày được duyệt                |

**Indexes:**
* `idx_drafts_request` trên `request_id`
* `idx_drafts_status` trên `status`

#### **Bảng Feedbacks:**

| Field         | Type         | Constraints | Description                    |
| ------------- | ------------ | ----------- | ------------------------------ |
| feedback_id   | VARCHAR(50)  | PK          | ID phản hồi (UUID)             |
| draft_id      | VARCHAR(50)  | FK → DraftVersions | ID bản nháp            |
| customer_id   | VARCHAR(50)  | FK → Users  | ID khách hàng                  |
| comment       | TEXT         |             | Nội dung phản hồi              |
| is_approved   | BOOLEAN      | DEFAULT 0   | Đã duyệt chưa                  |
| is_read       | BOOLEAN      | DEFAULT 0   | Designer đã đọc chưa           |
| created_at    | TIMESTAMP    | DEFAULT NOW | Ngày tạo                       |
| updated_at    | TIMESTAMP    | DEFAULT NOW | Ngày cập nhật                   |

**Indexes:**
* `idx_feedbacks_draft` trên `draft_id`
* `idx_feedbacks_customer` trên `customer_id`

#### **Bảng Portfolios:**

| Field         | Type         | Constraints | Description                    |
| ------------- | ------------ | ----------- | ------------------------------ |
| portfolio_id  | VARCHAR(50)  | PK          | ID portfolio (UUID)           |
| designer_id   | VARCHAR(50)  | FK → Users  | ID designer                    |
| title         | VARCHAR(255)  | NN          | Tiêu đề tác phẩm               |
| image_url     | VARCHAR(500) | NN          | URL hình ảnh                   |
| category      | VARCHAR(50)  |             | Loại thiết kế                  |
| description   | TEXT         |             | Mô tả                          |
| tags          | TEXT[]       |             | Tags (array)                   |
| is_approved   | BOOLEAN      | DEFAULT 0   | Đã được admin duyệt            |
| view_count    | INTEGER      | DEFAULT 0   | Số lượt xem                    |
| created_at    | TIMESTAMP    | DEFAULT NOW | Ngày tạo                       |
| updated_at    | TIMESTAMP    | DEFAULT NOW | Ngày cập nhật                   |

**Indexes:**
* `idx_portfolios_designer` trên `designer_id`
* `idx_portfolios_category` trên `category`
* `idx_portfolios_approved` trên `is_approved`

#### **Bảng Reviews:**

| Field         | Type         | Constraints | Description                    |
| ------------- | ------------ | ----------- | ------------------------------ |
| review_id     | VARCHAR(50)  | PK          | ID đánh giá (UUID)             |
| request_id    | VARCHAR(50)  | FK → DesignRequests | ID yêu cầu          |
| customer_id   | VARCHAR(50)  | FK → Users  | ID khách hàng                 |
| designer_id   | VARCHAR(50)  | FK → Users  | ID designer                    |
| rating        | INTEGER      | NN          | Điểm (1-5)                     |
| comment       | TEXT         |             | Nhận xét                       |
| created_at    | TIMESTAMP    | DEFAULT NOW | Ngày tạo                       |
| updated_at    | TIMESTAMP    | DEFAULT NOW | Ngày cập nhật                   |

**Constraints:**
* `rating` phải từ 1 đến 5
* Một `request_id` chỉ có một review

**Indexes:**
* `idx_reviews_designer` trên `designer_id`
* `idx_reviews_rating` trên `rating`

#### **Bảng Notifications:**

| Field         | Type         | Constraints | Description                    |
| ------------- | ------------ | ----------- | ------------------------------ |
| notification_id| VARCHAR(50) | PK          | ID thông báo (UUID)            |
| user_id       | VARCHAR(50)  | FK → Users  | ID người nhận                  |
| type          | VARCHAR(50)   | NN          | Loại thông báo                 |
| title         | VARCHAR(255)  | NN          | Tiêu đề                        |
| message       | TEXT         |             | Nội dung                       |
| link          | VARCHAR(500)  |             | Link liên kết                  |
| is_read       | BOOLEAN      | DEFAULT 0   | Đã đọc chưa                    |
| created_at    | TIMESTAMP    | DEFAULT NOW | Ngày tạo                       |

**Indexes:**
* `idx_notifications_user` trên `user_id`
* `idx_notifications_read` trên `is_read`

### **Mối quan hệ (Relationships):**

```
Users (1) ──< DesignRequests (N)
  │              │
  │              └──< Quotes (N)
  │              └──< DraftVersions (N)
  │                      │
  │                      └──< Feedbacks (N)
  │
  ├──< Portfolios (N)
  ├──< Reviews (N) [as customer]
  └──< Reviews (N) [as designer]
```

**Chi tiết quan hệ:**

1. **Users → DesignRequests**: One-to-Many
   - Một user có thể tạo nhiều yêu cầu
   - Foreign key: `customer_id`, `designer_id`

2. **DesignRequests → Quotes**: One-to-Many
   - Một yêu cầu có thể có nhiều báo giá (từ nhiều Designer)
   - Foreign key: `request_id`

3. **DesignRequests → DraftVersions**: One-to-Many
   - Một yêu cầu có nhiều version bản nháp
   - Foreign key: `request_id`

4. **DraftVersions → Feedbacks**: One-to-Many
   - Một bản nháp có nhiều phản hồi
   - Foreign key: `draft_id`

5. **Users → Portfolios**: One-to-Many
   - Một Designer có nhiều Portfolio
   - Foreign key: `designer_id`

6. **DesignRequests → Reviews**: One-to-One
   - Một yêu cầu chỉ có một đánh giá (sau khi hoàn thành)
   - Foreign key: `request_id`

### **Database Schema SQL (PostgreSQL):**

```sql
-- Tạo bảng Users
CREATE TABLE users (
    user_id VARCHAR(50) PRIMARY KEY,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    full_name VARCHAR(100),
    phone VARCHAR(20),
    avatar_url VARCHAR(500),
    role ENUM('Customer', 'Designer', 'Admin') NOT NULL,
    is_verified BOOLEAN DEFAULT FALSE,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE INDEX idx_users_email ON users(email);
CREATE INDEX idx_users_role ON users(role);

-- Tạo bảng DesignRequests
CREATE TABLE design_requests (
    request_id VARCHAR(50) PRIMARY KEY,
    customer_id VARCHAR(50) NOT NULL,
    designer_id VARCHAR(50),
    title VARCHAR(255) NOT NULL,
    description TEXT,
    category VARCHAR(50),
    budget DECIMAL(10,2),
    deadline DATE,
    status VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (customer_id) REFERENCES users(user_id),
    FOREIGN KEY (designer_id) REFERENCES users(user_id)
);

CREATE INDEX idx_requests_customer ON design_requests(customer_id);
CREATE INDEX idx_requests_designer ON design_requests(designer_id);
CREATE INDEX idx_requests_status ON design_requests(status);

-- Tạo bảng DraftVersions
CREATE TABLE draft_versions (
    draft_id VARCHAR(50) PRIMARY KEY,
    request_id VARCHAR(50) NOT NULL,
    version_number INTEGER NOT NULL,
    file_url VARCHAR(500) NOT NULL,
    file_name VARCHAR(255),
    file_size BIGINT,
    file_type VARCHAR(50),
    description TEXT,
    status VARCHAR(50) NOT NULL,
    uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    approved_at TIMESTAMP,
    FOREIGN KEY (request_id) REFERENCES design_requests(request_id)
);

CREATE INDEX idx_drafts_request ON draft_versions(request_id);
CREATE INDEX idx_drafts_status ON draft_versions(status);
```

---

## **4.3. Thiết kế giao diện, trải nghiệm người dùng (UI/UX Design)**

### **Các giao diện chính cho chức năng US-D04:**

#### **1. Designer Dashboard - Upload Draft Page**

**Layout Structure:**
```
┌─────────────────────────────────────────────────────────┐
│ Header: Logo | Navigation | Profile                    │
├─────────────────────────────────────────────────────────┤
│ Sidebar          │ Main Content Area                    │
│ - Dashboard      │ ┌─────────────────────────────────┐  │
│ - My Requests    │ │ Request Details                 │  │
│ - Portfolio      │ │ Title: Logo Design for ABC Co.  │  │
│ - Feedback       │ │ Status: In Progress             │  │
│ - Settings       │ └─────────────────────────────────┘  │
│                  │                                      │
│                  │ ┌─────────────────────────────────┐  │
│                  │ │ Upload Draft                    │  │
│                  │ │ ┌─────────────────────────────┐ │  │
│                  │ │ │  Drag & Drop File Here       │ │  │
│                  │ │ │  or Click to Browse         │ │  │
│                  │ │ └─────────────────────────────┘ │  │
│                  │ │ Description: [Text Area]         │  │
│                  │ │ [Upload] [Cancel]                │  │
│                  │ └─────────────────────────────────┘  │
│                  │                                      │
│                  │ ┌─────────────────────────────────┐  │
│                  │ │ Version History                 │  │
│                  │ │ v1.0 - Initial Design (2 days)  │  │
│                  │ │ v2.0 - Updated (1 day)         │  │
│                  │ └─────────────────────────────────┘  │
└─────────────────────────────────────────────────────────┘
```

**Components:**
* **Request List Sidebar**: Danh sách yêu cầu đang thực hiện với status badge
* **Upload Area**: 
  - Drag & drop zone với preview
  - File type indicator (JPG, PNG, PDF...)
  - Progress bar khi uploading
* **Description Text Area**: Rich text editor (optional)
* **Version History Timeline**: Hiển thị các version trước đó
* **Action Buttons**: Upload, Cancel, Preview

**User Flow:**
1. Designer vào Dashboard → Click "My Requests"
2. Chọn request có status "In Progress"
3. Click "Upload Draft" button
4. Drag & drop hoặc chọn file
5. Nhập description (optional)
6. Click "Upload"
7. Hiển thị success message
8. Redirect về request detail page

#### **2. Customer View - Draft Review Page**

**Layout Structure:**
```
┌─────────────────────────────────────────────────────────┐
│ Header: Logo | Notifications | Profile                 │
├─────────────────────────────────────────────────────────┤
│ ┌──────────────────────┐ ┌──────────────────────────┐ │
│ │ Draft Viewer         │ │ Comment Panel            │ │
│ │                      │ │                          │ │
│ │  [Image/PDF]        │ │ ┌──────────────────────┐ │ │
│ │                      │ │ │ Comments             │ │ │
│ │  [Zoom] [Pan]       │ │ │ ──────────────────── │ │ │
│ │                      │ │ │ Customer: "Change   │ │ │
│ │                      │ │ │  color to blue"     │ │ │
│ │                      │ │ │ ──────────────────── │ │ │
│ │                      │ │ │ Designer: "Done"     │ │ │
│ │                      │ │ └──────────────────────┘ │ │
│ │                      │ │                          │ │
│ │                      │ │ [Add Comment]           │ │
│ │                      │ │ [Approve] [Request      │ │
│ │                      │ │          Changes]       │ │
│ └──────────────────────┘ └──────────────────────────┘ │
│                                                         │
│ Version Timeline: v1.0 → v2.0 → v3.0 (current)        │
└─────────────────────────────────────────────────────────┘
```

**Components:**
* **Image Viewer**: 
  - Zoom in/out (mouse wheel hoặc buttons)
  - Pan (drag to move)
  - Fullscreen mode
  - Download button
* **Comment Section**:
  - Thread comments với reply
  - Markup tools (draw, highlight trên hình ảnh)
  - Attach file option
  - Timestamp cho mỗi comment
* **Action Buttons**:
  - "Approve" - Chấp nhận bản nháp
  - "Request Changes" - Yêu cầu chỉnh sửa
* **Version History Timeline**: 
  - Hiển thị các version với thumbnail
  - Click để xem version cũ

**User Flow:**
1. Customer nhận notification → Click vào link
2. Hiển thị draft review page
3. Customer xem bản nháp (zoom, pan nếu cần)
4. Customer có thể:
   - Approve ngay
   - Comment/Feedback
   - Request changes
5. Nếu comment → Designer nhận notification
6. Nếu approve → Status chuyển thành "Approved"

#### **3. Feedback Interface**

**Components:**
* **Comment Box**:
  - Rich text editor (bold, italic, link)
  - Emoji picker
  - @mention Designer
  - Attach file (để gửi reference)
* **Thread Comments**:
  - Reply to specific comment
  - Nested comments
  - Mark as resolved
* **Markup Tools** (cho images):
  - Draw arrow
  - Highlight area
  - Add text annotation
  - Save markup as image overlay

**Features:**
* Real-time updates (WebSocket hoặc polling)
* Notification khi có comment mới
* Mark comments as read/unread
* Filter comments (all, unread, resolved)

### **User Flow tổng thể:**

```
Designer Login
    ↓
Dashboard → Select Request
    ↓
Upload Draft Page
    ↓
[Upload File] → [Add Description] → [Submit]
    ↓
Success Notification
    ↓
Customer receives notification
    ↓
Customer views draft
    ↓
[Comment/Feedback] or [Approve]
    ↓
Designer receives notification
    ↓
Designer views feedback
    ↓
[Edit & Re-upload] or [Reply]
```

### **Design Principles:**

1. **Consistency**: Sử dụng design system thống nhất
2. **Feedback**: Hiển thị loading states, success/error messages
3. **Accessibility**: Tuân thủ WCAG 2.1 Level AA
4. **Responsive**: Hoạt động tốt trên mobile, tablet, desktop
5. **Performance**: Lazy loading images, pagination cho comments

### **Color Scheme:**

* **Primary**: #6366F1 (Indigo) - Buttons, links
* **Secondary**: #8B5CF6 (Purple) - Accents
* **Success**: #10B981 (Green) - Success messages
* **Warning**: #F59E0B (Amber) - Warnings
* **Error**: #EF4444 (Red) - Errors
* **Background**: #F9FAFB (Gray-50)
* **Text**: #111827 (Gray-900)

### **Typography:**

* **Heading**: Inter, 24px-32px, Bold
* **Body**: Inter, 16px, Regular
* **Caption**: Inter, 14px, Regular
* **Code**: Fira Code, 14px, Regular

---

**Trang trước**: [Chương 3 - Mô hình hóa hệ thống](03-Mo-Hinh-Hoa-He-Thong.md) | **Trang tiếp theo**: [Chương 5 - Demo & Báo cáo](05-Demo-Bao-Cao.md)

