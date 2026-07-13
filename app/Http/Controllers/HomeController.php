<?php

namespace App\Http\Controllers;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Display the public home page.
     */
    public function index()
    {



        return view('home.index', [
        'stats' => $this->getHomepageStatistics(),
    ]);
        
    }

private function getHomepageStatistics(): array
{
    return [

        'members'       => User::count(),

        'articles'      => 0,

        'questions'     => 0,

        'discussions'   => 0,

        'supportGroups' => 0,

        'events'        => 0,

    ];
}


}
