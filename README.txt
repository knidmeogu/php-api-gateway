PHP API Gateway

SETUP
    1. Copy `my_api_gateway` to your XAMPP `htdocs` directory.
    2. Start Apache and MySQL in XAMPP.
    3. Use Postman or curl to test.

VALID API KEYS
    - key123: UserA
    - key456: UserB

TESTING
### Users API:
GET http://localhost/my_api_gateway/api/users  
Header: X-API-Key: key123

### Products API:
GET http://localhost/my_api_gateway/api/products  
Header: X-API-Key: key123

### Invalid Key:
GET any endpoint with wrong key → returns 401

### Rate Limit:
Send 10+ requests in 60 secs → returns 429

LOGS
    http://localhost/my_api_gateway/logs/gateway.log
    Shows IP, API key, path, status.

DOCUMENTATION
http://localhost/my_api_gateway/docs.html

ACTIVITY NOTES
- Used file-based rate limiting.
- Used file includes for backend services.
