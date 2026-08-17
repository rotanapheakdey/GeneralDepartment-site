import urllib.request, json
url = 'https://en.wikipedia.org/w/api.php?action=query&prop=pageimages&titles=Cambodia|Phnom_Penh|Angkor_Wat|Hun_Manet&pithumbsize=500&format=json'
req = urllib.request.urlopen(url)
data = json.loads(req.read())
images = []
for page in data['query']['pages'].values():
    if 'thumbnail' in page:
        images.append(page['thumbnail']['source'])
print(json.dumps(images))
