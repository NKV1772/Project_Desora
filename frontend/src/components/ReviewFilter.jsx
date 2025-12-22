import React from 'react';

const filters = [
  { id: 'all', label: 'Tất cả đánh giá' },
  { id: 'pending', label: 'Chưa đánh giá' },
  { id: 'reviewed', label: 'Đã đánh giá' },
  { id: 'desora', label: 'Đánh giá từ Desora' },
];

const ReviewFilter = ({ currentFilter, onFilterChange }) => {
  return (
    <div className="review-filter">
      {filters.map((filter) => (
        <button
          key={filter.id}
          className={`filter-btn ${currentFilter === filter.id ? 'active' : ''}`}
          onClick={() => onFilterChange(filter.id)}
        >
          {filter.label}
        </button>
      ))}
    </div>
  );
};

export default ReviewFilter;