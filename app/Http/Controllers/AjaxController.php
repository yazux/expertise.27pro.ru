<?php

namespace App\Http\Controllers;

use App\Vendor;
use App\Project;
use App\News;
use App\Region;
use App\Connectors\BitrixConnector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Cache;
use Voyager;

/**
 * Контроллер для работы с Ajax запросами
 *
 * @package App\Http\Controllers
 */
class AjaxController extends Controller
{
    public function getRegions(Request $request) 
    {
        $Regions = Region::whereNotNull('id')->orderBy('sort', 'asc')->get();
        return response()->json($Regions);
    }

    public function getVendors(Request $request)
    {
        if ($request->get('count')) $Vendors = Vendor::whereNotNull('id')->orderBy('sort')->paginate($request->get('count'));
        else $Vendors = Vendor::whereNotNull('id')->orderBy('sort')->get();

        if ($Vendors instanceof LengthAwarePaginator) {
            $Vendors->getCollection()
                ->transform(function ($item) {
                    $item->projects_count = $item->ProjectsCount;
                    $item->projecs_in_works_count = $item->ProjecsInWorksCount;
                    $item->work_progress = $item->WorkProgress;
                    $item->full_price = $item->FullPrice;
                    if (is_string($item->photos)) $item->photos = json_decode($item->photos);
                    return $item;
                });
        } elseif ($Vendors instanceof Collection) {
            $Vendors->transform(function ($item) {
                $item->projects_count = $item->ProjectsCount;
                $item->projecs_in_works_count = $item->ProjecsInWorksCount;
                $item->work_progress = $item->WorkProgress;
                $item->full_price = $item->FullPrice;
                if (is_string($item->photos)) $item->photos = json_decode($item->photos);
                return $item;
            });
        }
        return response()->json($Vendors);
    }

    public function getProjects(Request $request)
    {
        $vendorId = $request->get('vendor_id');

        $Projects = Project::whereNotNull('id')->orderBy('sort');
        if ($vendorId) $Projects->where('vendor_id', $vendorId);
        if ($request->get('count')) $Projects = $Projects->paginate($request->get('count'));
        else $Projects = $Projects->get();

        return response()->json($Projects);
    }

    public function getNews(Request $request)
    {
        if ($request->get('count')) {
            $News = News::whereNotNull('id')->orderBy('created_at', 'desc');
            if ($request->get('region_id')) $News->where('region_id', $request->get('region_id'));
            $News = $News->paginate($request->get('count'));
        } else $News = News::whereNotNull('id')->get();

        return response()->json($News);
    }

    public function access(Request $request)
    {
        $password = $request->get('password');
        $RegionId = $request->get('region_id');
        if (!$RegionId || !$password) return response()->json(['access' => false]);

        $Region = Region::where('id', $RegionId)->first();
        if (!$Region || ($Region && $Region->password != $password))  return response()->json(['access' => false]);

        return response()->json(['access' => true]);
    }
}