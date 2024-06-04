# Use a specific Ubuntu base image
FROM ubuntu:20.04

# Install necessary packages and repositories
RUN apt-get update && \
    apt-get install -y software-properties-common && \
    add-apt-repository ppa:ondrej/php && \
    apt-get update

# Install Apache, PHP 8.1, MySQL Server, and other necessary packages
RUN DEBIAN_FRONTEND=noninteractive apt-get install -y \
    apache2 \
    php8.1 \
    libapache2-mod-php8.1 \
    php8.1-mysql && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

# Enable PHP module
RUN a2enmod php8.1

# Copy the start script
COPY start.sh /start.sh
RUN chmod +x /start.sh

# Expose port 80
EXPOSE 80

# Start the services
CMD ["/start.sh"]
