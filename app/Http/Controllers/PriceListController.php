<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Application\UseCases\PriceList\GetPriceList;

class PriceListController extends Controller
{
    protected $getPriceList;

    public function __construct(GetPriceList $getPriceList)
    {
        $this->getPriceList = $getPriceList;
    }

    public function index(Request $request) : array {
        $products = $this->getPriceList->execute($request->all());
        return $products;
    }
}
