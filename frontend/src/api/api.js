const API_BASE = "http://localhost/api";

export const getNgay = async () => {
  const res = await fetch(`${API_BASE}/khunggiotuvan/getNgay.php`);
  return res.json();
};

export const getKhungGio = async (ngay) => {
  const res = await fetch(
    `${API_BASE}/khunggiotuvan/getKhungGio.php?ngay=${ngay}`
  );
  return res.json();
};

export const createYeuCauTuVan = async (data) => {
  const res = await fetch(`${API_BASE}/yeucautuvan/create.php`, {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(data),
  });
  return res.json();
};
