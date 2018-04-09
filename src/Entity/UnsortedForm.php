<?php

namespace AmoCRM\Entity;


class UnsortedForm implements PersistableEntityInterface
{
    /**
     * @var string
     */
    private $sourceName;

    /**
     * @var string
     */
    private $sourceUid;

    /**
     * @var int
     */
    private $createdAt;

    /**
     * @var int
     */
    private $formId;

    /**
     * @var string
     */
    private $formPage;

    /**
     * @var string
     */
    private $ip;

    /**
     * @var string
     */
    private $serviceCode;

    /**
     * @var string
     */
    private $formName;

    /**
     * @var int
     */
    private $formSendAt;

    /**
     * @var string
     */
    private $referer;

    /**
     * @var Lead[]
     */
    private $incomingLeads = [];

    /**
     * @var Contact[]
     */
    private $incomingContacts = [];

    /**
     * @var Company[]
     */
    private $incomingCompanies = [];


    public function getResource(): string
    {
        return '/api/v2/incoming_leads/form';
    }

    public function serialize(): array
    {
        return [
            'source_name' => $this->sourceName,
            'source_uid' => $this->sourceUid,
            'created_at' => $this->createdAt ?: time(),
            'incoming_lead_info' => [
                'form_id' => $this->formId,
                'form_page' => $this->formPage,
                'ip' => $this->ip,
                'service_code' => $this->serviceCode,
                'form_name' => $this->formName,
                'form_send_at' => $this->formSendAt,
                'referer' => $this->referer
            ],
            'incoming_entities' => [
                'leads' => array_map(
                    function (SerializableEntityInterface $entity) {
                        return $entity->serialize();
                    },
                    $this->incomingLeads
                ),
                'contacts' => array_map(
                    function (SerializableEntityInterface $entity) {
                        return $entity->serialize();
                    },
                    $this->incomingContacts
                ),
                'companies' => array_map(
                    function (SerializableEntityInterface $entity) {
                        return $entity->serialize();
                    },
                    $this->incomingCompanies
                )
            ]
        ];
    }

    public function isNew(): bool
    {
        return true;
    }

    /**
     * @return string
     */
    public function getSourceName(): string
    {
        return $this->sourceName;
    }

    /**
     * @param string $sourceName
     * @return $this
     */
    public function setSourceName(string $sourceName)
    {
        $this->sourceName = $sourceName;
        return $this;
    }

    /**
     * @return string
     */
    public function getSourceUid(): string
    {
        return $this->sourceUid;
    }

    /**
     * @param string $sourceUid
     * @return $this
     */
    public function setSourceUid(string $sourceUid)
    {
        $this->sourceUid = $sourceUid;
        return $this;
    }

    /**
     * @return int
     */
    public function getCreatedAt(): int
    {
        return $this->createdAt;
    }

    /**
     * @param int $createdAt
     * @return $this
     */
    public function setCreatedAt(int $createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return int
     */
    public function getFormId(): int
    {
        return $this->formId;
    }

    /**
     * @param int $formId
     * @return $this
     */
    public function setFormId(int $formId)
    {
        $this->formId = $formId;
        return $this;
    }

    /**
     * @return string
     */
    public function getFormPage(): string
    {
        return $this->formPage;
    }

    /**
     * @param string $formPage
     * @return $this
     */
    public function setFormPage(?string $formPage)
    {
        $this->formPage = $formPage;
        return $this;
    }

    /**
     * @return string
     */
    public function getIp(): string
    {
        return $this->ip;
    }

    /**
     * @param string $ip
     * @return $this
     */
    public function setIp(?string $ip)
    {
        $this->ip = $ip;
        return $this;
    }

    /**
     * @return string
     */
    public function getServiceCode(): string
    {
        return $this->serviceCode;
    }

    /**
     * @param string $serviceCode
     * @return $this
     */
    public function setServiceCode(?string $serviceCode)
    {
        $this->serviceCode = $serviceCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getFormName(): string
    {
        return $this->formName;
    }

    /**
     * @param string $formName
     * @return $this
     */
    public function setFormName(?string $formName)
    {
        $this->formName = $formName;
        return $this;
    }

    /**
     * @return int
     */
    public function getFormSendAt(): int
    {
        return $this->formSendAt;
    }

    /**
     * @param int $formSendAt
     * @return $this
     */
    public function setFormSendAt(?int $formSendAt)
    {
        $this->formSendAt = $formSendAt;
        return $this;
    }

    /**
     * @return string
     */
    public function getReferer(): string
    {
        return $this->referer;
    }

    /**
     * @param string $referer
     * @return $this
     */
    public function setReferer(?string $referer)
    {
        $this->referer = $referer;
        return $this;
    }

    /**
     * @return Lead[]
     */
    public function getIncomingLeads(): array
    {
        return $this->incomingLeads;
    }

    /**
     * @param Lead[] $incomingLeads
     * @return $this
     */
    public function setIncomingLeads(array $incomingLeads)
    {
        $this->incomingLeads = $incomingLeads;
        return $this;
    }

    /**
     * @param Lead $incomingLead
     * @return $this
     */
    public function addIncomingLead(Lead $incomingLead)
    {
        $this->incomingLeads[] = $incomingLead;
        return $this;
    }

    /**
     * @return Contact[]
     */
    public function getIncomingContacts(): array
    {
        return $this->incomingContacts;
    }

    /**
     * @param Contact[] $incomingContacts
     * @return $this
     */
    public function setIncomingContacts(array $incomingContacts)
    {
        $this->incomingContacts = $incomingContacts;
        return $this;
    }

    /**
     * @param Contact $incomingContact
     * @return $this
     */
    public function addIncomingContact(Contact $incomingContact)
    {
        $this->incomingContacts[] = $incomingContact;
        return $this;
    }

    /**
     * @return Company[]
     */
    public function getIncomingCompanies(): array
    {
        return $this->incomingCompanies;
    }

    /**
     * @param Company[] $incomingCompanies
     * @return $this
     */
    public function setIncomingCompanies(array $incomingCompanies)
    {
        $this->incomingCompanies = $incomingCompanies;
        return $this;
    }

    /**
     * @param Company $incomingCompany
     * @return $this
     */
    public function addIncomingCompany(Company $incomingCompany)
    {
        $this->incomingCompanies[] = $incomingCompany;
        return $this;
    }
}
