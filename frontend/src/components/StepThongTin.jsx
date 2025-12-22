import { useState } from "react";
import { createYeuCauTuVan } from "../api/api";

// export default function StepThongTin({ formData, onSuccess }) {
//   const [data, setData] = useState({
//     hoTen: "",
//     sdt: "",
//     tenShop: "",
//     nganSach: "trung_binh",
//     nhuCau: [],
//     moTa: "",
//   });

//   const submit = async () => {
//     const payload = {
//       ...formData,
//       ...data,
//     };

//     const res = await createYeuCauTuVan(payload);
//     if (res.success) onSuccess();
//   };

//   return (
//     <div className="card">
//       <h2>Thông tin liên hệ</h2>

//       <input
//         placeholder="Họ tên"
//         onChange={(e) => setData({ ...data, hoTen: e.target.value })}
//       />
//       <input value={formData.email} disabled />
//       <input
//         placeholder="SĐT"
//         onChange={(e) => setData({ ...data, sdt: e.target.value })}
//       />
//       <input
//         placeholder="Tên shop"
//         onChange={(e) => setData({ ...data, tenShop: e.target.value })}
//       />

//       <h4>Nhu cầu</h4>
//       <label>
//         <input
//           type="checkbox"
//           onChange={() => setData({ ...data, nhuCau: [...data.nhuCau, 1] })}
//         />
//         Banner
//       </label>

//       <h4>Ngân sách</h4>
//       <select onChange={(e) => setData({ ...data, nganSach: e.target.value })}>
//         <option value="thap">Thấp</option>
//         <option value="trung_binh">Trung bình</option>
//         <option value="cao">Cao</option>
//       </select>

//       <textarea
//         placeholder="Mô tả thêm"
//         onChange={(e) => setData({ ...data, moTa: e.target.value })}
//       />

//       <button onClick={submit}>Xác nhận</button>
//     </div>
//   );
// }
export default function StepForm({ data, onBack, onSuccess }) {
  const [form, setForm] = useState({
    hoTen: "",
    sdt: "",
    tenShop: "",
    nganSach: "",
    moTa: "",
  });
  const [loading, setLoading] = useState(false);

  const handleChange = (e) => {
    setForm({ ...form, [e.target.name]: e.target.value });
  };

  const handleSubmit = async () => {
    setLoading(true);

    const payload = {
      email: data.email,
      hoTen: form.hoTen,
      sdt: form.sdt,
      tenShop: form.tenShop,
      nganSach: form.nganSach,
      moTa: form.moTa,
      maKGTV: data.maKGTV,
      nhuCau: [], // nếu sau này có checkbox nhu cầu
    };

    const res = await createYeuCauTuVan(payload);
    setLoading(false);

    if (res.success) {
      onSuccess();
    } else {
      alert("Có lỗi xảy ra, vui lòng thử lại");
    }
  };

  return (
    <>
      <button onClick={onBack}>←</button>

      <h2>Sắp hoàn thành rồi!</h2>
      <p>
        Tư vấn vào <b>{data.ngay}</b> — <b>{data.thoiGian}</b>
      </p>

      <input name="hoTen" placeholder="Họ và tên *" onChange={handleChange} />

      <input value={data.email} disabled />

      <input
        name="tenShop"
        placeholder="Tên cửa hàng *"
        onChange={handleChange}
      />

      <input name="sdt" placeholder="Số điện thoại *" onChange={handleChange} />

      <div className="radio-group">
        {["Dưới 300k", "300k - 500k", "500k - 1 triệu", "Trên 1 triệu"].map(
          (v) => (
            <label key={v}>
              <input
                type="radio"
                name="nganSach"
                value={v}
                onChange={handleChange}
              />
              {v}
            </label>
          )
        )}
      </div>

      <textarea name="moTa" placeholder="Mô tả thêm" onChange={handleChange} />

      <button onClick={handleSubmit} disabled={loading}>
        {loading ? "Đang gửi..." : "Xác nhận"}
      </button>
    </>
  );
}
