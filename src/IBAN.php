<?php
/*
* File: IBAN.php
* Category: -
* Author: M.Goldenbaum
* Created: 28.02.23 18:49
* Updated: -
*
* Description:
*  -
*/


namespace Webklex\IBAN;

use Webklex\IBAN\Exceptions\IbanCalculationException;
use Webklex\IBAN\Exceptions\InvalidCountryCodeException;

class IBAN {

    private static string $alphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";

    protected string $account_number;

    protected string $sort_code;

    protected string $country;

    public static function make(string $account_number, string $sort_code, string $country): IBAN {
        return (new self())->setAccountNumber($account_number)->setSortCode($sort_code)->setCountry($country);
    }

    public function calculate():string {
        $iban_raw = $this->sort_code.$this->account_number.$this->country;
        if(strlen($iban_raw) == 24){
            $checksum = 98 - bcmod($iban_raw,97);
            if($checksum < 10){
                $checksum = '0'.$checksum;
            }
            return $this->country.$checksum.$this->sort_code.$this->account_number;
        }
        throw new IbanCalculationException("Account number or bank sort code to short");
    }

    /**
     * @return string
     */
    public function getCountry(): string {
        return $this->country;
    }

    /**
     * @param string $country
     *
     * @return IBAN
     * @throws InvalidCountryCodeException
     */
    public function setCountry(string $country): IBAN {
        $country_parts = str_split($country);
        if(count($country_parts) != 2){
            throw new InvalidCountryCodeException("invalid country code: ".$country);
        }
        $this->country = "";
        foreach($country_parts as $check){
            $this->country .= (string)(strpos(self::$alphabet, $check) + 10);
        }
        $this->country = $this->country.'00';
        return $this;
    }

    /**
     * @return string
     */
    public function getSortCode(): string {
        return $this->sort_code;
    }

    /**
     * @param string $sort_code
     * @return IBAN
     */
    public function setSortCode(string $sort_code): IBAN {
        $this->sort_code = $sort_code;
        return $this;
    }

    /**
     * @return string
     */
    public function getAccountNumber(): string {
        return $this->account_number;
    }

    /**
     * @param string $account_number
     * @return IBAN
     */
    public function setAccountNumber(string $account_number): IBAN {
        while(strlen($account_number) < 10){
            $account_number = '0'.$account_number;
        }
        $this->account_number = $account_number;
        return $this;
    }
}