const { default: httpRequest } = require("~/utils/httpRequest");

/**
 * @todo: Lấy danh sách người dùng phân trang từ API.
 * @purpose:
 *  - Hàm này gửi một yêu cầu HTTP GET tới API để lấy dữ liệu người dùng với tham số phân trang `page`.
 *  - Thông tin thêm: Dữ liệu trả về từ API sẽ được lưu trữ trong `res.data` và hàm sẽ trả về dữ liệu này cho các phần tiếp theo của ứng dụng.
 * @author: Tony
 * @since: 15-01-2025
 * @param {number} page - Số trang hiện tại, mặc định là 1 nếu không được chỉ định.
 * @return {Promise<object>} - Một Promise chứa dữ liệu người dùng phân trang trả về từ API.
 * @throws {Error} - Nếu có lỗi xảy ra trong quá trình gọi API, lỗi sẽ được ghi log ra console.
 */
export const getPaginationUsers = async (page = 1) => {
    try {
        return await httpRequest.get("users", {
            params: {
                page,
            },
        });
    } catch (error) {
        console.log(error);
    }
};
