<?php

namespace App\Services\Setting;

use App\Enums\ImageEnum;
use App\Helpers\UploadHelper;
use App\Http\Requests\Setting\DashboardSettingRequest;
use App\Services\BaseService;
use App\Settings\DashboardSetting;
use Illuminate\Http\Response;
use Log;
use DB;

class DashboardSettingService extends BaseService
{

    public function update(DashboardSettingRequest $request){
        DB::beginTransaction();
        try {
            $name = (empty($request->name)) ? null : trim(strip_tags($request->name));
            $footer = (empty($request->footer)) ? null : trim(strip_tags($request->footer));
            $logo_large_dark = $request->file("logo_large_dark");
            $logo_large_light = $request->file("logo_large_light");
            $logo_mini_dark = $request->file("logo_mini_dark");
            $logo_mini_light = $request->file("logo_mini_light");
            $favicon = $request->file("favicon");

            $setting = new DashboardSetting();

            $setting->name = $name;
            $setting->footer = $footer;

            if ($logo_large_dark) {
                $upload = UploadHelper::upload_file($logo_large_dark, 'settings', ImageEnum::EXT, 2097152,true,true,500,null,true);

                if ($upload["IsError"] == TRUE) {
                    return $this->response(false, $upload["Message"],null,Response::HTTP_BAD_REQUEST);
                }

                $logo_large_dark = $upload["Path"];

                $setting->logo_large_dark = $logo_large_dark;
            }

            if ($logo_large_light) {
                $upload = UploadHelper::upload_file($logo_large_light, 'settings', ImageEnum::EXT, 2097152,true,true,500,null,true);

                if ($upload["IsError"] == TRUE) {
                    return $this->response(false, $upload["Message"],null,Response::HTTP_BAD_REQUEST);
                }

                $logo_large_light = $upload["Path"];

                $setting->logo_large_light = $logo_large_light;
            }

            if ($logo_mini_dark) {
                $upload = UploadHelper::upload_file($logo_mini_dark, 'settings', ImageEnum::EXT, 2097152,true,true,500,null,true);

                if ($upload["IsError"] == TRUE) {
                    return $this->response(false, $upload["Message"],null,Response::HTTP_BAD_REQUEST);
                }

                $logo_mini_dark = $upload["Path"];

                $setting->logo_mini_dark = $logo_mini_dark;
            }

            if ($logo_mini_light) {
                $upload = UploadHelper::upload_file($logo_mini_light, 'settings', ImageEnum::EXT, 2097152,true,true,500,null,true);

                if ($upload["IsError"] == TRUE) {
                    return $this->response(false, $upload["Message"],null,Response::HTTP_BAD_REQUEST);
                }

                $logo_mini_light = $upload["Path"];

                $setting->logo_mini_light = $logo_mini_light;
            }

            if ($favicon) {
                $upload = UploadHelper::upload_file($favicon, 'settings', ImageEnum::EXT, 2097152);

                if ($upload["IsError"] == TRUE) {
                    return $this->response(false, $upload["Message"],null,Response::HTTP_BAD_REQUEST);
                }

                $favicon = $upload["Path"];

                $setting->favicon = $favicon;
            }

            $setting->save();

            DB::commit();

            return $this->response(true, 'Data changed successfully',$setting);
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::emergency($th->getMessage());

            return $this->response(false, "Internal server error",null,Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
