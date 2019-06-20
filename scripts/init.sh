#!/bin/sh

# Install composer dependencies
composer install -n -o

# Run unit tests
composer test