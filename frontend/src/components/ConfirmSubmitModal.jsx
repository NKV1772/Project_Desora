
import React from 'react';

const ConfirmSubmitModal = ({ isOpen, onClose, onConfirm }) => {
  if (!isOpen) return null;

  return (
    <div className="confirm-overlay">
      <div className="confirm-box">
        <h3 className="confirm-title">Gửi đánh giá ?</h3>
        
        <div className="confirm-body">
          <p>Một khi đã gửi đánh giá, bạn sẽ không thể sửa lại nữa.</p>
          <p>Bạn chắc có muốn gửi đánh giá không ?</p>
        </div>

        <div className="confirm-actions">
          <button className="btn-text-only" onClick={onClose}>Trở lại</button>
          <button className="btn-confirm-submit" onClick={onConfirm}>Gửi đánh giá</button>
        </div>
      </div>
    </div>
  );
};

export default ConfirmSubmitModal;