<style>
    .notification {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
        padding: 10px 20px; /* Giảm padding để không chiếm nhiều diện tích */
        width: auto; /* Kích thước tự động dựa vào nội dung */
        max-width: 300px; /* Giới hạn chiều rộng tối đa */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        border-radius: 8px;
        text-align: center;
        z-index: 1000;
        word-wrap: break-word; /* Tự xuống dòng nếu nội dung quá dài */
    }
    .notification button {
        margin-top: 10px;
        background-color: #721c24;
        color: white;
        border: none;
        padding: 5px 15px; /* Giảm kích thước nút */
        border-radius: 5px;
        cursor: pointer;
    }
    .notification button:hover {
        background-color: #f5c6cb;
        color: #721c24;
    }
</style>

<div id="notification" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #f8d7da; padding: 20px; border-radius: 5px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); text-align: center; z-index: 1000; max-width: 300px;">
    <span id="notificationMessage" style="display: block; margin-bottom: 10px; color: #721c24; font-weight: bold;">Thông báo sẽ hiển thị ở đây</span>
    <button onclick="closeNotification()" style="padding: 5px 10px; background-color: #f5c6cb; border: none; border-radius: 3px; cursor: pointer;">Đóng</button>
</div>
