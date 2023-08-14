<?php

namespace App\Observers;

use App\Models\Company;

class CompanyObserver
{
    /**
     * Handle the Company "created" event.
     */
    public function created(Company $company): void
    {
        //
    }
    

    public function retrieved(Company $company): void
    {
        // if(empty($company->logo))
        // $company->logo = 'avatar.png';
    
    }

    /**
     * Handle the Company "updated" event.
     */
    public function updated(Company $company): void
    {
      
        //
    }
    public function updating(Company $company): void
    {
       
    }

    /**
     * Handle the Company "deleted" event.
     */
    public function deleted(Company $company): void
    {
        //
    }

    /**
     * Handle the Company "restored" event.
     */
    public function restored(Company $company): void
    {
        //
    }

    /**
     * Handle the Company "force deleted" event.
     */
    public function forceDeleted(Company $company): void
    {
        //
    }
}
