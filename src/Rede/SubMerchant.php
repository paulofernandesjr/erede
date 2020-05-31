<?php

namespace Rede;


class SubMerchant
{

    private $Mcc;
    private $City;
    private $Country;
    private $SubMerchantID;
    private $Address;
    private $State;
    private $Cep;
    private $Cnpj;

    /**
     * SubMerchant constructor.
     * @param $Mcc
     * @param $City
     * @param $Country
     * @param $SubMerchantID
     * @param $Address
     * @param $State
     * @param $Cep
     * @param $Cnpj
     */
    public function __construct($Mcc, $City, $Country, $SubMerchantID, $Address, $State, $Cep, $Cnpj)
    {
        $this->Mcc = $Mcc;
        $this->City = $City;
        $this->Country = $Country;
        $this->SubMerchantID = $SubMerchantID;
        $this->Address = $Address;
        $this->State = $State;
        $this->Cep = $Cep;
        $this->Cnpj = $Cnpj;
    }

    /**
     * @return mixed
     */
    public function getMcc()
    {
        return $this->Mcc;
    }

    /**
     * @param mixed $Mcc
     */
    public function setMcc($Mcc)
    {
        $this->Mcc = $Mcc;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->City;
    }

    /**
     * @param mixed $City
     */
    public function setCity($City)
    {
        $this->City = $City;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->Country;
    }

    /**
     * @param mixed $Country
     */
    public function setCountry($Country)
    {
        $this->Country = $Country;
    }

    /**
     * @return mixed
     */
    public function getSubMerchantID()
    {
        return $this->SubMerchantID;
    }

    /**
     * @param mixed $SubMerchantID
     */
    public function setSubMerchantID($SubMerchantID)
    {
        $this->SubMerchantID = $SubMerchantID;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->Address;
    }

    /**
     * @param mixed $Address
     */
    public function setAddress($Address)
    {
        $this->Address = $Address;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->State;
    }

    /**
     * @param mixed $State
     */
    public function setState($State)
    {
        $this->State = $State;
    }

    /**
     * @return mixed
     */
    public function getCep()
    {
        return $this->Cep;
    }

    /**
     * @param mixed $Cep
     */
    public function setCep($Cep)
    {
        $this->Cep = $Cep;
    }

    /**
     * @return mixed
     */
    public function getCnpj()
    {
        return $this->Cnpj;
    }

    /**
     * @param mixed $Cnpj
     */
    public function setCnpj($Cnpj)
    {
        $this->Cnpj = $Cnpj;
    }




}