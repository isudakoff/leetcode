FROM php:7.2.13-cli

ENV MYPATH /code

# Set working directory
WORKDIR $MYPATH

# Install dependencies
RUN apt-get update -qq \
    && apt-get install -y --no-install-recommends \
        iputils-ping \
        # For PHP mbstring package
        libonig-dev \
        locales \
        vim \
        nano \
        curl \
    # Install and enable PHP dependencies
    && docker-php-ext-install \
        mbstring \
        bcmath \
    # Cleanup
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

VOLUME ["$MYPATH"]
