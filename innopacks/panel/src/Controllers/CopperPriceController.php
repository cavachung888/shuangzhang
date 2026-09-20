<?php

namespace InnoCMS\Panel\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use InnoCMS\Common\Models\CopperPrice;
use InnoCMS\Panel\Requests\CopperPriceRequest;

class CopperPriceController extends BaseController
{
    public function index(Request $request): mixed
    {
        $query = CopperPrice::query();

        if ($request->filled('market')) {
            $query->where('market', $request->input('market'));
        }

        if ($request->filled('price_date')) {
            $query->whereDate('price_date', $request->input('price_date'));
        }

        $copperPrices = $query
            ->orderByDesc('price_date')
            ->orderBy('market')
            ->paginate(20);

        return view('panel::copper_prices.index', [
            'copperPrices' => $copperPrices,
            'markets'      => CopperPrice::MARKETS,
        ]);
    }

    public function create(): mixed
    {
        return $this->form(new CopperPrice);
    }

    public function store(CopperPriceRequest $request): RedirectResponse
    {
        try {
            CopperPrice::create($request->validated());

            return redirect(panel_route('copper_prices.index'))
                ->with('success', trans('panel/common.updated_success'));
        } catch (\Exception $e) {
            return redirect(panel_route('copper_prices.create'))
                ->withInput()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit(CopperPrice $copperPrice): mixed
    {
        return $this->form($copperPrice);
    }

    public function form($copperPrice): mixed
    {
        return view('panel::copper_prices.form', ['copperPrice' => $copperPrice]);
    }

    public function update(CopperPriceRequest $request, CopperPrice $copperPrice): RedirectResponse
    {
        try {
            $copperPrice->update($request->validated());

            return redirect(panel_route('copper_prices.index'))
                ->with('success', trans('panel/common.updated_success'));
        } catch (\Exception $e) {
            return redirect(panel_route('copper_prices.edit', $copperPrice))
                ->withInput()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy(CopperPrice $copperPrice): RedirectResponse
    {
        try {
            $copperPrice->delete();

            return back()->with('success', trans('panel/common.deleted_success'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
