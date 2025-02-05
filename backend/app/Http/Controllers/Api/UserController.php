<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Repositories\UserRepository;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userRepository;
    protected $userService;

    public function __construct(UserRepository $userRepository, UserService $userService)
    {
        $this->userRepository = $userRepository;
        $this->userService = $userService;
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

    public function search(Request $request)
    {
        $users = $this->userService->search($request);
        return UserResource::collection($users);
    }

    /**
     * @todo: Tạo người dùng mới và trả về phản hồi JSON.
     * @purpose:
     *  - Hàm này nhận yêu cầu từ phía client với dữ liệu người dùng cần tạo, xử lý logic tạo người dùng thông qua `userService`,
     *    và trả về phản hồi JSON chứa thông tin người dùng hoặc thông báo lỗi.
     * @author: Tony
     * @since: 17-01-2025
     * @param StoreUserRequest $request - Đối tượng yêu cầu chứa dữ liệu người dùng cần tạo, đã được xác thực.
     * @return \Illuminate\Http\JsonResponse - Phản hồi JSON với trạng thái HTTP phù hợp.
     *     - HTTP 201: Nếu tạo người dùng thành công, trả về thông tin người dùng và thông báo thành công.
     *     - HTTP 400: Nếu không thể tạo người dùng, trả về thông báo lỗi.
     * @throws \Exception - Nếu có lỗi không mong muốn trong quá trình tạo người dùng.
     */
    public function store(StoreUserRequest $request)
    {
        $user = $this->userService->create($request);
        if ($user !== null) {
            return response()->json([
                'message' => 'User created successfully',
                'user' => $user
            ], 201);
        } else {
            return response()->json([
                'message' => 'Failed to create user. Please try again.',
            ], 400);
        }
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $user = $this->userService->update($id, $request);
        if ($user !== null) {
            return response()->json([
                'message' => 'User updated successfully',
                'user' => $user
            ], 201);
        } else {
            return response()->json([
                'message' => 'Failed to update user. Please try again.',
            ], 400);
        }
    }

    public function delete($id)
    {
        $user = $this->userService->delete($id);
        if ($user !== null) {
            return response()->json([
                'message' => 'User deleted successfully',
                'user' => $user
            ], 201);
        } else {
            return response()->json([
                'message' => 'Failed to delete user. Please try again.',
            ], 400);
        }
    }
}
