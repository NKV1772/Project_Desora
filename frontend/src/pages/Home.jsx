import { useState } from "react";
import ModalTuVan from "../components/ModalTuVan";
import "./Home.css";

export default function Home() {
  const [email, setEmail] = useState("");
  const [openModal, setOpenModal] = useState(false);

  return (
    <div className="home-root">
      <header className="home-header">
        <div className="brand">Desora</div>
        <nav>
          <button className="btn-ghost">Đăng nhập</button>
        </nav>
      </header>

      <main className="home-main">
        <section className="hero">
          <h1>
            Thiết kế sáng tạo <br />
            Chạm cảm xúc
          </h1>
          <p>Đáp ứng mọi nhu cầu của bạn</p>
        </section>

        <aside className="card">
          <h2>Tạo yêu cầu thiết kế</h2>

          <label>Email của bạn</label>
          <input
            placeholder="example@gmail.com"
            value={email}
            onChange={(e) => setEmail(e.target.value)}
          />

          <button
            className="primary"
            onClick={() => setOpenModal(true)}
            disabled={!email}
          >
            Bắt đầu
          </button>
        </aside>
      </main>

      {openModal && (
        <ModalTuVan email={email} onClose={() => setOpenModal(false)} />
      )}
    </div>
  );
}
