<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use App\User;
use App\Vendor;
use App\Project;
use App\Page;
use App\Region;
use App\Http\Controllers\ServiceController;
use Illuminate\Mail\Markdown;

class PageController extends Controller
{
    public function __construct() 
    {
        //var_dump(session()->put('a', 'bbb'));
       //$visit = new Visit;
    }

    public function index(Request $request) 
    {
        $WorkProgress = ServiceController::getWorkProgress();
        $Regions = Region::whereNotNull('id')->with(['vendors'])->orderBy('sort', 'asc')->get();
        $Regions->transform(function ($Region) {
            $Region->projects_count = $Region->ProjectsCount;
            return $Region;
        });
        return view('pages.home', [
            'WorkProgress' => $WorkProgress,
            'regions' => $Regions
        ]);
    }

    public function regions(Request $request) 
    {
        $WorkProgress = ServiceController::getWorkProgress();
        $Regions = Region::whereNotNull('id')->with('vendors')->get();
        return view('pages.regions', ['regions' => $Regions, 'WorkProgress' => $WorkProgress]);
    }

    public function region(Request $request, $id)
    {
        if (!$id) return abort(404);
        $Region = Region::where('id', $id)->with('vendors')->first();
        if (!$Region) return abort(404);
        $Region->vendors->transform(function ($vendor) {
            if (is_string($vendor->photos)) $vendor->photos = json_decode($vendor->photos, true);
            return $vendor;
        });
        $WorkProgress = [];
        if ($Region->vendors && count($Region->vendors)) $WorkProgress = ServiceController::getWorkProgress($Region->vendors);
        return view('pages.region', ['Region' => $Region, 'WorkProgress' => $WorkProgress, 'RegionId' => $id]);
    }

    public function regionProjects(Request $request, $id)
    {
        if (!$id) return abort(404);
        $Region = Region::where('id', $id)->with('vendors')->first();
        if (!$Region) return abort(404);
        $Region->projects = $Region->Projects;
        $WorkProgress = ServiceController::getWorkProgress($Region->vendors);
        return view('pages.region_project', ['Region' => $Region, 'WorkProgress' => $WorkProgress, 'RegionId' => $id]);
    }

    public function static(Request $request, $slug)
    {
        $Page = Page::where('slug', $slug)->first();
        if (!$Page) return abort(404);
        $Page->text = Markdown::parse($Page->text);
        return view('pages.static', ['page' => $Page]);
    }

    public function vendors(Request $request) 
    {
        return view('pages.vendors', []);
    }

    public function vendor(Request $request, $id = null)
    {
        if (!$id) return view('pages.vendor', ['vendor' => null]);
        else {
            $Vendor = Vendor::where('id', $id)->with([
                'projects' => function ($q) {
                    $q->orderBy('sort');
                }
            ])->first();
            $Vendor->projects_count = $Vendor->ProjectsCount;
            $Vendor->projecs_in_works_count = $Vendor->ProjecsInWorksCount;
            $Vendor->full_price = $Vendor->FullPrice;
            $Vendor->description = Markdown::parse($Vendor->description);
            return view('pages.vendor', ['vendor' => $Vendor, 'RegionId' => $Vendor->region_id]);
        }
    }

    public function projects(Request $request) 
    {
        $WorkProgress = ServiceController::getWorkProgress();

        $Vendors = Vendor::whereNotNull('id')->with([
            'projects' => function ($q) {
                $q->orderBy('sort');
            }
        ])->get();
        $Vendors->transform(function ($item) {
            $item->projects_count = $item->ProjectsCount;
            $item->projecs_in_works_count = $item->ProjecsInWorksCount;
            $item->work_progress = $item->WorkProgress;
            $item->full_price = $item->FullPrice;
            if (is_string($item->photos)) $item->photos = json_decode($item->photos);
            return $item;
        });


        return view('pages.projects', [
            'WorkProgress' => $WorkProgress,
            'vendors' => $Vendors
        ]);
    }

    public function project(Request $request, $id = null) 
    {
        if (!$id) return view('pages.project', ['project' => null]);
        else {
            $Project = Project::where('id', $id)->with('vendor')->first();
            if ($Project->videos && strlen($Project->videos)) $Project->videos = explode(', ', $Project->videos);
            $Project->description = Markdown::parse($Project->description);
            $Project->photos_by_date = $Project->preparePhotos();
            return view('pages.project', ['project' => $Project, 'RegionId' => $Project->vendor->region_id]);
        }
    }
}
