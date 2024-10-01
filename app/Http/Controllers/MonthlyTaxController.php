<?php

namespace App\Http\Controllers;

use App\Models\MonthlyTax;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MonthlyTaxController extends Controller
{
    public function index()
    {
        $this->authorize('taxes.view');

        $monthly_taxes = MonthlyTax::with('hotel', 'tax_percentage')->get();

        return view("tourism_office.tax.index", ['monthly_taxes' => $monthly_taxes ]);
    }

    public function monthly()
    {
        $this->authorize('taxes.monthly');

        $month =  now()->month;
        $monthly_taxes = MonthlyTax::whereMonth('created_at', $month)->with('hotel', 'tax_percentage')->get();

        return view("pages.monthly_taxes.monthly", ['monthly_taxes' => $monthly_taxes]);
    }

    public function report()
    {
        $this->authorize('taxes.report');

        $monthly_taxes = MonthlyTax::with('hotel', 'tax_percentage')->get();

        return view("pages.reports.monthly_taxes", ['monthly_taxes' => $monthly_taxes]);
    }
}
