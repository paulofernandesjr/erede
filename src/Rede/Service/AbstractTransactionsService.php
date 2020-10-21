<?php

namespace Rede\Service;

use Exception;
use InvalidArgumentException;
use Psr\Log\LoggerInterface;
use Rede\Exception\RedeException;
use Rede\Store;
use Rede\Transaction;
use RuntimeException;

abstract class AbstractTransactionsService extends AbstractService
{
    /**
     * @var Transaction
     */
    protected $transaction;

    /**
     * @var string
     */
    private $tid;

    /**
     * AbstractTransactionsService constructor.
     *
     * @param Store $store
     * @param Transaction|null $transaction
     * @param LoggerInterface|null $logger
     */
    public function __construct(Store $store, Transaction $transaction = null, LoggerInterface $logger = null)
    {
        parent::__construct($store, $logger);

        $this->transaction = $transaction;
    }

    /**
     * @return Transaction
     * @throws InvalidArgumentException
     * @throws RuntimeException
     * @throws RedeException
     */
    public function execute()
    {
        return $this->sendRequest($this->prepareBody(), AbstractService::POST);
    }

    /**
     * @return string
     */
    public function getTid()
    {
        return $this->tid;
    }

    /**
     * @param string $tid
     */
    public function setTid($tid)
    {
        $this->tid = $tid;
    }

    /**
     * @return string
     * @see    AbstractService::getService()
     */
    protected function getService()
    {
        return 'transactions';
    }

    /**
     * @param string $response
     * @param string $statusCode
     *
     * @return Transaction
     * @throws RedeException
     * @throws InvalidArgumentException
     * @throws Exception
     * @see    AbstractService::parseResponse()
     */
    protected function parseResponse($response, $statusCode)
    {
        $previous = null;

        if ($this->transaction === null) {
            $this->transaction = new Transaction();
        }

        try {
            $this->transaction->jsonUnserialize($response);
        } catch (InvalidArgumentException $e) {
            $previous = $e;
        }

        if ((int)$statusCode >= 400) {
            throw new RedeException(
                $this->transaction->getReturnMessage(),
                $this->transaction->getReturnCode(),
                $previous
            );
        }

        return $this->transaction;
    }

    /**
     * @return string
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     * @throws \Rede\Exception\RedeException
     */
    private function prepareBody()
    {
        $body = json_decode(json_encode($this->transaction), true);
        
        if ($this->transaction->getPaymentFacilitatorID()) {
            $body['PaymentFacilitatorID'] = $this->transaction->getPaymentFacilitatorID();
        }

        if ($this->transaction->getSubMerchant()) {
            $body['SubMerchant'] = [];
            $body['SubMerchant']['MCC'] = substr($this->transaction->getSubMerchant()->getMcc(), 0, 4);
            $body['SubMerchant']['SubMerchantID'] = substr($this->transaction->getSubMerchant()->getSubMerchantID(), 0, 15);
            $body['SubMerchant']['Address'] = substr($this->transaction->getSubMerchant()->getAddress(), 0, 48);
            $body['SubMerchant']['City'] = substr($this->transaction->getSubMerchant()->getCity(), 0, 13);
            $body['SubMerchant']['State'] = substr($this->transaction->getSubMerchant()->getState(), 0, 2);
            $body['SubMerchant']['Country'] = substr($this->transaction->getSubMerchant()->getCountry(), 0, 3);
            $body['SubMerchant']['Cep'] = substr($this->transaction->getSubMerchant()->getCep(), 0, 9);
            $body['SubMerchant']['Cnpj'] = substr($this->transaction->getSubMerchant()->getCnpj(), 0, 18);
        }

        return json_encode($body);
    }
}
