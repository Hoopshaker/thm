import string
import hashlib

def cryptstring(text, salt):
    """
    Encrypts a string using a salt.

    Parameters:
    text (str): The text to encrypt.
    salt (str): The salt to use for encryption.

    Returns:
    str: The encrypted string.
    """
    # Create a hash object using SHA-256
    hash_obj = hashlib.sha256()

    # Update the hash object with the text and salt
    hash_obj.update((text + salt).encode('utf-8'))

    # Return the hexadecimal representation of the hash
    return hash_obj.hexdigest()

def make_secure_cookie(text, salt):
    """
    Creates a secure cookie by encrypting the text using a salt.

    Parameters:
    text (str): The text to encrypt.
    salt (str): The salt to use for encryption.

    Returns:
    str: The encrypted secure cookie.
    """
    secure_cookie = ''

    # Split the text into chunks of 8 characters
    for el in [text[i:i+8] for i in range(0, len(text), 8)]:
        secure_cookie += cryptstring(el, salt)

    return secure_cookie

def main():
    # cookie to crack
    secured_cookie="gIAzM84CjCQzwgIfxDaIQcc2DwgIE0lh5iNqA5YgIX2eXZvEZDBQgIXVwl6b0juu6gIymA0kOBQ.x.gI7iYYSEg9KZ2gIwG.NGFTWBB.gIn5brfJpKoV6gIcDRBnUg.2IkgIypr5aFERVCkgIrs5UctSbDFAgIQD1j7dibZFYgIEXdhV2WkRgIgI4xE4rLOdwikgIcR21Bsqhda6gIj4ZOBv3osXIgIylMn6gwpioogIglMKFFEG0DQgI2df/myN9tvIgIYDF0cFyJeS2gIsEx2upQc1NAgIKhNuBJ86YEQgIvZEqYXtBu06gIJGXLJFpS8j2gIYLBi2GtvopYgIHRziaOkM7RUgIVofRCj113lEgIdZjF/D5WWSE"
    # create string to salt with rubbish encryption key
    enc_secret_key= "rubbish"
    http_user_agent="Mozilla/5.0 (X11; Linux x86_64; rv:137.0) Gecko/20100101 Firefox/137.0"
    user="guest"
    string_cookie_clear=f"{user}:{http_user_agent}:{enc_secret_key}"

    # Step all possible coimbination of a strings with 2 chars containing digits and ascci letters
    characters = string.ascii_letters + string.digits
    all_possible_salts=[]
    for char_1 in characters:
        for char_2 in characters:
            all_possible_salts.append(f"{char_1}{char_2}")

    for salt in all_possible_salts:
        print(make_secure_cookie(string_cookie_clear,salt))

if __name__=='__main__':
    main()
