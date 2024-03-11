<?php

namespace App\Models\Traits;

use App\Models\CreditHistory;
use Carbon\Carbon;

trait CustomerTrait
{
    /**
     * @param $value
     */
    public function setBirthdayDateAttribute($value)
    {
        $this->attributes['birthday_date'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }

    /**
     * @return string
     */
    public function getBirthdayDate()
    {
        if (! $this->birthday_date){
            return '';
        }
        
        return Carbon::createFromFormat('Y-m-d', $this->birthday_date)->format('d/m/Y');
    }

    /**
     * Calculate the age based on the birthday date
     * @return String
     */
    public function getAge()
    {
        if (! $this->birthday_date){
            return '';
        }
        
        return Carbon::createFromFormat('Y-m-d', $this->birthday_date)->age . ' anos'; 
    }

    public function getFullName()
    {
        return $this->full_name;
    }

    public function getFirstName()
    {
        $arName = explode(' ', $this->full_name);

        return $arName[0];
    }

    public function getFormattedCredits()
    {
        return 'R$' . number_format($this->credits, 2, ',', '.');   
    }

    public function getFormattedExpectedCredits($credits = 0)
    {
        $total = $this->credits + $credits;

        return 'R$' . number_format($total, 2, ',', '.');   
    }

    public function add_credits($value, $convert = FALSE)
    {
        $convertedVal = $value;
        if ($convert){
            $convertedVal = $value / 100;
        }

        $this->credits = $this->credits + $convertedVal;
        $this->save();

        $credHistory = new CreditHistory;
        $credHistory->customer_id = $this->id;
        $credHistory->amount = $convertedVal;
        $credHistory->type = 'add';
        $credHistory->save();
    }

    public function remove_credits($value, $convert = FALSE)
    {
        $convertedVal = $value;
        if ($convert){
            $convertedVal = $value / 100;
        }

        $this->credits = $this->credits - $convertedVal;
        $this->save();

        $credHistory = new CreditHistory;
        $credHistory->customer_id = $this->id;
        $credHistory->amount = $convertedVal;
        $credHistory->type = 'sub';
        $credHistory->save();
    }
}