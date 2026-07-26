<?php
namespace App\Http\Controllers;

use App\Models\EmploymentStatus;
use App\Models\HonorRate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class HonorRateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $honorRates = HonorRate::with('employmentStatus')
            ->latest()
            ->paginate(10);

        return view('honor-rate.index', compact('honorRates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employmentStatuses = EmploymentStatus::query()
            ->orderBy('name')
            ->get();

        return view(
            'honor-rate.create',
            compact('employmentStatuses')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = validator($request->all(), [
            'employment_status_id' => [
                'required',
                'exists:employment_statuses,id',
                Rule::unique('honor_rates')
                    ->where(function ($query) use ($request) {
                        return $query
                            ->where('employment_status_id', $request->employment_status_id)
                            ->where('effective_date', $request->effective_date);
                    }),
            ],

            'rate_per_sks'         => [
                'required',
                'numeric',
                'min:0',
            ],

            'effective_date'       => [
                'required',
                'date',
            ],
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();

        try {

            HonorRate::create($request->only([
                'employment_status_id',
                'rate_per_sks',
                'effective_date',
            ]));

            DB::commit();

            return redirect()
                ->route('honor-rate.index')
                ->with('success', 'Honor rate berhasil ditambahkan.');

        } catch (\Throwable $th) {

            DB::rollBack();

            return redirect()
                ->back()
                ->withInput()
                ->with('error', $th->getMessage());

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(HonorRate $honorRate)
    {
        $honorRate->load('employmentStatus');

        return view(
            'honor-rate.show',
            compact('honorRate')
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HonorRate $honorRate)
    {
        $employmentStatuses = EmploymentStatus::query()
            ->orderBy('name')
            ->get();

        return view(
            'honor-rate.edit',
            compact(
                'honorRate',
                'employmentStatuses'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HonorRate $honorRate)
    {
        $validator = validator($request->all(), [
            'employment_status_id' => [
                'required',
                'exists:employment_statuses,id',
                Rule::unique('honor_rates')
                    ->ignore($honorRate->id)
                    ->where(function ($query) use ($request) {
                        return $query
                            ->where('employment_status_id', $request->employment_status_id)
                            ->where('effective_date', $request->effective_date);
                    }),
            ],

            'rate_per_sks'         => [
                'required',
                'numeric',
                'min:0',
            ],

            'effective_date'       => [
                'required',
                'date',
            ],
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();

        try {

            $honorRate->update($request->only([
                'employment_status_id',
                'rate_per_sks',
                'effective_date',
            ]));

            DB::commit();

            return redirect()
                ->route('honor-rate.index')
                ->with('success', 'Honor rate berhasil diperbarui.');

        } catch (\Throwable $th) {

            DB::rollBack();

            return redirect()
                ->back()
                ->withInput()
                ->with('error', $th->getMessage());

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HonorRate $honorRate)
    {
        DB::beginTransaction();

        try {

            $honorRate->delete();

            DB::commit();

            return redirect()
                ->route('honor-rate.index')
                ->with('success', 'Honor rate berhasil dihapus.');

        } catch (\Throwable $th) {

            DB::rollBack();

            return redirect()
                ->back()
                ->with('error', $th->getMessage());

        }
    }
}
