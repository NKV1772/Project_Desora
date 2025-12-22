# **3. Mô hình hóa hệ thống (System Modeling)**

> Mỗi sinh viên trong nhóm 4 người chọn **1 chức năng chính** để mô hình hóa đầy đủ. Phần này trình bày phân tích chi tiết cho **US-D04: Upload Draft & Receive Feedback** (FR-03: Communication).

---

## **3.1. Biểu đồ hoạt động / BPMN (Activity Diagram / BPMN Diagram)**

### **Quy trình: Designer Upload Draft & Customer Feedback**

Mô tả quy trình từ khi Designer tải lên bản nháp đến khi nhận phản hồi từ Khách hàng:

```
[Start] 
  ↓
[Designer đăng nhập vào hệ thống]
  ↓
[Designer chọn yêu cầu đang thực hiện]
  ↓
[Designer tải lên file bản nháp thiết kế]
  ↓
{File hợp lệ?}
  ├─ [No] → [Hiển thị lỗi: File không hợp lệ] → [End]
  └─ [Yes] → [Hệ thống lưu file và tạo version mới]
              ↓
              [Hệ thống cập nhật trạng thái: "Chờ Phản hồi"]
              ↓
              [Hệ thống gửi thông báo cho Khách hàng]
              ↓
              [Khách hàng nhận thông báo]
              ↓
              [Khách hàng xem bản nháp]
              ↓
              {Khách hàng có phản hồi?}
                ├─ [Có phản hồi] → [Khách hàng comment/phản hồi]
                                    ↓
                                    [Hệ thống gửi thông báo cho Designer]
                                    ↓
                                    [Designer xem phản hồi]
                                    ↓
                                    {Cần chỉnh sửa?}
                                      ├─ [Yes] → [Designer chỉnh sửa] → [Quay lại bước upload]
                                      └─ [No] → [Designer trả lời phản hồi]
                └─ [Chấp nhận bản nháp] → [Khách hàng approve]
                                            ↓
                                            [Hệ thống cập nhật trạng thái: "Đã Duyệt"]
                                            ↓
                                            [Hệ thống gửi thông báo cho Designer]
                                            ↓
[End]
```

### **Các tác nhân tham gia:**

* **Designer**: Tải lên bản nháp, xem phản hồi, chỉnh sửa
* **Customer**: Xem bản nháp, phản hồi, approve
* **System**: Lưu file, gửi thông báo, cập nhật trạng thái

### **Các trạng thái (States):**

1. **Đang Thiết kế**: Designer đang làm việc trên dự án
2. **Chờ Phản hồi**: Đã upload bản nháp, chờ khách hàng xem và phản hồi
3. **Có Phản hồi**: Khách hàng đã gửi phản hồi, Designer cần xem và xử lý
4. **Đã Duyệt**: Khách hàng đã chấp nhận bản nháp
5. **Cần Chỉnh sửa**: Khách hàng yêu cầu chỉnh sửa, quay lại trạng thái "Đang Thiết kế"

---

## **3.2. Biểu đồ Use Case tổng thể (Use Case Diagram)**

### **Use Case Diagram cho hệ thống Desora:**

```
                    ┌─────────────────┐
                    │   Desora System │
                    └─────────────────┘
                            │
        ┌───────────────────┼───────────────────┐
        │                   │                   │
        ▼                   ▼                   ▼
┌──────────────┐    ┌──────────────┐    ┌──────────────┐
│  Customer    │    │   Designer   │    │    Admin     │
└──────────────┘    └──────────────┘    └──────────────┘
        │                   │                   │
        │                   │                   │
   ┌────┴────┐         ┌────┴────┐         ┌────┴────┐
   │         │         │         │         │         │
   ▼         ▼         ▼         ▼         ▼         ▼
[Register] [Login] [Register] [Login] [Login] [Manage Users]
   │         │         │         │         │         │
   ▼         ▼         ▼         ▼         ▼         ▼
[Submit     [View     [View     [Create   [View     [Approve
 Request]   Catalog]  Requests] Quote]    Dashboard] Content]
   │         │         │         │         │         │
   ▼         ▼         ▼         ▼         ▼         ▼
[Upload     [Filter   [Upload   [Update   [Analytics] [Manage
 Files]     Designs]  Portfolio] Status]              Promotions]
   │         │         │         │
   ▼         ▼         ▼         ▼
[View       [Review   [Upload   [Receive
 Status]    & Rate]   Draft]    Feedback] ← US-D04
   │                   │         │
   ▼                   ▼         ▼
[Chat/      [View      [View
 Comment]   Feedback]  Comments]
```

### **Use Case chi tiết: US-D04 - Upload Draft & Receive Feedback**

* **Actors**: 
  - **Primary**: Designer
  - **Secondary**: Customer, System
* **Includes**: 
  - "Validate File"
  - "Send Notification"
  - "Update Request Status"
* **Extends**: 
  - "View Feedback"
  - "Edit Draft"
  - "Approve Draft"

### **Mối quan hệ giữa các Use Case:**

* **US-D04** includes **"Validate File"**: Kiểm tra file trước khi upload
* **US-D04** includes **"Send Notification"**: Gửi thông báo khi có bản nháp mới
* **US-D04** extends **"View Feedback"**: Designer có thể xem phản hồi
* **US-D04** extends **"Approve Draft"**: Customer có thể approve bản nháp

---

## **3.3. Đặc tả Use Case (Use Case Specification)**

### **Use Case: Upload Draft & Receive Feedback (US-D04)**

| Mục             | Nội dung                                                                                                                                    |
| --------------- | ------------------------------------------------------------------------------------------------------------------------------------------ |
| **Use Case ID** | UC-D04 / FR-03                                                                                                                             |
| **Use Case Name** | Upload Draft Design & Receive Customer Feedback                                                                                            |
| **Actors**      | **Primary**: Designer<br>**Secondary**: Customer, System                                                                                  |
| **Pre-conditions** | 1. Designer đã đăng nhập vào hệ thống<br>2. Designer đã có yêu cầu thiết kế với trạng thái "Báo giá được chấp nhận" hoặc "Đang Thiết kế"<br>3. Designer có quyền truy cập vào yêu cầu đó<br>4. Customer đã chấp nhận báo giá của Designer |
| **Post-conditions** | 1. File bản nháp được lưu vào hệ thống<br>2. Trạng thái yêu cầu được cập nhật thành "Chờ Phản hồi"<br>3. Khách hàng nhận được thông báo về bản nháp mới<br>4. Lịch sử version được ghi lại<br>5. Nếu Customer approve, trạng thái chuyển thành "Đã Duyệt" |
| **Main Flow**   | 1. Designer chọn yêu cầu thiết kế từ danh sách công việc của mình<br>2. Designer nhấn nút "Upload Draft"<br>3. Hệ thống hiển thị form upload file<br>4. Designer chọn file thiết kế (JPG, PNG, PDF, PSD, AI) và nhập mô tả (optional)<br>5. Designer nhấn "Submit"<br>6. Hệ thống validate file (kiểm tra định dạng, kích thước)<br>7. Hệ thống lưu file vào storage và tạo bản ghi DraftVersion trong database<br>8. Hệ thống cập nhật trạng thái Request thành "Chờ Phản hồi"<br>9. Hệ thống gửi thông báo email và in-app notification cho Customer<br>10. Hệ thống hiển thị thông báo thành công cho Designer<br>11. Customer nhận thông báo và xem bản nháp<br>12. Customer có thể comment/phản hồi trên bản nháp<br>13. Hệ thống gửi thông báo cho Designer khi có phản hồi mới<br>14. Designer xem phản hồi và quyết định chỉnh sửa hoặc trả lời |
| **Alternate Flow** | **A1: File không hợp lệ**<br>6a. Nếu file không đúng định dạng hoặc vượt quá kích thước cho phép<br>6b. Hệ thống hiển thị lỗi và yêu cầu Designer chọn file khác<br>6c. Quay lại bước 4<br><br>**A2: Customer approve bản nháp**<br>12a. Nếu Customer chấp nhận bản nháp<br>12b. Customer nhấn nút "Approve"<br>12c. Hệ thống cập nhật trạng thái thành "Đã Duyệt"<br>12d. Hệ thống gửi thông báo cho Designer<br>12e. Use Case kết thúc<br><br>**A3: Designer chỉnh sửa dựa trên phản hồi**<br>14a. Nếu Designer quyết định chỉnh sửa<br>14b. Designer tạo version mới (quay lại Main Flow bước 4) |
| **Exception Flow** | **E1: Lỗi upload file**<br>7a. Nếu quá trình upload file thất bại (mất kết nối, lỗi server)<br>7b. Hệ thống hiển thị thông báo lỗi<br>7c. Designer có thể thử lại<br><br>**E2: Storage đầy**<br>7a. Nếu storage của Designer đã đầy<br>7b. Hệ thống thông báo và yêu cầu xóa file cũ hoặc nâng cấp gói<br><br>**E3: Customer không phản hồi trong 7 ngày**<br>12a. Hệ thống tự động gửi email nhắc nhở Customer<br>12b. Nếu sau 14 ngày vẫn không phản hồi, hệ thống thông báo cho Designer và Admin |

### **Chi tiết các bước trong Main Flow:**

#### **Bước 1-3: Designer chuẩn bị upload**
* Designer vào Dashboard → chọn tab "My Requests"
* Tìm yêu cầu có trạng thái "Đang Thiết kế" hoặc "Báo giá được chấp nhận"
* Click vào yêu cầu → hiển thị trang chi tiết
* Click nút "Upload Draft" → hiển thị modal upload

#### **Bước 4-5: Designer chọn file và submit**
* Designer có thể:
  - Drag & drop file vào vùng upload
  - Click để chọn file từ máy tính
  - Upload nhiều file (nếu cần)
* Nhập mô tả (optional): "Version 1 - Initial design", "Updated based on feedback"...
* Click "Submit"

#### **Bước 6: Validation**
* Kiểm tra định dạng: JPG, PNG, PDF, PSD, AI, SVG
* Kiểm tra kích thước: ≤ 50MB
* Kiểm tra số lượng file: ≤ 10 files/lần upload
* Nếu không hợp lệ → hiển thị lỗi cụ thể

#### **Bước 7: Lưu file và tạo bản ghi**
* Upload file lên cloud storage (AWS S3/Cloudinary)
* Tạo record trong bảng `DraftVersions`:
  - `draft_id`: UUID
  - `request_id`: ID yêu cầu
  - `version_number`: Tự động tăng (1, 2, 3...)
  - `file_url`: URL file trên storage
  - `file_name`: Tên file gốc
  - `file_size`: Kích thước (bytes)
  - `description`: Mô tả từ Designer
  - `status`: "Pending"
  - `uploaded_at`: Timestamp

#### **Bước 8: Cập nhật trạng thái**
* Cập nhật `DesignRequests.status` = "Chờ Phản hồi"
* Ghi log vào bảng `RequestHistory`

#### **Bước 9: Gửi thông báo**
* Email notification cho Customer:
  - Subject: "Bản nháp mới từ Designer [Tên]"
  - Content: Link đến bản nháp, thông tin yêu cầu
* In-app notification:
  - Hiển thị trong notification center
  - Badge số trên icon notification

#### **Bước 10: Thông báo thành công cho Designer**
* Hiển thị toast message: "Upload thành công! Khách hàng sẽ được thông báo."
* Redirect về trang chi tiết yêu cầu

#### **Bước 11-12: Customer xem và phản hồi**
* Customer nhận notification → click vào link
* Hiển thị trang xem bản nháp:
  - Image viewer với zoom, pan
  - Version history timeline
  - Comment section
* Customer có thể:
  - Approve bản nháp
  - Comment/Feedback
  - Request changes

#### **Bước 13-14: Designer nhận phản hồi**
* Designer nhận notification khi có phản hồi mới
* Vào trang chi tiết yêu cầu → tab "Feedback"
* Xem tất cả comments từ Customer
* Quyết định:
  - Trả lời comment
  - Chỉnh sửa và upload version mới

---

## **3.4. Biểu đồ lớp (Class Diagram)**

### **Class Diagram cho chức năng Upload Draft & Receive Feedback:**

```
┌─────────────────────────────────────────────────────────────┐
│                        Designer                              │
│  - designerId: String                                        │
│  - name: String                                              │
│  - email: String                                             │
│  - portfolio: Portfolio[]                                    │
│  + uploadDraft(requestId, file, description): DraftVersion   │
│  + viewFeedback(draftId): Feedback[]                         │
│  + updateDraftStatus(draftId, status): void                  │
└─────────────────────────────────────────────────────────────┘
                            │
                            │ 1
                            │
                            ▼
┌─────────────────────────────────────────────────────────────┐
│                      DesignRequest                           │
│  - requestId: String (PK)                                    │
│  - customerId: String (FK)                                  │
│  - designerId: String (FK)                                  │
│  - title: String                                             │
│  - description: String                                       │
│  - status: RequestStatus                                     │
│  - createdAt: DateTime                                       │
│  - updatedAt: DateTime                                       │
│  + updateStatus(newStatus): void                             │
│  + getDrafts(): DraftVersion[]                               │
└─────────────────────────────────────────────────────────────┘
                            │
                            │ 1
                            │
                            ▼ *
┌─────────────────────────────────────────────────────────────┐
│                     DraftVersion                             │
│  - draftId: String (PK)                                      │
│  - requestId: String (FK)                                    │
│  - versionNumber: Integer                                    │
│  - fileUrl: String                                           │
│  - fileName: String                                          │
│  - fileSize: Long                                            │
│  - description: String                                       │
│  - uploadedAt: DateTime                                      │
│  - status: DraftStatus                                       │
│  + getFeedback(): Feedback[]                                 │
│  + approve(): void                                           │
│  + reject(): void                                            │
└─────────────────────────────────────────────────────────────┘
                            │
                            │ 1
                            │
                            ▼ *
┌─────────────────────────────────────────────────────────────┐
│                        Feedback                              │
│  - feedbackId: String (PK)                                  │
│  - draftId: String (FK)                                      │
│  - customerId: String (FK)                                   │
│  - comment: String                                           │
│  - attachments: File[]                                       │
│  - createdAt: DateTime                                       │
│  - isApproved: Boolean                                       │
│  + addComment(text: String): void                            │
│  + attachFile(file: File): void                              │
│  + markAsRead(): void                                        │
└─────────────────────────────────────────────────────────────┘
                            │
                            │ 1
                            │
                            ▼
┌─────────────────────────────────────────────────────────────┐
│                      Customer                                │
│  - customerId: String                                        │
│  - name: String                                              │
│  - email: String                                             │
│  + viewDraft(draftId): DraftVersion                          │
│  + submitFeedback(draftId, comment): Feedback                │
│  + approveDraft(draftId): void                               │
│  + requestChanges(draftId, reason): void                     │
└─────────────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────────────┐
│                    NotificationService                       │
│  + sendEmailNotification(userId, type, data): void          │
│  + sendInAppNotification(userId, message): void             │
│  + createNotification(userId, type, content): Notification  │
│  + markAsRead(notificationId): void                          │
└─────────────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────────────┐
│                    FileStorageService                        │
│  + uploadFile(file: File, userId: String): String            │
│  + validateFile(file: File): Boolean                        │
│  + deleteFile(fileUrl: String): void                        │
│  + getFileUrl(fileId: String): String                       │
│  + generateThumbnail(fileUrl: String): String              │
└─────────────────────────────────────────────────────────────┘
```

### **Quan hệ giữa các lớp:**

* **Designer** → **DesignRequest**: Association (1-to-many) - Một Designer có nhiều yêu cầu
* **DesignRequest** → **DraftVersion**: Composition (1-to-many) - Một yêu cầu có nhiều version bản nháp
* **DraftVersion** → **Feedback**: Composition (1-to-many) - Một bản nháp có nhiều phản hồi
* **Customer** → **Feedback**: Association - Customer tạo phản hồi
* **NotificationService**: Dependency - Được sử dụng bởi các lớp khác để gửi thông báo
* **FileStorageService**: Dependency - Xử lý upload và lưu trữ file

### **Chi tiết các lớp:**

#### **Class: Designer**
```java
class Designer {
    private String designerId;
    private String name;
    private String email;
    private List<Portfolio> portfolio;
    
    public DraftVersion uploadDraft(String requestId, File file, String description) {
        // Validate request belongs to this designer
        // Upload file via FileStorageService
        // Create DraftVersion record
        // Send notification via NotificationService
        return draftVersion;
    }
    
    public List<Feedback> viewFeedback(String draftId) {
        // Get all feedback for this draft
        return feedbackList;
    }
}
```

#### **Class: DraftVersion**
```java
class DraftVersion {
    private String draftId;
    private String requestId;
    private Integer versionNumber;
    private String fileUrl;
    private String fileName;
    private Long fileSize;
    private String description;
    private DateTime uploadedAt;
    private DraftStatus status;
    
    public List<Feedback> getFeedback() {
        // Get all feedback for this draft
        return feedbackList;
    }
    
    public void approve() {
        this.status = DraftStatus.APPROVED;
        // Update DesignRequest status
        // Send notification to Designer
    }
}
```

---

## **3.5. Biểu đồ trình tự (Sequence Diagram)**

### **Sequence Diagram: Upload Draft & Receive Feedback**

```
Designer          DesignRequestController    FileStorageService    NotificationService    Customer
   │                         │                        │                      │                  │
   │ 1. uploadDraft()        │                        │                      │                  │
   │────────────────────────>│                        │                      │                  │
   │                         │                        │                      │                  │
   │                         │ 2. validateFile()      │                      │                  │
   │                         │───────────────────────>│                      │                  │
   │                         │                        │                      │                  │
   │                         │ 3. fileValid: true     │                      │                  │
   │                         │<───────────────────────│                      │                  │
   │                         │                        │                      │                  │
   │                         │ 4. uploadFile()        │                      │                  │
   │                         │───────────────────────>│                      │                  │
   │                         │                        │                      │                  │
   │                         │ 5. fileUrl: String     │                      │                  │
   │                         │<───────────────────────│                      │                  │
   │                         │                        │                      │                  │
   │                         │ 6. createDraftVersion()│                     │                  │
   │                         │────────────────────────┼──────────────────────┼──────────────────┤
   │                         │                        │                      │                  │
   │                         │ 7. updateStatus("Chờ Phản hồi")              │                  │
   │                         │────────────────────────┼──────────────────────┼──────────────────┤
   │                         │                        │                      │                  │
   │                         │ 8. sendNotification()  │                      │                  │
   │                         │───────────────────────>│                      │                  │
   │                         │                        │                      │                  │
   │                         │                        │ 9. sendEmail()       │                  │
   │                         │                        │─────────────────────>│                  │
   │                         │                        │                      │                  │
   │                         │                        │ 10. sendInApp()      │                  │
   │                         │                        │─────────────────────>│                  │
   │                         │                        │                      │                  │
   │ 11. success: DraftVersion│                       │                      │                  │
   │<─────────────────────────│                       │                      │                  │
   │                         │                        │                      │                  │
   │                         │                        │                      │ 12. viewDraft()  │
   │                         │                        │                      │<─────────────────│
   │                         │                        │                      │                  │
   │                         │                        │                      │ 13. submitFeedback()│
   │                         │                        │                      │──────────────────>│
   │                         │                        │                      │                  │
   │                         │ 14. createFeedback()   │                      │                  │
   │                         │<───────────────────────│                      │                  │
   │                         │                        │                      │                  │
   │                         │ 15. sendNotification() │                      │                  │
   │                         │───────────────────────>│                      │                  │
   │                         │                        │                      │                  │
   │                         │                        │ 16. sendEmail()      │                  │
   │                         │                        │─────────────────────>│                  │
   │                         │                        │                      │                  │
   │ 17. viewFeedback()       │                        │                      │                  │
   │────────────────────────>│                        │                      │                  │
   │                         │                        │                      │                  │
   │ 18. feedback: Feedback[] │                        │                      │                  │
   │<─────────────────────────│                        │                      │                  │
```

### **Chi tiết các bước trong Sequence Diagram:**

#### **Phase 1: Upload Draft (Bước 1-11)**

1. **Designer → Controller**: `uploadDraft(requestId, file, description)`
   - Designer gửi request với file và mô tả

2. **Controller → FileStorageService**: `validateFile(file)`
   - Kiểm tra định dạng, kích thước file

3. **FileStorageService → Controller**: `fileValid: true`
   - Trả về kết quả validation

4. **Controller → FileStorageService**: `uploadFile(file, userId)`
   - Upload file lên cloud storage

5. **FileStorageService → Controller**: `fileUrl: String`
   - Trả về URL của file đã upload

6. **Controller**: `createDraftVersion(requestId, fileUrl, ...)`
   - Tạo record trong database

7. **Controller**: `updateStatus(requestId, "Chờ Phản hồi")`
   - Cập nhật trạng thái yêu cầu

8. **Controller → NotificationService**: `sendNotification(customerId, "new_draft", data)`
   - Gửi yêu cầu thông báo

9. **NotificationService → Customer**: `sendEmail(...)`
   - Gửi email notification

10. **NotificationService → Customer**: `sendInApp(...)`
    - Gửi in-app notification

11. **Controller → Designer**: `success: DraftVersion`
    - Trả về kết quả thành công

#### **Phase 2: Customer Feedback (Bước 12-16)**

12. **Customer**: `viewDraft(draftId)`
    - Customer xem bản nháp

13. **Customer → Controller**: `submitFeedback(draftId, comment)`
    - Customer gửi phản hồi

14. **Controller**: `createFeedback(draftId, customerId, comment)`
    - Tạo record feedback trong database

15. **Controller → NotificationService**: `sendNotification(designerId, "new_feedback", data)`
    - Gửi thông báo cho Designer

16. **NotificationService → Designer**: `sendEmail(...)`
    - Gửi email notification

#### **Phase 3: Designer View Feedback (Bước 17-18)**

17. **Designer → Controller**: `viewFeedback(draftId)`
    - Designer xem phản hồi

18. **Controller → Designer**: `feedback: Feedback[]`
    - Trả về danh sách phản hồi

---

**Trang trước**: [Chương 2 - Phân tích yêu cầu](02-Phan-Tich-Yeu-Cau.md) | **Trang tiếp theo**: [Chương 4 - Thiết kế hệ thống](04-Thiet-Ke-He-Thong.md)

