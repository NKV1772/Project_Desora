import React, { useState, useEffect } from 'react';
import { FaStar, FaTimes } from 'react-icons/fa';

const WriteReviewModal = ({ isOpen, onClose, product }) => {
  // Reset lại form mỗi khi mở modal
  useEffect(() => {
    if (isOpen) {
      setRating(0);
      setRatingDesigner(0);
      setRatingConsultant(0);
      setReviewText("");
    }
  }, [isOpen]);

  // 1. Khai báo các biến lưu trữ dữ liệu
  const [rating, setRating] = useState(0);             // Sao chất lượng sản phẩm
  const [ratingDesigner, setRatingDesigner] = useState(0); // Sao dịch vụ 1
  const [ratingConsultant, setRatingConsultant] = useState(0); // Sao dịch vụ 2
  const [reviewText, setReviewText] = useState("");    // Nội dung text

  if (!isOpen) return null;

  // Hàm nhấn button gợi ý đánh giá, điền vào textarea
  const handleTagClick = (text) => {
    // Nếu ô đang trống -> Điền luôn
    if (reviewText.trim() === "") {
      setReviewText(text);
    } 
    // Nếu đã có nội dung -> Thêm dấu phẩy và nối tiếp nội dung mới
    else {
      setReviewText(reviewText + ", " + text);
    }
  };

  // Hàm gửi đánh giá
  const handleSubmit = () => {
    // Kiểm tra: báo lỗi khi không điền sao, nhập nội dung
    if (rating === 0 && reviewText.trim() === "") {
      alert("Vui lòng chấm điểm sao hoặc viết nội dung đánh giá trước khi gửi!");
      return;
    }

    // Đánh giá sao hoặc viết nội dung
    alert("Đánh giá của bạn đã được ghi nhận! Cảm ơn bạn.");
    onClose();
  };

  return (
    <div className="modal-overlay" onClick={onClose}>
      <div className="modal-container" onClick={(e) => e.stopPropagation()}>
        
        <div className="modal-header-area">
          <h2>Đánh giá sản phẩm</h2>
          <button className="close-btn" onClick={onClose}><FaTimes /></button>
        </div>

        {/* Khối thông tin sản phẩm */}
        <div className="white-card product-card">
          <div className="card-left">
            <img src={product?.image} alt="Product" className="modal-prod-img" />
            <div className="modal-prod-info">
              <h3>{product?.name}</h3>
              <p>Đơn hàng #{product?.orderId}</p>
            </div>
          </div>
          <div className="modal-prod-price">Thành tiền: <span>150.000đ</span></div>
        </div>

        {/* Khối Form đánh giá */}
        <div className="white-card form-card">
          <div className="section-title">Chất lượng sản phẩm</div>
          
          {/* SAO CHÍNH (BIG STARS) */}
          <div className="star-rating big-stars">
            {[...Array(5)].map((_, index) => (
              <FaStar 
                key={index} 
                className={index < rating ? "star active" : "star"}
                onClick={() => setRating(index + 1)}
              />
            ))}
          </div>

          <div className="modal-tags">
            <button className="tag-btn" onClick={() => handleTagClick("Tốc độ phục vụ nhanh")}>
                Tốc độ phục vụ nhanh
            </button>
            <button className="tag-btn" onClick={() => handleTagClick("Chất lượng thiết kế đẹp")}>
                Chất lượng thiết kế đẹp
            </button>
            <button className="tag-btn" onClick={() => handleTagClick("Tư vấn nhiệt tình")}> 
                Tư vấn nhiệt tình
            </button>
          </div>

          {/* TEXTAREA */}
          <div className="modal-input-area">
            <textarea 
              placeholder="Viết cảm nhận của bạn về sản phẩm này nhé..."
              maxLength={150}
              value={reviewText} // Gắn giá trị vào biến state
              onChange={(e) => setReviewText(e.target.value)} // Cập nhật state khi gõ
            ></textarea>
            <span className="char-count">{reviewText.length}/150</span>
          </div>

          {/* ĐÁNH GIÁ DỊCH VỤ */}
          <div className="modal-services">
            <h4>Về dịch vụ</h4>
            
            {/* Dòng 1: Designer */}
            <div className="service-row">
              <span>Dịch vụ của Designer</span>
              <div className="star-rating small-stars">
                 {[...Array(5)].map((_, i) => (
                   <FaStar 
                     key={i} 
                     // Logic tô màu cho sao nhỏ
                     className={i < ratingDesigner ? "star active" : "star"}
                     // Logic click cho sao nhỏ
                     onClick={() => setRatingDesigner(i + 1)}
                   />
                 ))}
              </div>
            </div>

            {/* Dòng 2: Tư vấn */}
            <div className="service-row">
              <span>Dịch vụ tư vấn</span>
              <div className="star-rating small-stars">
                 {[...Array(5)].map((_, i) => (
                   <FaStar 
                     key={i} 
                     className={i < ratingConsultant ? "star active" : "star"}
                     onClick={() => setRatingConsultant(i + 1)}
                   />
                 ))}
              </div>
            </div>
          </div>

          <div className="modal-footer-area">
            <button className="submit-review-btn" onClick={handleSubmit}>
              Gửi đánh giá
            </button>
          </div>

        </div>
      </div>
    </div>
  );
};

export default WriteReviewModal;