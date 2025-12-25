import React, { useState, useEffect } from 'react';
import { FaStar, FaTimes } from 'react-icons/fa';
import ConfirmSubmitModal from './ConfirmSubmitModal';

const WriteReviewModal = ({ isOpen, onClose, product }) => {

  // 1. Khai báo các biến lưu trữ dữ liệu
  const [rating, setRating] = useState(0);             // Sao chất lượng sản phẩm
  const [ratingDesigner, setRatingDesigner] = useState(0); // Sao dịch vụ 1
  const [ratingConsultant, setRatingConsultant] = useState(0); // Sao dịch vụ 2
  const [reviewText, setReviewText] = useState("");    // Nội dung text
  const [isConfirmOpen, setIsConfirmOpen] = useState(false);

// Reset lại form mỗi khi mở modal
  useEffect(() => {
    if (isOpen && product) {
      // KIỂM TRA: Nếu sản phẩm này ĐÃ được đánh giá (tức là đang Chỉnh sửa)
      if (product.isReviewed) {
        // -> Lấy dữ liệu cũ đổ vào form
        setRating(product.rating || 0);                  // Sao chính
        setRatingDesigner(product.ratingDesigner || 0);  // Sao designer
        setRatingConsultant(product.ratingConsultant || 0); // Sao tư vấn
        setReviewText(product.reviewText || "");         // Nội dung text
      } else {
        // -> Nếu chưa đánh giá (Viết mới) -> Reset về 0
        setRating(0);
        setRatingDesigner(0);
        setRatingConsultant(0);
        setReviewText("");
      }
    }
  }, [isOpen, product]);

  

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

    // Hàm hỗ trợ format tiền tệ (thêm vào trước lệnh return)
    const formatCurrency = (value) => {
      if (!value) return '0';
      // Chuyển về dạng số rồi format
      return Number(value.toString().replace(/\./g, '')).toLocaleString('vi-VN');
    };

// Hàm xử lý "Gửi đánh giá"
  const handlePreSubmit = () => {
// Kiểm tra các trường nhập liệu
    const isRatingEmpty = rating === 0;
    const isServiceEmpty = ratingDesigner === 0 && ratingConsultant === 0;
    const isTextEmpty = reviewText.trim() === "";

    // Không có trường nào được nhập => báo lỗi
    if (isRatingEmpty && isServiceEmpty && isTextEmpty) {
      alert("Vui lòng chấm điểm sao hoặc viết nội dung đánh giá trước khi gửi!");
      return;
    }
// Đã đánh giá trước đó
    if (product.isReviewed) {
        setIsConfirmOpen(true); //nút xác nhận
    } else {
        alert("Đã ghi nhận đánh giá thành công!"); 
        handleFinalSubmit();
    }
  };

  // Hàm Lưu cuối cùng
  const handleFinalSubmit = () => {
    // Log dữ liệu
    console.log("Submit Review:", {
        id: product.id,
        rating,
        ratingDesigner,
        ratingConsultant,
        reviewText
    });
    
    // Thông báo update thành công
    if (product.isReviewed) {
        alert("Nội dung đánh giá đã được cập nhật!");
    }

    setIsConfirmOpen(false); // Đóng popup con
    onClose();               // Đóng modal to
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
          <div className="modal-prod-price">Thành tiền: <span>{formatCurrency(product?.price)}</span><sup>đ</sup></div>
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
            <button className="submit-review-btn" onClick={handlePreSubmit}>
              Gửi đánh giá
            </button>
          </div>

          {/* --- Xác nhận gửi đánh giá --- */}
          <ConfirmSubmitModal 
            isOpen={isConfirmOpen}
            onClose={() => setIsConfirmOpen(false)} 
            onConfirm={handleFinalSubmit}           
          />

        </div>
      </div>
    </div>
  );
};

export default WriteReviewModal;