<?php

namespace App\Http\Controllers\Backend\Setting;

use App\Models\Setting\Setting;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\Repositories\Backend\Setting\SettingRepository;
use App\Http\Requests\Backend\Setting\StoreRequest;
use App\Http\Requests\Backend\Setting\ManageRequest;

/**
 * Class SettingController.
 */
class SettingController extends Controller
{
    /**
     * @var SettingRepository
     */
    protected $settings;

    /**
     * @param SettingRepository $settings
     */
    public function __construct(SettingRepository $settings)
    {
        $this->settings = $settings;
    }

    /**
     * @param ManageRequest $request
     *
     * @return mixed
     */
    public function index(ManageRequest $request)
    {
        $settings = $this->settings->getAll();

        return view('backend.settings.index')->with([
            'settings' => $settings
            ]);
    }

    public function saveData(StoreRequest $request)
    {
        $this->settings->create($request->all());

        return redirect()->route('admin.settings.index')->withFlashSuccess("Setting Saved Successfully.");
    }

    /**
     * @param Setting              $setting
     * @param DeleteRequest $request
     *
     * @return mixed
     */
    public function destroy(Setting $setting, DeleteRequest $request)
    {
        //$setting = $this->Settings->find($id);

        $this->settings->delete($setting);

        return redirect()->route('admin.settings.index')->withFlashSuccess(trans('alerts.backend.Settings.deleted'));
    }
}
