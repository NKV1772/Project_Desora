export default function StepThanhCong({ data, onChangeSchedule }) {
  return (
    <>
      <h2 style={{ color: "green" }}>Tạo yêu cầu thành công!</h2>

      <p>Email đã được gửi kèm thông tin lịch tư vấn chi tiết</p>

      <div className="summary">
        <div>
          <b>Thời gian</b>
          <span>
            {data.ngay} — {data.thoiGian}
            <button onClick={onChangeSchedule}>Thay đổi lịch</button>
          </span>
        </div>

        <div>
          <b>Khách hàng</b>
          <span>{data.email}</span>
        </div>

        <div>
          <b>Chi tiết</b>
          <span>Desora sẽ liên hệ với bạn để trao đổi thông tin</span>
        </div>
      </div>
    </>
  );
}
