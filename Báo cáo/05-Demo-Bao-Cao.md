# **5. Demo & Báo cáo (Demo & Reporting)**

---

## **5.1. Prototype Website - Các màn hình demo chính**

### **1. Homepage**

**Mục đích**: Giới thiệu Desora, showcase portfolio nổi bật, thu hút người dùng

**Nội dung:**
* Hero section với tagline: "Kết nối bạn với Designer chuyên nghiệp"
* Featured Portfolio gallery (carousel)
* Statistics: "1000+ Designer", "5000+ Dự án hoàn thành"
* Call-to-action buttons: "Tìm Designer", "Trở thành Designer"
* Testimonials từ khách hàng

**Screenshot mô tả:**
```
┌─────────────────────────────────────────────────────────┐
│ [Logo] Desora          [Login] [Sign Up]                │
├─────────────────────────────────────────────────────────┤
│                                                          │
│         Kết nối bạn với Designer chuyên nghiệp         │
│                                                          │
│    [Tìm Designer]  [Trở thành Designer]                 │
│                                                          │
│ ┌────┐ ┌────┐ ┌────┐ ┌────┐                            │
│ │Port│ │Port│ │Port│ │Port│  Featured Portfolio        │
│ └────┘ └────┘ └────┘ └────┘                            │
│                                                          │
│ 1000+ Designer | 5000+ Projects | 98% Satisfaction     │
└─────────────────────────────────────────────────────────┘
```

---

### **2. Customer Portal**

#### **2.1. Đăng ký/Đăng nhập**

**Đăng ký:**
* Form: Email, Password, Full Name, Phone, Role (Customer/Designer)
* Validation real-time
* Terms & Conditions checkbox
* Social login (Google, Facebook) - optional

**Đăng nhập:**
* Form: Email, Password
* "Remember me" checkbox
* "Forgot password?" link
* Social login options

#### **2.2. Browse Catalog (Portfolio)**

**Features:**
* Grid layout với portfolio cards
* Filter sidebar:
  - Category (Logo, Banner, Website...)
  - Style (Minimalist, Modern, Vintage...)
  - Price range
  - Rating
* Search bar với autocomplete
* Sort options: Newest, Popular, Rating
* Pagination hoặc infinite scroll

**Portfolio Card:**
```
┌─────────────────┐
│   [Image]       │
│                 │
│  Title          │
│  Designer Name  │
│  ⭐⭐⭐⭐⭐      │
│  Category       │
└─────────────────┘
```

#### **2.3. Submit Request Form**

**Form fields:**
* Title (required)
* Description (required, rich text editor)
* Category dropdown (required)
* Budget (slider hoặc input)
* Deadline (date picker)
* Reference files (upload multiple)
* Additional requirements (optional)

**Validation:**
* Title: 5-100 characters
* Description: Minimum 50 characters
* Budget: Minimum 100,000 VND
* Deadline: At least 3 days from today

#### **2.4. View Request Status**

**Dashboard layout:**
* Tabs: All, Pending, In Progress, Completed, Cancelled
* Request cards với:
  - Title, Status badge, Date
  - Designer info (nếu đã assign)
  - Progress bar
  - Action buttons

**Request Detail Page:**
* Request information
* Quote section (nếu có)
* Draft section với version history
* Feedback section
* Chat/Message section

#### **2.5. View Draft & Submit Feedback**

**Draft Viewer:**
* Image viewer với zoom, pan
* Version selector
* Comment panel
* Action buttons: Approve, Request Changes

**Feedback Form:**
* Comment textarea
* Markup tools (draw, highlight)
* Attach file option
* Submit button

---

### **3. Designer Dashboard**

#### **3.1. View Requests**

**Request List:**
* Filter: All, Pending Quote, In Progress, Waiting Feedback
* Sort: Newest, Deadline, Budget
* Request cards với:
  - Title, Category, Budget
  - Customer info
  - Status
  - Action: View, Quote, Upload Draft

#### **3.2. Create Quote**

**Quote Form:**
* Price input (required)
* Estimated days (required)
* Description (rich text editor)
* Terms & conditions
* Submit button

**Preview:**
* Show quote summary trước khi submit
* Edit option

#### **3.3. Upload Draft** ⭐ (US-D04)

**Upload Interface:**
* Drag & drop area
* File browser
* Preview selected files
* Description textarea
* Version number (auto-increment)
* Submit button

**Success State:**
* Success message
* Redirect to request detail
* Notification sent to customer

#### **3.4. View Feedback**

**Feedback List:**
* Grouped by draft version
* Unread indicator
* Timestamp
* Customer name
* Comment preview
* Click to view full comment

**Feedback Detail:**
* Full comment text
* Attached files (nếu có)
* Markup annotations (nếu có)
* Reply button
* Mark as resolved

#### **3.5. Manage Portfolio**

**Portfolio List:**
* Grid layout
* Add new button
* Edit/Delete actions

**Add/Edit Portfolio:**
* Title (required)
* Category (required)
* Upload image (required)
* Description
* Tags
* Submit for approval

---

### **4. Admin Panel**

#### **4.1. Manage Users**

**User List:**
* Table với columns: Name, Email, Role, Status, Actions
* Filter: Role, Status
* Search: Name, Email
* Actions: Edit, Deactivate, Delete

**User Detail:**
* User information
* Activity log
* Statistics

#### **4.2. Approve Content**

**Pending Approvals:**
* Portfolio pending approval
* Tabs: Portfolio, Other
* Approve/Reject buttons
* Preview content

#### **4.3. View Analytics**

**Dashboard:**
* Total users (Customer, Designer)
* Total requests
* Conversion rate (Request → Quote Accepted)
* Revenue (nếu có payment)
* Charts: Requests over time, Popular categories

---

## **5.2. Công nghệ đề xuất**

### **Frontend:**

* **Framework**: React.js với TypeScript
* **UI Library**: Tailwind CSS + Headless UI
* **State Management**: Redux Toolkit
* **Routing**: React Router v6
* **HTTP Client**: Axios
* **Form Handling**: React Hook Form
* **Image Viewer**: react-image-gallery hoặc custom
* **Rich Text Editor**: React Quill hoặc TipTap
* **Charts**: Recharts hoặc Chart.js

### **Backend:**

* **Framework**: Node.js + Express hoặc Laravel (PHP)
* **Database**: PostgreSQL
* **ORM**: Sequelize (Node.js) hoặc Eloquent (Laravel)
* **Authentication**: JWT (jsonwebtoken)
* **File Upload**: Multer (Node.js) hoặc Laravel Storage
* **Validation**: Joi (Node.js) hoặc Laravel Validation
* **Email**: Nodemailer (Node.js) hoặc Laravel Mail

### **File Storage:**

* **Cloud Storage**: AWS S3, Google Cloud Storage, hoặc Cloudinary
* **CDN**: CloudFront (AWS) hoặc Cloudflare
* **Image Processing**: Sharp (Node.js) hoặc Intervention Image (Laravel)

### **Deployment:**

* **Frontend**: Vercel, Netlify, hoặc GitHub Pages
* **Backend**: Heroku, Railway, hoặc DigitalOcean
* **Database**: AWS RDS, Google Cloud SQL, hoặc Supabase
* **Domain**: Namecheap, GoDaddy

### **Development Tools:**

* **Version Control**: Git + GitHub
* **Package Manager**: npm hoặc yarn
* **Code Quality**: ESLint, Prettier
* **Testing**: Jest (unit tests), Cypress (E2E tests)
* **API Documentation**: Swagger/OpenAPI

---

## **5.3. Demo Script**

### **Scenario 1: Customer tạo yêu cầu**

1. **Login** với tài khoản Customer
2. **Browse Catalog** - Xem portfolio của các Designer
3. **Submit Request** - Tạo yêu cầu thiết kế logo
4. **View Status** - Xem trạng thái yêu cầu (Pending Quote)

### **Scenario 2: Designer báo giá và upload draft**

1. **Login** với tài khoản Designer
2. **View Requests** - Xem danh sách yêu cầu mới
3. **Create Quote** - Tạo báo giá cho yêu cầu
4. **Customer accepts quote** - (Giả lập)
5. **Upload Draft** - Upload bản nháp thiết kế
6. **View Feedback** - Xem phản hồi từ Customer

### **Scenario 3: Customer phản hồi và approve**

1. **Customer receives notification** - Thông báo có bản nháp mới
2. **View Draft** - Xem bản nháp
3. **Submit Feedback** - Gửi comment yêu cầu chỉnh sửa
4. **Designer uploads new version** - (Giả lập)
5. **Approve Draft** - Chấp nhận bản nháp cuối cùng

### **Scenario 4: Admin quản lý**

1. **Login** với tài khoản Admin
2. **View Dashboard** - Xem tổng quan hệ thống
3. **Approve Portfolio** - Duyệt portfolio mới
4. **Manage Users** - Xem danh sách users
5. **View Analytics** - Xem báo cáo thống kê

---

## **5.4. Video Demo (nếu có)**

**Nội dung video:**
* Giới thiệu hệ thống (30 giây)
* Walkthrough các chức năng chính (3-5 phút)
* Highlight tính năng US-D04: Upload Draft & Feedback (1-2 phút)
* Kết luận (30 giây)

**Công cụ quay video:**
* OBS Studio (screen recording)
* Loom (online screen recorder)
* QuickTime (Mac)

---

## **5.5. Link Demo (nếu deploy)**

**Các link đề xuất:**
* **Frontend**: https://desora-demo.vercel.app
* **Backend API**: https://desora-api.railway.app
* **API Docs**: https://desora-api.railway.app/docs

**Credentials cho demo:**
* Customer: customer@demo.com / password123
* Designer: designer@demo.com / password123
* Admin: admin@demo.com / password123

---

**Trang trước**: [Chương 4 - Thiết kế hệ thống](04-Thiet-Ke-He-Thong.md) | **Trang tiếp theo**: [Chương 6 - Kết luận và hướng phát triển](06-Ket-Luan-Huong-Phat-Trien.md)

