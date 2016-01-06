# Proxy Parameters #

  * **bwsp\_service** = Name of the service

  * **bwsp\_response\_format** = raw | json | capsule . Response format, could be the raw xml format provided by the web service, a JSON object or a base64 encoded XML response encapsulated inside a JSON object {"response":"base64 encoded string"}.

  * **bwsp\_callback** = callback name. If provided the response of the server is a JSONP function.

  * **bwsp\_url** = Web-service request.

  * **bwsp\_force\_no\_cache** = Force to empty the cache for this query.