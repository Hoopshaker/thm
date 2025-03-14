#! /bin/bash

# Initialize variables
room=""
ip=""

# Function to display usage
usage() {
    echo "Usage: $0 --room <thm_room> --ip <target_ip>"
    exit 1
}

# Parse arguments
while [[ "$#" -gt 0 ]]; do
    case $1 in
        --room) room="$2"; shift ;;
        --ip) ip="$2"; shift ;;
        *) usage ;;
    esac
    shift
done

# Check if all required arguments are provided
if [ -z "$room" ] || [ -z "$ip" ]; then
    usage
fi

# Vérifiez si le dossier existe
if [ ! -d "$room" ]; then
	echo "Creating folder $room"
	mkdir $room;
else
	echo "Folder $room already exists"
fi

# init.sh file
if [ -f "$room/init.sh" ]; then
	echo "Updating init.sh file"
else
	echo "Creating init.sh file"
fi

echo "#! /bin/bash" > $room/init.sh
echo "TARGET=$ip">>$room/init.sh
echo "ROCKYOU_WL=/usr/share/wordlists/SecLists/Passwords/Leaked-Databases/rockyou.txt">>$room/init.sh
echo "DIR_WL=/usr/share/wordlists/SecLists/Discovery/Web-Content/directory-list-2.3-big.txt">>$room/init.sh
chmod +x $room/init.sh 

# adding .gitignore file to folder
if [ -f "$room/.gitignore" ]; then
	echo ".gitignore file exists"
else
	echo "Creating .gitignore file"
	echo "init.sh" > $room/.gitignore
fi

# scans folder
if [ ! -d "$room/scans" ]; then
    mkdir $room/scans;
fi

# webserver folder
if [ ! -d "$room/webserver" ]; then
	mkdir $room/webserver;
fi
