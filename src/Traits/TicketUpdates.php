<?php

namespace Pentangle\LaravelSirportly\Traits;

trait TicketUpdates
{
    /**
     * https://sirportly.com/docs/api-specification/ticket-updates/listing-updates
     *
     * Listing all updates for a ticket
     * This method will list all the updates for a given ticket.
     *
     * URL
     * /api/v2/ticket_updates/all
     * Access
     * This method is available to all account tokens and any user tokens who have access to the ticket.
     *
     * Supported Parameters
     * ticket - the ticket reference (required)
     * @param $ticket
     * @return array|false|mixed
     */
    public function ticketUpdates($ticket)
    {
        return $this->query('/api/v2/ticket_updates/all', compact('ticket'));
    }

    /**
     * Get ticket update details
     * This method returns the information associated with a given update.
     *
     * URL
     * /api/v2/ticket_updates/info
     * Access
     * This method is available to all account tokens and any user tokens who have access to the ticket.
     *
     * @param $ticket string The ticket reference
     * @param $update int The ID of the update to show
     */
    public function ticketUpdateInfo(string $ticket, int $update)
    {
        return $this->query('/api/v2/ticket_updates/info', compact('ticket', 'update'));
    }

    /**
     * Deleting/Privatising Updates
     * This method allows you to remove or privatise messages which have not been sent or are private notes.
     *
     * URL
     * /api/v2/ticket_updates/destroy
     * Access
     * This method is available to all account tokens and any user tokens who have access to the ticket.
     *
     * Supported Parameters
     * ticket - the ticket reference (required)
     * update - the ID of the update to show (required)
     * privatise - if sent, privatise rather than destroy the given update (destroy by default, optional)
     * @param $ticket
     * @param $update
     * @param  bool  $privatise
     * @return array|false|mixed
     */
    public function ticketUpdateDestroy($ticket, $update, bool $privatise = false)
    {
        return $this->query('/api/v2/ticket_updates/destroy', compact('ticket', 'update', 'privatise'));
    }

    /**
     * Pinning/Unpinning Updates
     * Pinned updates are private updates on a ticket which always appear at the top of a ticket's history. They can be used for highlighting pertinent information regarding the case.
     *
     * URL
     * /api/v2/ticket_updates/pin
     * /api/v2/ticket_updates/unpin
     * Access
     * This method is available to all account tokens and any user tokens who have access to the ticket.
     *
     * @param $ticket string The ticket reference
     * @param $update int The ID of the update to pin or unpin
     */
    public function ticketUpdatePin(string $ticket, int $update)
    {
        return $this->query('/api/v2/ticket_updates/pin', compact('ticket', 'update'));
    }

    /**
     * Pinned/Unpinned Updates
     * Pinned updates are private updates on a ticket which always appear at the top of a ticket's history. They can be used for highlighting pertinent information regarding the case.
     *
     * URL
     * /api/v2/ticket_updates/pin
     * /api/v2/ticket_updates/unpin
     * Access
     * This method is available to all account tokens and any user tokens who have access to the ticket.
     *
     * @param $ticket string The ticket reference
     * @param $update int The ID of the update to pin or unpin
     */
    public function ticketUpdateUnpin(string $ticket, int $update)
    {
        return $this->query('/api/v2/ticket_updates/unpin', compact('ticket', 'update'));
    }

}