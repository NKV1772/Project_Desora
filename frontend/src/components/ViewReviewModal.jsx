import React from 'react';
import { FaStar } from 'react-icons/fa';

const ViewReviewModal = ({ isOpen, onClose, review }) => {
  if (!isOpen || !review) return null;

  // Dữ liệu giả lập (nếu review thiếu field nào thì lấy mặc định)
  const reviewerName = review.reviewerName || 'Thanh Quyên';
  const reviewDate = review.reviewDate || '10/11, 2025';
  const productName = review.name || 'Poster Merry Christmas';
  const orderId = review.orderId || '2412';
  const productImage = review.image || '/MerryChristmas.png'; // Đường dẫn ảnh mẫu
  const price = '150.000';
  const rating1 = review.rating || 5;
  const rating2 = review.ratingConsultant || 4;
  const reviewContent = review.reviewText || "File bàn giao đầy đủ, đúng deadline. Chỉ mong lần sau có thêm gợi ý về màu sắc.";

  return (
    <div className="modal-overlay" onClick={onClose}>
      <div className="modal-container" onClick={(e) => e.stopPropagation()}>
     
        {/* Header: Chỉ hiện chữ, nền trắng liền mạch */}
        <div className="view-modal-header">
          <h2>Đánh giá sản phẩm</h2>
        </div>

        <div className="white-card">
          
          {/* Hàng 1: Sản phẩm + Nút chỉnh sửa */}
          <div className="vm-product-row">
            <div className="vm-prod-left">
              <img src={productImage} alt={productName} className="vm-prod-img" />
              <div className="vm-prod-info">
                <h3>{productName}</h3>
                <p className="vm-gray-text">Đơn hàng #{orderId}</p>
                <p className="vm-price">Thành tiền: {price} <sup>đ</sup></p>
              </div>
            </div>
            {/* Nút chỉnh sửa nằm bên phải */}
            <div className="vm-prod-right">
                <button className="btn-red-outline">Chỉnh sửa</button>
            </div>
          </div>

          <div className="vm-divider"></div>

          {/* Hàng 2: Avatar + Tên + Ngày tháng */}
          <div className="vm-user-row">
              <div className="vm-user-left">
                <img src="https://statictuoitre.mediacdn.vn/thumb_w/640/2017/7-1512755474943.jpg" alt={reviewerName} className="vm-avatar" />
                <span className="vm-username">{reviewerName}</span>
              </div>
              <div className="vm-user-right">
                <span className="vm-date">{reviewDate}</span>
              </div>
          </div>

          {/* Hàng 3: Chi tiết đánh giá */}
          <div className="vm-review-content">
              {/* Sao đánh giá */}
              <div className="vm-rating-line">
                  <span className="vm-label">Chất lượng sản phẩm:</span>
                  <div className="vm-stars">
                    {[...Array(5)].map((_, i) => (<FaStar key={i} className={i < rating1 ? "star active" : "star"} />))}
                  </div>
              </div>
              <div className="vm-rating-line">
                  <span className="vm-label">Dịch vụ tư vấn:</span>
                  <div className="vm-stars">
                    {[...Array(5)].map((_, i) => (<FaStar key={i} className={i < rating2 ? "star active" : "star"} />))}
                  </div>
              </div>
              
              {/* Nội dung text */}
              <div className="vm-text-block">
                  <span className="vm-label">Nội dung nhận xét:</span>
                  <p>{reviewContent}</p>
              </div>
          </div>

          {/* Footer: Nút OK */}
          <div className="view-modal-footer">
            <button className="btn-red-outline btn-ok" onClick={onClose}>OK</button>
          </div>

        </div>
      </div>
    </div>
  );
};

export default ViewReviewModal;