#pageinfo

This script fetches information about webpage by given url. It performs a simple try to determine website name and content article name. Otherwise it uses domain name like website name and page title like content article name. Supports only http and https.

Usage:
```
http://pageinfo.mydomain.com/?url=http://tasks.z/pageinfo/?url=http://www.bbc.com/news/world-us-canada-42205181
```
Example output:
```
{"success":true,"soruce":"BBC News","name":"Tax bill: Trump victory as Senate backs tax overhaul"}
```

Security warning! Requests to localhost are not restricted. Please make sure you server does not output some private info for localhost via http. Note that user can switch port.

