import React from 'react';
// import { FaPen, FaEye } from 'react-icons/fa'; 

const ReviewItem = ({ product, onOpenModal }) => {
  return (
    <div className="review-item">
      <div className="item-left">
        <img 
          src={product.image} 
          alt={product.name} 
          className="product-image" 
        />
        <div className="item-info">
          <h3>{product.name}</h3>
          <p className="order-info">Đơn hàng #{product.orderId}</p>
          <p className="order-date">{product.date}</p>
        </div>
      </div>

      <div className="item-right">
        {!product.isReviewed ? (
          <button className="btn-action btn-primary"
          onClick={() => onOpenModal(product)}
          >
            {
            <span>✎</span>}
            <span>Viết đánh giá</span>
          </button>
        ) : (
          <button className="btn-action btn-outline">
            <span>Xem đánh giá</span>
          </button>
        )}
      </div>
    </div>
  );
};

export default ReviewItem;