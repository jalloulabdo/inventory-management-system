#!/bin/bash
set -eux

# Start MySQL service
service mysql start

# Start Apache service
service apache2 start

# Keep the container running
tail -f /dev/null
