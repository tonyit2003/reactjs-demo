<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @todo: Lấy danh sách người dùng phân trang và trả về dưới dạng tài nguyên API.
     * @purpose:
     *  - Hàm này sẽ lấy danh sách người dùng từ kho lưu trữ (repository) với phân trang, sau đó trả về dưới dạng tài nguyên API (JSON) đã được chuyển đổi qua `UserResource`.
     * @author: Tony
     * @since: 15-01-2025
     * @param \Illuminate\Http\Request $request - Đối tượng yêu cầu HTTP chứa các tham số phân trang (ví dụ: `page`).
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection - Một tập hợp các tài nguyên `UserResource` dưới dạng JSON.
     * @throws \Illuminate\Validation\ValidationException - Nếu tham số yêu cầu không hợp lệ.
     */
    public function index(Request $request)
    {
        $page = $request->get('page', 1);
        $users = $this->userRepository->pagination($page);
        return UserResource::collection($users);
    }
}
