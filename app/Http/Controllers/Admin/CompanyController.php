<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use Validator;
use Illuminate\Support\Facades\Storage;
use App\Services\CompanyService;
use App\Jobs\SendEmailQueueJob;
class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $companyService;

    public function __construct(CompanyService $companyService)
    { 
        $this->companyService = $companyService;

    }
    public function index()
    {
       
        $companies = Company::paginate(3)->toArray();
        return array_reverse($companies);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.companies.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyRequest $request)
    {
    
        $validate = $request->validated();
        /*store Image */
        $image_name = ($request->hasFile('logo')) ? $this->companyService->storeImage($request->file('logo')) : '';
        /* End store Image */

        /* Store Company Data */
        $input = $request->except('_token','logo');
        $add_company  = 
        Company::create(
            array_merge(
                $input,
                [
                    'logo'=>$image_name
                ]
            ));
        /* End Store Company Data */
        if(isset($request->email))
        dispatch(new SendEmailQueueJob($request->email,$request->name));

        return response()->json('Company Added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $company = Company::find($id);
        return response()->json($company);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        
        // return view('admin.companies.edit',compact('company'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompanyRequest $request ,string $id)
    {
        $company = Company::find($id);
        $validate = $request->validated();
        $input=$request->all();
   
        /* Update Image */
            $image_name = ($request->hasFile('logo')) ? $this->companyService->updateImage($request->file('logo'),$company->logo) : $company->logo;
        /* End Update Image */

        $company->update(
            array_merge(
                $input,
                [
                    'logo'=>$image_name
                ]
            ));
            return response()->json('Company updated!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {        
        $company = Company::find($id);
        $company->delete();
        return response()->json('Company deleted!');
    }
    public function get_companies()
    {
        
        $companies = Company::all()->toArray();
        return response()->json($companies);

    }
}
