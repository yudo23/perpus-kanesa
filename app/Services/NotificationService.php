<?php

namespace App\Services;

use App\Services\BaseService;
use Log;
use Auth;
use Illuminate\Http\Response;

class NotificationService extends BaseService
{
    public function index()
    {
        try {
            $notifications = Auth::user()->notifications()->orderBy('created_at', 'desc')->paginate(15);
            $unread = Auth::user()->unreadNotifications->count();

            $data = [
                'notifications' => $notifications,
                'unread' => $unread,
            ];

            return $this->response(true, 'Berhasil mendapatkan data', $data);
        } catch (\Throwable $th) {
            Log::emergency($th->getMessage());

            return $this->response(false, "Terjadi kesalahan saat memproses data", null, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id)
    {
        try {
            $notification = Auth::user()->notifications()->where('id', $id)->firstOrFail();
            $notification->markAsRead();

            return $this->response(true, 'Berhasil mendapatkan data', $notification);
        } catch (\Throwable $th) {
            Log::emergency($th->getMessage());

            return $this->response(false, "Terjadi kesalahan saat memproses data", null, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function readAll()
    {
        try {
            $user = Auth::user();
            foreach ($user->unreadNotifications as $notification) {
                $notification->markAsRead();
            }

            return $this->response(true, 'Berhasil mendapatkan data');
        } catch (\Throwable $th) {
            Log::emergency($th->getMessage());

            return $this->response(false, "Terjadi kesalahan saat memproses data", null, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
