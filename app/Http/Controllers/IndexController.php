<?php

namespace App\Http\Controllers;


use App\Jobs\TestJob;
use App\Models\Interest;
use App\Models\Role;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;
use Ramsey\Uuid\Type\Integer;

class IndexController extends Controller
{
    public function main()
    {
        return 'health-check';
    }

//    public function queue()
//    {
//        TestJob::dispatch();
//    }

//    public function cache()
//    {
//        $result = -1;
//
//        if (Cache::has('key')) {
//            $result = Cache::get('key');
//        } else {
//            $value = now()->toIso8601ZuluString();
//            Cache::add('key', $value, now()->addSeconds(10));
//            $result = $value;
//        }
//
//        return $result;
//    }

//    public function view()
//    {
//        return view('hi', ['name' => 'Anton']);
//    }

    public function orm()
    {
        Interest::query()->get();

        Interest::query()->where('name', '=', 'SomeName')->limit(10)->get();

        $adminRole = Role::query()->where('name', '=', 'Admin')->firstOrFail();

        return $adminRole->users();
    }
}
