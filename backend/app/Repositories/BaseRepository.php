<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository implements \App\Repositories\Interfaces\BaseRepositoryInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @todo: Hàm dùng để phân trang cho các mô hình dữ liệu.
     * @purpose:
     *  - Trả về kết quả phân trang của một mô hình Eloquenttrang.
     * @author: Tony
     * @since: 15-01-2025
     * @param int $page (mặc định là 1) - Số trang hiện tại.
     * @param int $perPage (mặc định là 10) - Số lượng kết quả trên mỗi trang.
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator - Đối tượng phân trang chứa dữ liệu và thông tin phân trang.
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException - Nếu mô hình không tìm thấy trong cơ sở dữ liệu.
     */
    public function pagination($page = 1, $perPage = 15)
    {
        return $this->model->paginate($perPage, ['*'], 'page', $page);
    }
}
