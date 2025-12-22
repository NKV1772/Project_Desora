import React from 'react';
import Sidebar from './Sidebar';
import '../styles/layout.css';
import { FaBell, FaSearch, FaEllipsisH, FaBars } from 'react-icons/fa';

const Layout = ({ children }) => {
  return (
    <div className="app-container">
      {/* --- Phần Header --- */}
      <header className="top-header">
        <div className="header-left">
           {/* Logo Desora */}
          <div className="logo-area">
             <span style={{ fontSize: '24px', marginRight: '5px' }}>
                <img src="/2-removebg-preview.png" 
                alt="User" 
                style={{ 
                height: '40px',    /* Chiều cao cố định */
                width: 'auto',     /* Chiều rộng tự động theo tỉ lệ */
                marginRight: '10px' /* Khoảng cách với chữ Desora */
                }}
                />
            </span> 
             Desora
          </div>
          
          {/* Nút Menu hamburger */}
          <button className="icon-btn menu-toggle">
            <FaBars />
          </button>
        </div>

        {/* Thanh tìm kiếm ở giữa */}
        <div className="search-container">
          <FaSearch className="search-icon" />
          <input type="text" placeholder="Search now" className="search-input" />
        </div>
        
        {/* Các icon bên phải (Chuông, Avatar, 3 chấm) */}
        <div className="header-right">
          <button className="icon-btn">
            <FaBell />
          </button>
          
          <div className="user-avatar">
            {/* Ảnh avt */}
            <img src="/2.png" alt="User" />
          </div>
          
          <button className="icon-btn">
            <FaEllipsisH />
          </button>
        </div>
      </header>

      {/* --- Phần Thân: Sidebar + Nội dung --- */}
      <div className="main-body">
        <Sidebar />
        
        <div className="page-content">
          {children}
        </div>
      </div>
    </div>
  );
};

export default Layout;