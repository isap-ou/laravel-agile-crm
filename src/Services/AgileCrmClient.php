<?php

namespace Isapp\AgileCrm\Services;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Isapp\AgileCrm\Contracts\AgileCrmEndpoint;
use Isapp\AgileCrm\Services\Endpoints\Contacts;
use Isapp\AgileCrm\Services\Endpoints\Notes;
use Isapp\AgileCrm\Services\Endpoints\Tasks;
use RuntimeException;

use function rtrim;

final class AgileCrmClient
{
    private string $baseUrl;

    private array $config;

    private string $email;

    private string $apiKey;

    private const array METHODS = [
        'contacts' => Contacts::class,
        'tasks' => Tasks::class,
        'notes' => Notes::class,
    ];

    private \Illuminate\Http\Client\PendingRequest $http;

    public function __construct()
    {
        $this->config = Config::get('agile-crm');
        $this->domain($this->config['default']);
    }

    public function domain(string $domain): static
    {
        if (empty($this->config['domains'][$domain])) {
            throw new RuntimeException("AgileCRM Exception: Domain '{$domain}' not found");
        }

        $this->baseUrl = \sprintf('https://%s.agilecrm.com/dev/api/', rtrim($this->config['domains'][$domain]['domain'], '/'));
        $this->email = $this->config['domains'][$domain]['email'];
        $this->apiKey = $this->config['domains'][$domain]['api_key'];

        $this->http = Http::baseUrl($this->baseUrl)
            ->withHeaders(['Accept' => 'application/json'])
            ->withBasicAuth($this->email, $this->apiKey);

        return $this;
    }

    public function __call(string $method, array $arguments = []): AgileCrmEndpoint
    {
        if (empty(self::METHODS[$method])) {
            throw new RuntimeException('AgileCRM Exception: Method does not exists');
        }

        $class = self::METHODS[$method];

        return new $class($this->http);
    }
}
