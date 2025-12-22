// import { useState } from "react";

// export default function StepEmail({ onNext }) {
//   const [email, setEmail] = useState("");

//   return (
//     <div className="card">
//       <h2>Tạo yêu cầu thiết kế</h2>

//       <input
//         placeholder="Email của bạn"
//         value={email}
//         onChange={(e) => setEmail(e.target.value)}
//       />

//       <button onClick={() => onNext(email)}>Bắt đầu</button>
//     </div>
//   );
// }

export default function StepEmail({ email, onNext }) {
  return (
    <>
      <h2>Tạo yêu cầu thiết kế</h2>
      <label>Email của bạn</label>
      <input
        value={email}
        onChange={(e) => onNext(e.target.value)}
        placeholder="example@gmail.com"
      />
      <button onClick={() => onNext(email)} disabled={!email}>
        Bắt đầu
      </button>
    </>
  );
}
