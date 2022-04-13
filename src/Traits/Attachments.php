<?php

namespace Pentangle\LaravelSirportly\Traits;

trait Attachments
{
    /**
     * Getting Attachment Content
     * This method allows you to download the contents of an attachment on a ticket. The standard ticket view returns information about attachments within the updates variable.
     *
     * URL
     * /api/v2/tickets/attachment
     *
     * Access
     * This method can be accessed by account tokens and user tokens where the associated user has access to the ticket.
     *
     * @param $ticket string The ticket reference
     * @param $attachment int The attachment ID
     */
    public function getAttachment($ticket, $attachment)
    {
        return $this->query('/api/v2/tickets/attachment', queryParams: [
            'ticket' => $ticket,
            'attachment' => $attachment,
        ], json: false);
    }
}
