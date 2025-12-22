import React, { useState } from 'react';
import ReviewFilter from '../components/ReviewFilter';
import ReviewItem from '../components/ReviewItem';
import '../styles/reviews.css';

const Reviews = () => {
  const [filter, setFilter] = useState('all');

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
          <ReviewItem key={product.id} product={product} />
        ))}
      </div>
    </div>
  );
};

export default Reviews;