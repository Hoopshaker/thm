#!/bin/bash

# Chemin vers le dossier contenant les images
image_folder="frames"

# Vérifiez si le dossier existe
if [ ! -d "$image_folder" ]; then
    echo "Le dossier $image_folder n'existe pas."
fi


# Parcourez chaque fichier dans le dossier
for image_file in "$image_folder"/out-*.jpg; do
    # Vérifiez si le fichier existe (pour éviter les erreurs si aucun fichier ne correspond)
    if [ -e "$image_file" ]; then
        echo "Traitement du fichier : $image_file"
        # Exécutez la commande stegseek
        stegseek "$image_file" /usr/share/wordlists/SecLists/Passwords/Leaked-Databases/rockyou.txt
    fi
done
