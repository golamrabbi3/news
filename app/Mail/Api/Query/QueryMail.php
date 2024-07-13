<?php

namespace App\Mail\Api\Query;

use App\Models\Query;
use App\Services\AppSettings;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class QueryMail extends Mailable
{
    use Queueable, SerializesModels;

    public Query $query;
    /**
     * Create a new message instance.
     */
    public function __construct(Query $query)
    {
        $this->query = $query;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $subject = AppSettings::get('app_name', 'News') . " Query | " . $this->query->subject;

        return new Envelope(
            subject: $subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.queries.query',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
