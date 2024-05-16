<?php

namespace App\Http\Controllers\Dashboard\Setting;

use App\Enums\ImageEnum;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;
use App\Http\Requests\Setting\DashboardSettingRequest;
use App\Settings\DashboardSetting;
use App\Helpers\ResponseHelper;
use App\Services\Setting\DashboardSettingService;

class DashboardSettingController extends Controller
{
    protected $dashboardSettingService;
    protected $route;
    protected $view;

    public function __construct()
    {
        $this->route = "dashboard.settings.dashboard.";
        $this->view = "dashboard.settings.dashboard";
        $this->dashboardSettingService = new DashboardSettingService();
    }

    public function index(DashboardSetting $dashboardSetting)
    {
        $data = [
            'result' => $dashboardSetting,
        ];

        return view($this->view, $data);
    }

    public function update(DashboardSettingRequest $request)
    {
        try {
            $response = $this->dashboardSettingService->update($request);
            if (!$response->success) {
                return ResponseHelper::apiResponse(false, $response->message , null, null, $response->code);
            }
            
            return ResponseHelper::apiResponse(true, $response->message , $response->data , null, $response->code);
        } catch (\Throwable $th) {
            Log::emergency($th->getMessage());

            return ResponseHelper::apiResponse(false, $th->getMessage() , null, null, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
