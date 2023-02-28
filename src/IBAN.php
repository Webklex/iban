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

/**
 * Class IBAN
 *
 * @package Webklex\IBAN
 * @example IBAN::make("123456789", "10000000", "de")->calculate();
 */
class IBAN {
    /**
     * @var string $alphabet The alphabet used for the IBAN calculation
     */
    private static string $alphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";

    /**
     * @var string $account_number The account number
     */
    protected string $account_number;

    /**
     * @var string $sort_code The bank sort code
     */
    protected string $sort_code;

    /**
     * @var string $country The country code
     */
    protected string $country;

    /**
     * IBAN constructor.
     * @param string $account_number
     * @param string $sort_code
     * @param string $country
     *
     * @return IBAN
     * @throws InvalidCountryCodeException
     */
    public static function make(string $account_number, string $sort_code, string $country): IBAN {
        return (new self())->setAccountNumber($account_number)->setSortCode($sort_code)->setCountry($country);
    }

    /**
     * Calculate the IBAN
     *
     * @return string
     * @throws IbanCalculationException
     */
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
     * Get the current country code
     *
     * @return string
     */
    public function getCountry(): string {
        return $this->country;
    }

    /**
     * Set a new country code and calculate its representation
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
     * Get the current bank sort code
     *
     * @return string
     */
    public function getSortCode(): string {
        return $this->sort_code;
    }

    /**
     * Set a new bank sort code
     * @param string $sort_code
     *
     * @return IBAN
     */
    public function setSortCode(string $sort_code): IBAN {
        $this->sort_code = $sort_code;
        return $this;
    }

    /**
     * Get the current account number
     *
     * @return string
     */
    public function getAccountNumber(): string {
        return $this->account_number;
    }

    /**
     * Set a new account number and pad it with leading zeros if needed
     * @param string $account_number
     *
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