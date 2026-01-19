<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\HomeServiceInterface;

class HomeController extends Controller
{
    public function __construct(
        protected HomeServiceInterface $homeService
    ) {}

    public function setTable($tableNumber)
{
    $this->homeService->setTable($tableNumber);

    return redirect()->route('home.index');
}

    public function index()
    {
        $data = $this->homeService->getHomeData();

        return view('home.index', $data);
    }
}
