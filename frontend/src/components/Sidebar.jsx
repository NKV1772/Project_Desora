import React from 'react';
import { useLocation, Link } from 'react-router-dom'; // Import thêm Link và useLocation
import { FaHome, FaShoppingCart, FaStar, FaUser, FaRegFileAlt } from 'react-icons/fa';
import { BiMessageSquareDetail } from 'react-icons/bi';
import '../styles/sidebar.css';

const Sidebar = () => {
  const location = useLocation(); // Lấy đường dẫn hiện tại (ví dụ: /reviews)

  const menuItems = [
    // Thêm thuộc tính 'path' cho mỗi mục
    { id: 1, label: 'Trang chủ', icon: <FaHome size={20} />, path: '/' },
    { id: 2, label: 'Tạo yêu cầu', icon: <BiMessageSquareDetail size={20} />, path: '/request-form' },
    { id: 3, label: 'Danh sách yêu cầu', icon: <FaRegFileAlt size={20} />, path: '/request-list' },
    { id: 4, label: 'Đơn hàng của tôi', icon: <FaShoppingCart size={20} />, path: '/my-orders' },
    { id: 5, label: 'Xem đánh giá', icon: <FaStar size={20} />, path: '/reviews' },
    { id: 6, label: 'Tài khoản của tôi', icon: <FaUser size={20} />, path: '/profile' },
  ];

  return (
    <div className="sidebar">
      <div className="sidebar-menu">
        {menuItems.map((item) => {
          // Kiểm tra xem đường dẫn hiện tại có trùng với path của item không
          const isActive = location.pathname === item.path;

          return (
            <Link 
              to={item.path} 
              key={item.id} 
              className={`menu-item ${isActive ? 'active' : ''}`}
            >
              <span className="menu-icon">{item.icon}</span>
              <span className="menu-label">{item.label}</span>
            </Link>
          );
        })}
      </div>
    </div>
  );
};

export default Sidebar;