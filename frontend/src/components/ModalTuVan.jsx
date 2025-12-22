import { useState } from "react";
import StepEmail from "./StepEmail";
import StepChonNgay from "./StepChonNgay";
import StepThongTin from "./StepThongTin";
import StepThanhCong from "./StepThanhCong";
import "../styles/modal.css";

export default function ModalTuVan({ email, onClose }) {
  const [step, setStep] = useState(1);
  const [data, setData] = useState({
    email,
    ngay: "",
    maKGTV: null,
    thoiGian: "",
  });

  const updateData = (v) => setData((prev) => ({ ...prev, ...v }));

  return (
    <div className="overlay">
      <div className="modal">
        <button className="close" onClick={onClose}>
          ×
        </button>

        {step === 1 && (
          <StepEmail
            email={data.email}
            onNext={(value) => {
              updateData({ email: value });
              setStep(2);
            }}
          />
        )}

        {step === 2 && (
          <StepChonNgay
            onNext={(payload) => {
              updateData(payload);
              setStep(3);
            }}
            onBack={() => setStep(1)}
          />
        )}

        {step === 3 && (
          <StepThongTin
            data={data}
            onBack={() => setStep(2)}
            onSuccess={() => setStep(4)}
          />
        )}

        {step === 4 && (
          <StepThanhCong data={data} onChangeSchedule={() => setStep(2)} />
        )}
      </div>
    </div>
  );
}
