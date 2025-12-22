import { useEffect, useState } from "react";
import { getNgay, getKhungGio } from "../api/api";

// export default function StepChonNgay({ onNext }) {
//   const [ngayList, setNgayList] = useState([]);
//   const [khungGio, setKhungGio] = useState([]);

//   useEffect(() => {
//     getNgay().then(setNgayList);
//   }, []);

//   const chonNgay = async (ngay) => {
//     const data = await getKhungGio(ngay);
//     setKhungGio(data);
//   };

//   return (
//     <div className="card">
//       <h2>Chọn ngày tư vấn</h2>

//       <div className="ngay-list">
//         {ngayList.map((n) => (
//           <button key={n.ngay} onClick={() => chonNgay(n.ngay)}>
//             {n.ngay}
//           </button>
//         ))}
//       </div>

//       <h3>Khung giờ trống</h3>

//       <div className="khunggio">
//         {khungGio.map((k) => (
//           <button key={k.maKGTV} onClick={() => onNext(k.maKGTV)}>
//             {k.batDau}
//           </button>
//         ))}
//       </div>
//     </div>
//   );
// }
export default function StepSchedule({ onNext, onBack }) {
  const [ngayList, setNgayList] = useState([]);
  const [ngay, setNgay] = useState("");
  const [slots, setSlots] = useState([]);

  useEffect(() => {
    getNgay().then(setNgayList);
  }, []);

  useEffect(() => {
    if (ngay) getKhungGio(ngay).then(setSlots);
  }, [ngay]);

  const filterBy = (type) => {
    return slots.filter((s) => {
      const hour = parseInt(s.batDau.split(":")[0]);
      if (type === "morning") return hour < 12;
      if (type === "afternoon") return hour >= 12 && hour < 18;
      return hour >= 18;
    });
  };

  return (
    <>
      <button onClick={onBack}>←</button>
      <h2>Ngày nào là thuận tiện với bạn nhất?</h2>

      <div className="calendar">
        {ngayList.map((n) => (
          <button
            key={n}
            className={ngay === n ? "active" : ""}
            onClick={() => setNgay(n)}
          >
            {n}
          </button>
        ))}
      </div>

      <h3>Khung thời gian nào?</h3>
      {["morning", "afternoon", "evening"].map((type) => (
        <div key={type}>
          {filterBy(type).map((s) => (
            <button
              key={s.maKGTV}
              onClick={() =>
                onNext({
                  ngay,
                  maKGTV: s.maKGTV,
                  thoiGian: `${s.batDau} - ${s.ketThuc}`,
                })
              }
            >
              {s.batDau} - {s.ketThuc}
            </button>
          ))}
        </div>
      ))}
    </>
  );
}
