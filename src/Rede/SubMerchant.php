<?php

namespace Rede;


class SubMerchant
{
    /**
     * @var string
     */
    private $mcc;

    /**
     * @var string
     */
    private $city;

    /**
     * @var string
     */
    private $country;

       
    /**
     * @var string
     */
    private $subMerchantID;

    /**
     * @var string
     */
    private $address;

    /**
     * @var string
     */
    private $state;

    /**
     * @var string
     */
    private $cep;

    /**
     * @var string
     */
    private $cnpj;

    /**
     * SubMerchant constructor.
     *
     * @param $mcc
     * @param $city
     * @param $country
     * @param $subMerchantID
     * @param $address
     * @param $state
     * @param $cep
     * @param $cnpj
     */
    public function __construct($mcc, $city, $country, $subMerchantID, $address, $state, $cep, $cnpj)
    {
        $this->setMcc($mcc);
        $this->setCity($city);
        $this->setCountry($country);
        $this->setSubMerchantID($subMerchantID);
        $this->setAddress($address);
        $this->setState($state);
        $this->setCep($cep);
        $this->setCnpj($cnpj);
    }

    /**
     * @return string
     */
    public function getMcc()
    {
        return $this->mcc;
    }

    /**
     * @param string $mcc
     *
     * @return SubMerchant
     */
    public function setMcc($mcc)
    {
        $this->mcc = $mcc;
        return $this;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     *
     * @return SubMerchant
     */
    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string $country
     *
     * @return SubMerchant
     */
    public function setCountry($country)
    {
        $this->country = $country;
        return $this;
    }

    /**
     * @return string
     */
    public function getSubMerchantID()
    {
        return $this->subMerchantID;
    }

    /**
     * @param string $subMerchantID
     *
     * @return SubMerchant
     */
    public function setSubMerchantID($subMerchantID)
    {
        $this->subMerchantID = $subMerchantID;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     *
     * @return SubMerchant
     */
    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }
    
    /**
     * @param string $state
     *
     * @return SubMerchant
     */
    public function setState($state)
    {
        $this->state = $state;
        return $this;
    }

    /**
     * @return string
     */
    public function getCep()
    {
        return $this->cep;
    }

    /**
     * @param string $cep
     *
     * @return SubMerchant
     */
    public function setCep($cep)
    {
        $this->cep = $cep;
        return $this;
    }

    /**
     * @return string
     */
    public function getCnpj()
    {
        return $this->cnpj;
    }

    /**
     * @param string $cnpj
     *
     * @return SubMerchant
     */
    public function setCnpj($cnpj)
    {
        $this->cnpj = $cnpj;
        return $this;
    }

}