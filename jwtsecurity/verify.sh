#!/bin/bash

# Initialize variables
exercise_number=""
url=""
jwt_token=""
username=""

# Function to display usage
usage() {
    echo "Usage: $0 --exercise <number> --url <url> --jwt <jwt_token> --username <username>"
}

# Parse arguments
while [[ "$#" -gt 0 ]]; do
    case $1 in
        --exercise) exercise_number="$2"; shift ;;
        --url) url="$2"; shift ;;
        --jwt) jwt_token="$2"; shift ;;
        --username) username="$2"; shift ;;
        *) usage ;;
    esac
    shift
done

# Check if all required arguments are provided
if [ -z "$exercise_number" ] || [ -z "$url" ] || [ -z "$jwt_token" ] || [ -z "$username" ]; then
    usage
fi

# Execute the curl command with proper quoting
curl -H "Authorization: Bearer $jwt_token" $url/api/v1.0/example$exercise_number?username=$username

