<?php

namespace Pentangle\LaravelSirportly;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Pentangle\LaravelSirportly\Traits\Attachments;
use Pentangle\LaravelSirportly\Traits\TicketUpdates;

class LaravelSirportly
{
    use TicketUpdates;
    use Attachments;

    public function __construct(private $token, private $secret, private $url = 'https://api.sirportly.com')
    {
    }

    private function query($action, $postdata = [], $queryParams = [])
    {
        // add Auth-Token and Auth-Secret to header
        $client = Http::withHeaders([
            'X-Auth-Token' => $this->token,
            'X-Auth-Secret' => $this->secret,
        ]);

        // convert to laravel http library
        if ($postdata) {
            $payload = $postdata;
            $response = $client->asForm()->post($this->url.$action, $postdata);
        } else {
            $payload = $queryParams;
            $response = $client->get($this->url.$action, $queryParams);
        }

        if (! $response->successful()) {
            $message = [];
            $message[] = "Error on Sirportly API endpoint";
            $message[] = "Connecting to: ".$this->url.$action;

            $message[] = "Sending the following payload:";
            $message[] = print_r($payload, 1);
            $message[] = "Received the following response:";
            $message[] = print_r($response->body(), 1);

            $message = implode("\r\n", $message);
            Log::error($message);
            Log::channel('teams')->error($message);

            return false;
        }

        return $response->json();
    }

    /**
     * @param  int  $page
     * @param  int  $per_page
     * @return array|false|mixed
     */
    public function tickets(int $page = 1, int $per_page = 30)
    {
        return $this->query(
            action: '/api/v1/tickets/all',
            queryParams: compact('page', 'per_page')
        );
    }

    public function ticket($ticket_reference)
    {
        return $this->query(
            action: '/api/v1/tickets/ticket',
            queryParams: compact('ticket_reference')
        );
    }

    public function create_ticket($params = [])
    {
        return $this->query(
            action: '/api/v1/tickets/submit',
            postdata: $params
        );
    }

    public function post_update($params = [])
    {
        return $this->query(
            '/api/v1/tickets/post_update',
            postdata: $params
        );
    }

    public function update_ticket($params = [])
    {
        return $this->query(
            '/api/v1/tickets/update',
            postdata: $params
        );
    }

    public function run_macro($params = [])
    {
        return $this->query('/api/v1/tickets/macro', $params);
    }

    public function add_follow_up($params = [])
    {
        return $this->query(
            '/api/v1/tickets/followup',
            postdata: $params
        );
    }

    public function create_user($params = [])
    {
        return $this->query(
            '/api/v1/users/create',
            postdata: $params
        );
    }

    public function statuses()
    {
        return $this->query('/api/v1/objects/statuses');
    }

    public function priorities()
    {
        return $this->query('/api/v1/objects/priorities');
    }

    public function teams()
    {
        return $this->query('/api/v1/objects/teams');
    }

    public function brands()
    {
        return $this->query('/api/v1/objects/brands');
    }

    public function departments()
    {
        return $this->query('/api/v1/objects/departments');
    }

    public function escalation_paths()
    {
        return $this->query('/api/v1/objects/escalation_paths');
    }

    public function slas()
    {
        return $this->query('/api/v1/objects/slas');
    }

    public function filters()
    {
        return $this->query('/api/v1/objects/filters');
    }

    public function spql($params = [])
    {
        return $this->query('/api/v1/tickets/spql', $params);
    }

    /**
     * Fetch a list of knowledgebases from your account
     * @return array list of knowledgebases in an array format.
     */
    public function kb_list()
    {
        return $this->query('/api/v1/knowledge/list');
    }

    /**
     * Return a single knowledgebase tree.
     * @param  int  $kb_id  The ID of the knowledgebase you want to load
     * @return array        The knowledgebase as an array.
     */
    public function kb($kb_id)
    {
        return $this->query(
            '/api/v1/knowledge/tree',
            queryParams: ['kb' => $kb_id]
        );
    }

    /**
     * Fetch a list of users from your account
     * @return array        The users as an array.
     */
    public function users($page = 1)
    {
        return $this->query(
            '/api/v2/users/all',
            queryParams: compact('page')
        );
    }

    /**
     * Fetch a list of contacts from your account
     * @return array        The contacts as an array.
     */
    public function contacts($page = 1)
    {
        return $this->query(
            '/api/v2/contacts/all',
            queryParams: compact('page')
        );
    }
}
