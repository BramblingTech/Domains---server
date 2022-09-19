<?php

use Pecee\SimpleRouter\SimpleRouter;

SimpleRouter::get('suggest', 'SuggestionDomainsAction@handle');
SimpleRouter::post('available', 'AvailableDomainsAction@handle');
SimpleRouter::post('mail', 'SendEmailAction@handle');