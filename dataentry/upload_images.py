import os

url = "https://rtionline.tn.gov.in/sscsr/icons.zip"

os.system('wget %s -O sign.zip',url)

os.system('unzip sign.zip')