<?php

namespace Rarq\FilamentWhatsappMessagePreview\Traits;

use Closure;
use Rarq\FilamentWhatsappMessagePreview\Enums\MessageDirection;

trait HasMessageDirection
{
    protected MessageDirection | string | Closure | null $messageDirection = null;

    protected string | Closure | null $incomingDirectionLabel = null;

    protected string | Closure | null $outgoingDirectionLabel = null;

    protected bool | Closure $hideMessageDirectionTabs = false;

    public function messageDirection(MessageDirection | string | Closure | null $direction): static
    {
        $this->messageDirection = $direction;

        return $this;
    }

    public function getMessageDirection(): MessageDirection
    {
        return $this->evaluate($this->messageDirection) ?? MessageDirection::OUTGOING;
    }

    public function incomingDirectionLabel(string | Closure | null $label): static
    {
        $this->incomingDirectionLabel = $label;

        return $this;
    }

    public function getIncomingDirectionLabel(): ?string
    {
        return $this->evaluate($this->incomingDirectionLabel) ?? __('filament-whatsapp-message-preview::whatsapp-message-preview.incoming');
    }

    public function outgoingDirectionLabel(string | Closure | null $label): static
    {
        $this->outgoingDirectionLabel = $label;

        return $this;
    }

    public function getOutgoingDirectionLabel(): ?string
    {
        return $this->evaluate($this->outgoingDirectionLabel) ?? __('filament-whatsapp-message-preview::whatsapp-message-preview.outgoing');
    }

    public function hideMessageDirectionTabs(bool | Closure $condition = true): static
    {
        $this->hideMessageDirectionTabs = $condition;

        return $this;
    }

    public function shouldHideMessageDirectionTabs(): bool
    {
        return (bool) $this->evaluate($this->hideMessageDirectionTabs);
    }
}
