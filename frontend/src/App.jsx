// import { useState } from 'react'
// import reactLogo from './assets/react.svg'
// import viteLogo from '/vite.svg'
// import './App.css'

// function App() {
//   const [count, setCount] = useState(0)

//   return (
//     <>
//       <div>
//         <a href="https://vite.dev" target="_blank">
//           <img src={viteLogo} className="logo" alt="Vite logo" />
//         </a>
//         <a href="https://react.dev" target="_blank">
//           <img src={reactLogo} className="logo react" alt="React logo" />
//         </a>
//       </div>
//       <h1>Vite + React</h1>
//       <div className="card">
//         <button onClick={() => setCount((count) => count + 1)}>
//           count is {count}
//         </button>
//         <p>
//           Edit <code>src/App.jsx</code> and save to test HMR
//         </p>
//       </div>
//       <p className="read-the-docs">
//         Click on the Vite and React logos to learn more
//       </p>
//     </>
//   )
// }

// export default App
// import Home from "./pages/Home";

// function App() {
//   return <Home />;
// }

// export default App;

// src/App.jsx
import { Routes, Route } from "react-router-dom";
import Home from "./pages/Home";
import Reviews from "./pages/Reviews";
import Layout from './components/Layout';

function App() {
  return (
    <Routes>
      <Route path="/request-form" element={<Home />} />
      
      
      <Route path="/reviews" element={<Layout><Reviews /></Layout>} />

      {/* Các trang khác tạm thời chưa có nội dung thì trỏ tạm về Home hoặc tạo component mới */}
      {/* <Route path="/request-form" element={<Layout><h2>Trang Form Yêu Cầu</h2></Layout>} /> */}
      {/* <Route path="/my-orders" element={<Layout><h2>Trang Đơn Hàng</h2></Layout>} /> */}
      {/* ... */}
    </Routes>
  );
}

export default App;