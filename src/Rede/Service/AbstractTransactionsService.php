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
        $body['SubMerchant'] = [];
        $body['SubMerchant']['MCC'] = $this->transaction->getSubMerchant()->getMcc();
        $body['SubMerchant']['SubMerchantID'] = $this->transaction->getSubMerchant()->getSubMerchantID();
        $body['SubMerchant']['Address'] = $this->transaction->getSubMerchant()->getAddress();
        $body['SubMerchant']['City'] = $this->transaction->getSubMerchant()->getCity();
        $body['SubMerchant']['State'] = $this->transaction->getSubMerchant()->getState();
        $body['SubMerchant']['Country'] = $this->transaction->getSubMerchant()->getCountry();
        $body['SubMerchant']['Cep'] = $this->transaction->getSubMerchant()->getCep();
        $body['SubMerchant']['Cnpj'] = $this->transaction->getSubMerchant()->getCnpj();

        return json_encode($body);
    }
}
