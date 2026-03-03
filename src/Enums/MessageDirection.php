<?php

namespace Rarq\FilamentWhatsappMessagePreview\Enums;

enum MessageDirection: string
{
    case INCOMING = 'incoming';
    case OUTGOING = 'outgoing';
}