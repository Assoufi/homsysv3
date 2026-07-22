<?php

namespace App\Http\Controllers;

use App\Models\Offre;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Request;
use Session;

class Controller extends BaseController
{
    public $ctx;
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getParamWithSession($id)
    {
        $result = Request::input($id);
        if ($result != null) {
            Session::put($this->ctx . $id, $result);
            return $result;
        }
        if (Request::input('init')) {
            Session::forget($this->ctx . $id);
        }
        return Session::get($this->ctx . $id, null);
    }

    public function forget($keys)
    {
        foreach ($keys as &$k) {
            Session::forget($this->ctx . $k);
        }

    }

}
