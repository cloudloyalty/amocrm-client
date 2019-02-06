<?php

namespace AmoCRM;

use AmoCRM\Entity\Contact;
use AmoCRM\Entity\CustomField;
use AmoCRM\Entity\Lead;
use AmoCRM\Entity\PersistableEntityInterface;
use AmoCRM\Entity\UnsortedForm;
use AmoCRM\Exception\PersistingException;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;

class Client
{
    const AMOCRM_DOMAIN = '.amocrm.ru';

    const STATUS_SUCCESS = 'success';
    const STATUS_FAIL = 'fail';

    /**
     * @var ClientInterface
     */
    protected $httpClient;

    /**
     * @var string
     */
    protected $creds;

    /**
     * @var string
     */
    protected $subdomain;


    /**
     * @param string $subdomain
     * @param string $login
     * @param string $apiKey
     * @param ClientInterface $httpClient
     */
    public function __construct(string $subdomain, string $login, string $apiKey, ClientInterface $httpClient = null)
    {
        $this->subdomain = $subdomain;
        $this->creds = http_build_query([
            'login' => $login,
            'api_key' => $apiKey
        ]);

        if (!$httpClient) {
            $httpClient = new \GuzzleHttp\Client();
        }
        $this->httpClient = $httpClient;
    }

    /**
     * @return UnsortedForm
     */
    public function createUnsortedForm(): UnsortedForm
    {
        return new UnsortedForm();
    }

    /**
     * @return Contact
     */
    public function createContact(): Contact
    {
        return new Contact();
    }

    /**
     * @return Lead
     */
    public function createLead(): Lead
    {
        return new Lead();
    }

    /**
     * @param int $id
     * @return CustomField
     */
    public function createCustomField(int $id = null): CustomField
    {
        return new CustomField($id);
    }

    /**
     * @param PersistableEntityInterface $entity
     * @throws GuzzleException
     * @throws PersistingException
     */
    public function persist(PersistableEntityInterface $entity)
    {
        $url = 'https://' . $this->subdomain . static::AMOCRM_DOMAIN . $entity->getResource() . '?' . $this->creds;

        $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded; charset=UTF-8'
        ];

        $data = $entity->serialize();

        if ($entity->isNew()) {
            $body = http_build_query([
                'add' => [
                    $data
                ]
            ]);
        } else {
            $body = http_build_query([
                'update' => [
                    $data
                ]
            ]);
        }

        $response = $this->httpClient->send((new Request('POST', $url, $headers, $body)));

        $result = \GuzzleHttp\json_decode($response->getBody()->getContents());

        // Em... One morning AmoCRM just started to respond in new format
        if (!empty($result->response)) {
            $result = reset(reset($result->response));
        }

        if ($result->status != static::STATUS_SUCCESS) {
            throw new PersistingException($result->error, $result->error_code);
        }
    }
}