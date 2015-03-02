<?php

namespace MPWAR\Module\Economy\Test;

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\TableNode;
use iter;
use MPWAR\Module\Economy\Domain\AccountOwner;
use MPWAR\Module\Economy\Domain\AccountRepository;
use MPWAR\Module\Economy\Domain\VirtualCurrency;
use MPWAR\Module\Economy\Test\Stub\AccountOwnerStub;
use MPWAR\Module\Economy\Test\Stub\VirtualMoneyStub;
use PHPUnit_Framework_Assert as Assertions;

final class EconomyContext implements Context, SnippetAcceptingContext
{
    private $repository;

    public function __construct(AccountRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Then /^should exists accounts:$/
     */
    public function shouldExistsAccounts(TableNode $accounts)
    {
        iter\apply($this->ensureExpectedAccount(), $accounts);
    }

    private function find(AccountOwner $owner)
    {
        return $this->repository->search($owner);
    }

    private function ensureExpectedAccount()
    {
        return function (array $accountInfo) {
            $expected = $this->virtualMoney($accountInfo);
            $actual   = $this->find(AccountOwnerStub::create($accountInfo['owner']));

            Assertions::assertEquals($expected, $actual->balance());
        };
    }

    private function virtualMoney(array $accountInfo)
    {
        return VirtualMoneyStub::create(
            (int) $accountInfo['amount'],
            new VirtualCurrency($accountInfo['currency'])
        );
    }
}
