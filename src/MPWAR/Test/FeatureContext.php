<?php

namespace MPWAR\Test;

use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Mink\Driver\BrowserKitDriver;
use Behat\MinkExtension\Context\RawMinkContext;
use DateTime;
use DateTimeImmutable;
use Doctrine\ORM\EntityManager;
use MPWAR\Infrastructure\Doctrine\DatabaseCleaner;
use MPWAR\Test\PHPUnit\Constraint\ConstraintIsSimilar;
use PHPUnit_Framework_Assert as Assertions;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FeatureContext extends RawMinkContext implements SnippetAcceptingContext
{
    private $headers = [];
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /** @BeforeScenario */
    public function setUp()
    {
        DatabaseCleaner::clean($this->entityManager);
    }

    /**
     * @Given /^I set header "([^"]*)" with value "([^"]*)"$/
     */
    public function iSetHeaderWithValue($name, $value)
    {
        $this->headers[$name] = $value;
    }

    /**
     * @When /^(?:I )?send a ([A-Z]+) request to "([^"]+)"$/
     */
    public function iSendARequest($method, $url)
    {
        $this->sendRequest($method, $url);
    }

    /**
     * @When /^(?:I )?send a ([A-Z]+) request to "([^"]+)" with body:$/
     */
    public function iSendARequestWithBody($method, $url, PyStringNode $body)
    {
        $this->sendRequest($method, $url, $body->getRaw());
    }

    /**
     * @Then /^(?:the )?response code should be (\d+)$/
     */
    public function theResponseCodeShouldBe($code)
    {
        $this->getResponse();

        $expected = intval($code);
        $actual   = intval($this->getResponse()->getStatusCode());

        Assertions::assertSame($expected, $actual);
    }

    /**
     * @Then /^(?:the )?response should be:$/
     */
    public function theResponseShouldBe(PyStringNode $content)
    {
        if ($this->getResponseHeader('Content-Type') === 'application/json') {
            $this->assertJsonStringEqualsJsonString(
                $this->adaptContent($content->getRaw()),
                $this->getResponse()->getContent(),
                sprintf('The content of the response is not the expected')
            );
        } else {
            Assertions::assertEquals(
                $content->getRaw(),
                $this->getResponse()->getContent(),
                sprintf('The content of the response is not the expected')
            );
        }
    }

    /**
     * @Then /^(?:the )?response should be empty$/
     */
    public function theResponseShouldBeEmpty()
    {
        Assertions::assertEmpty($this->getResponse()->getContent());
    }

    /**
     * Prints last request.
     *
     * @Then print request
     */
    public function printRequest()
    {
        echo $this->getRequest();
    }

    /**
     * Prints last response.
     *
     * @Then print response
     */
    public function printResponse()
    {
        echo $this->getResponse();
    }

    /** @return BrowserKitDriver */
    private function getDriver()
    {
        return $this->getSession()->getDriver();
    }

    private function getClient()
    {
        return $this->getDriver()->getClient();
    }

    /** @return Response */
    private function getResponse()
    {
        return $this->getClient()->getResponse();
    }

    private function getResponseHeader($header, $default = null)
    {
        return $this->getResponse()->headers->get($header, $default);
    }

    /** @return Request */
    private function getRequest()
    {
        return $this->getClient()->getRequest();
    }

    private function sendRequest($method, $url, $content = null)
    {
        $this->getClient()->request($method, $url, [], [], $this->headers, $content);

        $this->headers = [];
    }

    private function adaptContent($content)
    {
        return $this->convertRelativeDates($content);
    }

    public static function assertJsonStringEqualsJsonString($expectedJson, $actualJson, $message = '')
    {
        Assertions::assertJson($expectedJson, $message);
        Assertions::assertJson($actualJson, $message);

        $expected = json_decode($expectedJson);
        $actual   = json_decode($actualJson);

        Assertions::assertThat($actual, new ConstraintIsSimilar($expected), $message);
    }

    private function convertRelativeDates($expectedResponse)
    {
        if (preg_match_all('/\#date (?<dates>[^\#]+)\#/', $expectedResponse, $matches)) {
            foreach ($matches['dates'] as $date) {
                $expectedResponse = str_replace(
                    sprintf('#date %s#', $date),
                    (new DateTimeImmutable($date))->format(DateTime::ISO8601),
                    $expectedResponse
                );
            }
        }

        return $expectedResponse;
    }
}
