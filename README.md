# amocrm-client
PHP client for AmoCRM API

Usage example:
```php
$client = new Client(
    $config['amocrm_subdomain'],
    $config['amocrm_login'],
    $config['amocrm_api_key']
);


$data = $client->createUnsortedForm()
    ->setSourceName('ourdomain.com')
    ->setSourceUid(date('YmdHis'))
    ->setFormId($formId)
    ->setFormPage('New request')
    ->setIp($clientIp)
    ->setServiceCode('wtf')
    ->setFormName($formName)
    ->setReferer($clientReferer)
    ->addIncomingContact(
        $client->createContact()
            ->setName($clientName)
            ->addCustomField(
                $client->createCustomField($config['amocrm_phone_id'])
                    ->addValue($clientPhone, $config['amocrm_phone_enum'])
            )
    )
    ->addIncomingLead(
        $client->createLead()
            ->setName('New request from ' . $clientName)
    );

// send data to server
$client->persist($data);
```
