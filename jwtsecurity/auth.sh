#!/bin/bash

# Check if the correct number of arguments is provided
if [ "$#" -ne 2 ]; then
    echo "Usage: $0 <exercise> <url>"
    exit 1
fi

# Assign the arguments to variables
exercise=$1
url=$2

# Construct the JSON payload directly
json_payload="{\"username\": \"user\", \"password\": \"password$exercise\"}"

# Execute the curl command
curl -H 'Content-Type: application/json' -X POST -d "$json_payload" "$url/api/v1.0/example$exercise"

