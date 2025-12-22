import React, { useState } from 'react';
import ReviewFilter from '../components/ReviewFilter';
import ReviewItem from '../components/ReviewItem';
import WriteReviewModal from '../components/WriteReviewModal';
import ViewReviewModal from '../components/ViewReviewModal';
import '../styles/reviews.css';

const Reviews = () => {
  const [filter, setFilter] = useState('all');

  // 1. Khai báo state quản lý việc Mở/Đóng modal
  const [isModalOpen, setIsModalOpen] = useState(false);
  
  // 2. Khai báo state lưu sản phẩm đang được chọn để đánh giá
  const [selectedProduct, setSelectedProduct] = useState(null);

  // 3. Hàm mở modal (được gọi từ con ReviewItem)
  const handleOpenModal = (product) => {
    setSelectedProduct(product); // Lưu thông tin sản phẩm
    setIsModalOpen(true);        // Bật modal lên
  };

  // 4. Hàm đóng modal (được gọi từ nút X hoặc nút Hủy)
  const handleCloseModal = () => {
    setIsModalOpen(false);       // Tắt modal
    setSelectedProduct(null);    // Xóa sản phẩm đã chọn
  };

  // --- BUTTON "XEM ĐÁNH GIÁ" ---
  const [isViewModalOpen, setIsViewModalOpen] = useState(false);
  const [viewingReview, setViewingReview] = useState(null);

  const handleOpenViewModal = (review) => {
    setViewingReview(review);
    setIsViewModalOpen(true);
  };

  const handleCloseViewModal = () => {
    setIsViewModalOpen(false);
    setViewingReview(null);
  };

  const reviewsData = [
    {
      id: 1,
      name: 'Poster Borcelle Coffee',
      orderId: '4029',
      date: '20/11, 2025',
      image: '/Poster.png',
      isReviewed: false, // Chưa đánh giá -> Hiện nút Tím
    },
    {
      id: 2,
      name: 'Poster Merry Christmas',
      orderId: '2412',
      date: '10/11, 2025',
      image: '/MerryChristmas.png',
      isReviewed: true, // Đã đánh giá -> Hiện nút Trắng
      // Thêm dữ liệu giả để khi Xem đánh giá có cái mà hiện
      rating: 4,
      ratingConsultant: 5,
      reviewText: "File bàn giao đầy đủ, đúng deadline. Chỉ mong lần sau có thêm gợi ý về màu sắc. ",
      reviewerName: "Thanh Quyên",
      reviewDate: "10/11, 2025"
    },
    {
      id: 3,
      name: 'Poster Lễ hội ẩm thực',
      orderId: '5634',
      date: '13/10, 2025',
      image: '/poster_am_thuc.jpg',
      isReviewed: false,
    },
  ];

  return (
    <div className="reviews-page">
      <h2 className="page-title">Đánh giá sản phẩm</h2>
      
      <ReviewFilter 
        currentFilter={filter} 
        onFilterChange={setFilter} 
      />

      <div className="reviews-list">
        {reviewsData.map((product) => (
          <ReviewItem key={product.id} 
          product={product} 
          onOpenModal={handleOpenModal}
          onOpenViewModal={handleOpenViewModal}/>
        ))}
      </div>

      {/*  */}
      <WriteReviewModal 
        isOpen={isModalOpen} 
        onClose={handleCloseModal} 
        product={selectedProduct}
      />

      <ViewReviewModal 
        isOpen={isViewModalOpen}
        onClose={handleCloseViewModal}
        review={viewingReview}
      />
    </div>
  );
};

export default Reviews;