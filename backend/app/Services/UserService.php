<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class UserService implements \App\Services\Interfaces\UserServiceInterface
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function search($request)
    {
        DB::beginTransaction();
        try {
            $keyword = $request->input('keyword');
            if (isset($keyword) && $keyword !== '') {
                $users = $this->userRepository->search(['email' => $keyword]);
            } else {
                $users = $this->userRepository->pagination(1);
            }
            DB::commit();
            return $users;
        } catch (Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return null;
        }
    }

    public function create($request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->all();
            $user = $this->userRepository->insert($payload);
            DB::commit();
            return $user;
        } catch (Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return null;
        }
    }

    public function update($id, $request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->all();
            $user = $this->userRepository->update($id, $payload);
            DB::commit();
            return $user;
        } catch (Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return null;
        }
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $user = $this->userRepository->delete($id);
            DB::commit();
            return $user;
        } catch (Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return null;
        }
    }
}
